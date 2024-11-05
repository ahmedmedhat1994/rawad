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
use Nafezly\Payments\Classes\TapPayment;

class paymentController extends Controller
{


    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function checkout_now(Request $request)
    {

        try {
            $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));

            $user_id= auth()->id();
            $first_name= 'ahmed';
            $last_name= 'medhat';
            $email= 'ahmedmedhat399@gmail.com';
            $phone= '201009885650';
            $amount= 500;
            $payment = new TapPayment();
            $response = $payment
                ->setUserId($user_id)
                ->setUserFirstName($first_name)
                ->setUserLastName($last_name)
                ->setUserEmail($email)
                ->setUserPhone($phone)
                ->setAmount($amount)
                ->pay();
            $transaction = OrderTransaction::where('order_id',$order->id)->first();
            $transaction->transaction_number =$response['process_data']['reference']['transaction'];
            $transaction->save();
            return redirect($response['redirect_url']);
            //output
            //[
            //    'payment_id'=>"", // refrence code that should stored in your orders table
            //    'redirect_url'=>"", // redirect url available for some payment gateways
            //    'html'=>"" // rendered html available for some payment gateways
            //]


        } catch (Exception $e) {
            // -- Handle the error
        }

    }

    public function verifyWithTap(Request $request){
        $payment = new TapPayment();
        $response = $payment->verify($request);



        if ($response['success'] == false)
        {
            $order_id = $response['process_data']['reference']['transaction'];
            return $this->cancelled($order_id);
        }

        $order_id = $response['process_data']['reference']['transaction'];
        return $this->completed($order_id);
    }


    public function cancelled($id)
    {
        $order_id = OrderTransaction::where('transaction_number',$id)->first()->order_id;
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

    public function completed($id)
    {
        $order_id = OrderTransaction::where('transaction_number',$id)->first()->order_id;

        $order = Order::with('products', 'user', 'payment_method')->find($order_id);

            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                'transaction_number' => $id,
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

//            User::whereHas('roles', function ($query) {
//                $query->whereIn('name', ['admin', 'supervisor']);
//            })->each(function ($admin, $key) use ($order) {
//                $admin->notify(new OrderCreatedNotification($order));
//            });
//
//
//            $data = $order->toArray();
//            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
//            $pdf = PDF::loadView('layouts.invoice', $data);
//            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
//            $pdf->save($saved_file);
//
//            $customer = User::find($order->user_id);
//            $customer->notify(new OrderThanksNotification($order, $saved_file));


            toast('Your recent payment is successful with reference code: ' . $response->getTransactionReference(), 'success');
            return redirect()->route('frontend.index');
    }

    public function webhook($order, $env)
    {
        //
    }
}
