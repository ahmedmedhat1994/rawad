<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PaymentMethod;
use App\Models\Backend\ProductCategories;
use App\Models\Backend\ProductCoupon;
use App\Models\Backend\ProductReview;
use App\Models\Backend\Product;
use App\Models\Backend\ShippingCompany;
use App\Models\Backend\Tags;
use App\Models\Backend\UserAddress;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public  function index()
    {

        $product_categories = ProductCategories::withCount('products')->whereStatus(1)->whereNull('parent_id')->inRandomOrder()->get();
        $featuredProducts = Product::with('firstMedia')
            ->inRandomOrder()->Featured()->Active()->HasQuantity()->ActiveCategory()
            ->take(8)->get();

        $arrivalProducts = Product::with('firstMedia')
            ->inRandomOrder()->Active()->HasQuantity()->ActiveCategory()
            ->get();

       $cartListCount = Cart::instance('default')->count();

       $reviews = ProductReview::all();
//       return  $cartListCount;

        return view('Frontend.index',compact('product_categories','featuredProducts','arrivalProducts','cartListCount','reviews'));
    }

    public function shop(Request $request,$slug = null)
    {

        $products = Product::with('firstMedia');

        if ($slug == '') {
            $products = $products->ActiveCategory();
        } else {
            $product_category = ProductCategories::whereSlug($slug)->whereStatus(1)->first();

            if (is_null($product_category->parent_id)) {
                $categoriesIds = ProductCategories::whereParentId($product_category->id)
                    ->whereStatus(true)->pluck('id')->toArray();

                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });

            } else {

                $products = $products->with('category')->whereHas('category', function ($query) use ($slug) {
                    $query->where([
                        'slug' => $slug,
                        'status' => true
                    ]);
                });

            }
        }

        $products = $products->Active()
            ->HasQuantity()
            ->orderBy('id', 'desc')
            ->paginate(16);

        if ($slug != null)
        {
            $categoryName = $product_category;
        }else{
            $categoryName = null;
        }
        if ($request->ajax()) {
            return view('Frontend.shop_load', compact('products'))->render();
        }

        return view('Frontend.shop', compact('products','categoryName'));
    }

    public function shop_tag(Request $request,$slug = null)
    {
        $products = Product::with('firstMedia');

        $products = $products->with('tags')->whereHas('tags', function ($query) use ($slug) {
            $query->where([
                'slug' => $slug,
                'status' => true,
            ]);
        });

        $products = $products->Active()
            ->HasQuantity()
            ->orderBy('id', 'desc')
            ->paginate(16);

        if ($slug != null)
        {
            $tagsName = Tags::where('slug',$slug)->first();
            $categoryName = $tagsName;
        }else{
            $categoryName = null;
        }

        if ($request->ajax()) {
            return view('Frontend.shop_load', compact('products'))->render();
        }
        return view('Frontend.shop_tag', compact('products','categoryName'));
    }

    public function product($slug)
    {
        $product = Product::with('attachments', 'category', 'tags', 'reviews')->withAvg('reviews', 'rating')->whereSlug($slug)
            ->Active()->HasQuantity()->ActiveCategory()->first();

        $relatedProducts = Product::with('firstMedia')->whereHas('category', function ($query) use ($product) {
            $query->whereId($product->product_category_id);
            $query->whereStatus(true);
        })->inRandomOrder()->Active()->HasQuantity()->take(4)->get();


        return view('Frontend.product', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
//        Cart::destroy();
//        session()->remove('shipping');
        $data['cart_subtotal'] = getNumbers()->get('subtotal');
        $data['cart_tax'] = getNumbers()->get('productTaxes');
        $data['cart_discount'] = getNumbers()->get('discount');
        $data['cart_shipping'] = getNumbers()->get('shipping');
        $data['cart_total'] = getNumbers()->get('total');
        return view('frontend.cart',compact('data'));
    }

    public function addToCart(Request $request)
    {

        $product =Product::findOrFail($request->id);

        if ($request->qty != null)
        {
            $qty = $request->qty;
        }else{
            $qty = 1;

        }


        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
        }else {
            Cart::instance('default')->add(['id' => $product->id, 'name' => $product->name, 'qty' => $qty, 'price' => $request->price, 'options' => ['size' => $request->size,'color'=>$request->color]]
            )->associate(Product::class);

            return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);
        }


    }

    public function updateCart(Request $request)
    {
        Cart::instance('default')->update($request->rowId,$request->qty);
        $cart_subtotal = getNumbers()->get('subtotal');

        if (session()->has('coupon'))
        {
            $code = session()->get('coupon')['code'];
            $coupon = ProductCoupon::whereCode($code)->first();
            $couponValue = $coupon->discount($cart_subtotal);
            if ($couponValue > 0) {
                session()->put('coupon', [
                    'code' => $coupon->code,
                    'value' => $coupon->value,
                    'discount' => $couponValue,
                ]);
            }
        }




     return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);
    }
    public function removeFromCart(Request $request)
    {
        Cart::instance('default')->remove($request->rowId);
        $count = Cart::instance('default')->count();
     return response()->json(array('status'=>'success', 'msg'=>'Success!.','count'=>$count), 200);
    }
    public function emptyCart(Request $request)
    {
        Cart::instance('default')->destroy();

     return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);
    }


    public function wishlist()
    {
        return view('frontend.wishlist');
    }
    public function addToWishlist(Request $request)
    {

        $product =Product::findOrFail($request->id);



        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
        }else {
            Cart::instance('wishlist')->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price]
            )->associate(Product::class);

            return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);
        }


    }



    public function applyDiscount(Request $request)
    {
        $cart_subtotal = getNumbers()->get('subtotal');

        if (getNumbers()->get('subtotal') > 0) {
            $coupon = ProductCoupon::whereCode($request->coupon_code)->whereStatus(true)->first();
            if(!$coupon) {
                return response()->json(array('status'=>'error', 'msg'=>'Coupon is invalid'), 500);
            }else {
                $couponValue = $coupon->discount($cart_subtotal);
                if ($couponValue > 0) {
                    session()->put('coupon', [
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                        'discount' => $couponValue,
                    ]);
                    $coupon_code = session()->get('coupon')['code'];
                    return response()->json(array('status'=>'success', 'msg'=>'coupon is applied successfully'), 200);
                }else {
                    return response()->json(array('status'=>'error', 'msg'=>'product coupon is invalid'), 500);
                }
            }
        }else {
            return response()->json(array('status'=>'error', 'msg'=>'No products available in your cart'), 500);
        }
    }

    public function removeCoupon()
    {
        session()->remove('coupon');
        return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);

    }


    public function checkout()
    {
//        session()->forget('saved_payment_method_code');

        $data['cart_subtotal'] = getNumbers()->get('subtotal');
        $data['cart_tax'] = getNumbers()->get('productTaxes');
        $data['cart_discount'] = getNumbers()->get('discount');
        $data['cart_shipping'] = getNumbers()->get('shipping');
        $data['cart_total'] = getNumbers()->get('total');
        $data['user_addresses'] = Auth::user()->addresses;
        $data['payment_methods'] = PaymentMethod::whereStatus(true)->get();

//        session()->forget('saved_customer_address_id');
//        session()->forget('saved_shipping_company_id');
        return view('frontend.checkout',compact('data'));
    }

    public function getShippingCompany(Request $request)
    {
        session()->forget('saved_customer_address_id');
        session()->forget('saved_shipping_company_id');
        session()->forget('shipping');

        $addressCounty = UserAddress::whereId($request->id)->first();
        $shipping_companies = ShippingCompany::whereHas('countries', function ($query) use ($addressCounty) {
            $query->where('country_id', $addressCounty->country_id);
        })->get();
        session()->put('shipping_company', $shipping_companies);
        session()->put('saved_customer_address_id', $request->id);

        return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);

    }
    public function getShippingCost(Request $request)
    {
        session()->forget('saved_shipping_company_id');

        $selectedShippingCompany = ShippingCompany::whereId($request->id)->first();
        session()->put('shipping', [
            'code' => $selectedShippingCompany->code,
            'cost' => $selectedShippingCompany->cost,
        ]);
        session()->put('saved_shipping_company_id',$request->id);

        return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);


    }


    public function updatePaymentMethod(Request $request)
    {
        session()->forget('saved_payment_method_code');
        session()->forget('saved_payment_method_id');

        $payment_method = PaymentMethod::whereId($request->id)->first();

        session()->put('saved_payment_method_code',$payment_method->code);
        session()->put('saved_payment_method_id',$payment_method->id);

        return response()->json(array('status'=>'success', 'msg'=>'Success!.'), 200);


    }

    public function payment_checkout()
    {
        return 'done';
    }

}
