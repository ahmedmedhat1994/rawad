<?php

use App\Models\Backend\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;

function getParentShowOf($param)
{
    $route = str_replace('admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())
        ->where('as', $route)->flatten()->first();
    return $permission ? $permission['parent_show'] : null;
}

function getParentOf($param)
{
    $route = str_replace('admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())
        ->where('as', $route)->flatten()->first();
    return $permission ? $permission['parent'] : null;
}

function getParentIdOf($param)
{
    $route = str_replace('admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())
        ->where('as', $route)->flatten()->first();
    return $permission ? $permission['id'] : null;
}


function str_replace_slug($slug)
{
    return trim(str_replace(' ','_',$slug));
}

function getNumbers()
{
    $subtotal = Cart::instance('default')->subtotal();
    $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;
    $discount_code = session()->has('coupon') ? session()->get('coupon')['code'] : null;

    $subtotal_after_discount = $subtotal - $discount;

    $tax = config('cart.tax') / 100;
    $taxText = config('cart.tax') . '%';

    $productTaxes = round($subtotal_after_discount * $tax, 2);
    $newSubTotal = $subtotal_after_discount + $productTaxes;

    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $shipping_code = session()->has('shipping') ? session()->get('shipping')['code'] : null;

    $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;

    return collect([
        'subtotal' => $subtotal,
        'tax' => $productTaxes,
        'taxText' => $taxText,
        'productTaxes' => (float)$productTaxes,
        'newSubTotal' => (float)$newSubTotal,
        'discount' => (float)$discount,
        'discount_code' => $discount_code,
        'shipping' => (float)$shipping,
        'shipping_code' => $shipping_code,
        'total' => (float)$total,
    ]);
}


function generateNonUniqueSlug(): string
{
    $today = date('Ymd');
    $productsNumber = Product::where('slug','like', $today.'%')->pluck('slug');
    do{
        $productNumber = $today . rand(100000,999999);
    }while ($productsNumber->contains($productNumber));

    return $productNumber;
}


if (!function_exists('whatsapp'))
{
    function whatsapp ($api, $number, $message)
    {
        $curl = curl_init();
        $postdata = array(
            "contact" => array(
                array(
                    "number" => "966".$number,
                    "message" => $message
                ),
            )
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hayah.care/api/whatsapp/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($postdata),
            CURLOPT_HTTPHEADER => array(
                'Api-key:'.$api,
                'Content-Type: application/json'
            )
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
};


















