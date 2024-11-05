<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\OrderTransaction;
use App\Models\Backend\Product;
use App\Models\Backend\ProductCoupon;
use App\Models\User;
use App\Services\OrderService;
use App\Services\PaymentsService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    protected $paymentServices;

    public function __construct(PaymentsService $paymentServices)
    {
        $this->paymentServices = $paymentServices;
    }
    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function checkout_now(Request $request)
    {

        try {
            $user = User::findOrFail(auth()->id());

            $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));

            $data =[ "draft"=>false,
                "due"=>1730793560000,
                "expiry"=>1730793560000,
                "description"=>"test invoice",
                "mode"=>"INVOICE",
                "note"=>"test note",
                "notifications"=>["channels"=>["SMS","EMAIL"],
                    "dispatch"=>true],
                "currencies"=>["KWD"],
                "metadata"=>["udf1"=>"1","udf2"=>"2","udf3"=>"3"],
                "charge"=>["receipt"=>["email"=>true,"sms"=>false],"statement_descriptor"=>"test"],
                "customer"=>["first_name"=>"test","last_name"=>"test","email"=>"ahmedmedhat399@gmail.com","phone"=>["country_code"=>"965","number"=>"51234567"]],
                "statement_descriptor"=>"test",
                "order"=>["amount"=>22.159,"currency"=>"KWD","items"=>[["amount"=>10.599,"description"=>"test","discount"=>["type"=>"P","value"=>0],"image"=>"","name"=>"iPhone","quantity"=>1]],
                    "shipping"=>["amount"=>10.56,"currency"=>"KWD","description"=>"test","provider"=>"ARAMEX","service"=>"test"],
                    "tax"=>[["description"=>"test","name"=>"VAT","rate"=>["type"=>"F","value"=>1]]]],
                "post"=>["url"=>"https://youtube.com"],
                "redirect"=>["url"=>"http://google.com"],
            "reference"=>["inovice"=>"INV_00001","order"=>"ORD_00001","invoice"=>"INV_00001"],
            "retry_for_captured"=>true,
];
            $response = $this->paymentServices->sendPayment($data);

            return $response;

        } catch (Exception $e) {
            // -- Handle the error
        }

    }

    public function cancelled($order_id)
    {
        $order = Order::find($order_id);
        $order->update([
            'order_status' => Order::CANCELED
        ]);
        $order->products()->each(function ($order_product) {
            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);
        });

        toast('You have cancelled your order payment!', 'error');
        return redirect()->route('frontend.index');

    }

    public function completed($order_id)
    {
        $order = Order::with('products', 'user', 'payment_method')->find($order_id);

        $omniPay = new PaymentsService('PayPal_Express');
        $response = $omniPay->complete([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
            'notifyUrl' => $omniPay->getNotifyUrl($order->id),
        ]);

        if ($response->isSuccessful()) {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                'transaction_number' => $response->getTransactionReference(),
                'payment_result' => 'success'
            ]);

            if (session()->has('coupon')) {
                $coupon = ProductCoupon::whereCode(session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }

            Cart::instance('default')->destroy();

            session()->forget([
                'coupon',
                'saved_customer_address_id',
                'saved_shipping_company_id',
                'saved_payment_method_id',
                'shipping',
            ]);

            User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'supervisor']);
            })->each(function ($admin, $key) use ($order) {
                $admin->notify(new OrderCreatedNotification($order));
            });


            $data = $order->toArray();
            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
            $pdf = PDF::loadView('layouts.invoice', $data);
            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
            $pdf->save($saved_file);

            $customer = User::find($order->user_id);
            $customer->notify(new OrderThanksNotification($order, $saved_file));


            toast('Your recent payment is successful with reference code: ' . $response->getTransactionReference(), 'success');
            return redirect()->route('frontend.index');
        }
    }

    public function webhook($order, $env)
    {
        //
    }
}
