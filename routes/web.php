<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CustomerAddressController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductCouponController;
use App\Http\Controllers\Backend\ProductReviewController;
use App\Http\Controllers\Backend\ShippingCompanyController;
use App\Http\Controllers\Backend\SupervisorController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Models\Backend\ProductReview;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
    Route::get('/shop/{slug?}', [FrontendController::class, 'shop'])->name('frontend.shop');
    Route::get('/shop/tags/{slug}', [FrontendController::class, 'shop_tag'])->name('frontend.shop_tag');
    Route::get('/product/{slug?}', [FrontendController::class, 'product'])->name('frontend.product');
    Route::get('/product/view/{id}', [FrontendController::class, 'product_view'])->name('frontend.product.view');
    Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
    Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('frontend.wishlist');
    Route::get('/removeCoupon', [FrontendController::class, 'removeCoupon'])->name('frontend.removeCoupon');
    Route::post('/applyDiscount', [FrontendController::class, 'applyDiscount'])->name('frontend.applyDiscount');
    Route::post('/emptyCart', [FrontendController::class, 'emptyCart'])->name('frontend.emptyCart');
    Route::post('/removeFromCart', [FrontendController::class, 'removeFromCart'])->name('frontend.removeFromCart');
    Route::post('/addToCart', [FrontendController::class, 'addToCart'])->name('frontend.addToCart');
    Route::post('/updateCart', [FrontendController::class, 'updateCart'])->name('frontend.updateCart');
    Route::post('/addToWishlist', [FrontendController::class, 'addToWishlist'])->name('frontend.addToWishlist');
    Route::post('/getShippingCompany', [FrontendController::class, 'getShippingCompany'])->name('frontend.getShippingCompany');
    Route::post('/getShippingCost', [FrontendController::class, 'getShippingCost'])->name('frontend.getShippingCost');
    Route::post('/updatePaymentMethod', [FrontendController::class, 'updatePaymentMethod'])->name('frontend.updatePaymentMethod');


    Route::group(['middleware' => ['roles', 'role:customer']], function () {
        Route::get('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
        Route::post('/payment/checkout', [FrontendController::class, 'payment_checkout'])->name('checkout.payment');
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [BackendController::class, 'login'])->name('login');
    });

    Route::group(['middleware' => ['roles', 'role:admin|supervisor']], function () {
        Route::get('/', [BackendController::class, 'index'])->name('index_route');
        Route::get('/index', [BackendController::class, 'index'])->name('index');

        /** Product Categories */
        Route::get('product_categories/delete/{id}', [ProductCategoriesController::class,'destroy']);
        Route::resource('product_categories', ProductCategoriesController::class);
        /** End Product Categories  */

        /** Tags */
        Route::get('tags/delete/{id}',[TagController::class,'destroy']);
        Route::resource('tags',TagController::class);
        /** End Tags  */

        /** Products */
        // Products //
        Route::get('deleteProduct/{id}',[ProductController::class,'destroy']);
        Route::get('/products/readFiles',[ProductController::class,'readFiles'])->name('products_readFiles');
        Route::post('/products/upload-images',[ProductController::class,'upload_images'])->name('products_upload_images');
        Route::delete('media/delete/{id}',[ProductController::class,'delete_image']);
        Route::resource('products',ProductController::class);
        /** End Products  */

        /** Product Coupons */
        // Products //
        Route::get('product_coupons/delete/{id}', [ProductCouponController::class,'destroy']);
        Route::resource('product_coupons',ProductCouponController::class);
        /** End Product Coupons  */


        /** Product Reviews */
        // Products //
        Route::get('product_reviews/delete/{id}', [ProductReviewController::class,'destroy']);
        Route::resource('product_reviews',ProductReviewController::class);
        /** End Product Reviews  */

        /** Customers */
        // Products //
        Route::get('customers/delete/{id}', [CustomerController::class,'destroy']);
        Route::get('customers/get_customers', [CustomerController::class,'get_customers'])->name('get_customers');
        Route::resource('customers',CustomerController::class);
        /** End Customers  */

        /** Customers Addresses */
        // Products //
        Route::get('states/get_states', [CustomerAddressController::class, 'get_states'])->name('states.get_states');
        Route::get('cities/get_cities', [CustomerAddressController::class, 'get_cities'])->name('cities.get_cities');
        Route::get('customer_addresses/delete/{id}', [CustomerAddressController::class,'destroy']);
        Route::resource('customer_addresses',CustomerAddressController::class);
        /** End Customers Addresses  */

        /** supervisors */
        // Products //
        Route::get('supervisors/delete/{id}', [SupervisorController::class,'destroy']);
        Route::resource('supervisors',SupervisorController::class);
        /** End supervisors  */

        /** Shipping Companies */
        Route::get('shipping_companies/delete/{id}', [ShippingCompanyController::class,'destroy']);
        Route::resource('shipping_companies',ShippingCompanyController::class);
        /** End Shipping Companies  */

        /** Payment Method */
        Route::get('payment_methods/delete/{id}', [PaymentMethodController::class,'destroy']);
        Route::resource('payment_methods',PaymentMethodController::class);
        /** End Payment Method  */

    });
});

//Auth::routes(['verify' => true]);

Route::get('/clear-cache', function () {
//    Artisan::call('config:cache');
    Artisan::call('cache:clear');
//    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
//    Artisan::call('optimize');
//    Artisan::call('cache:forget spatie.permission.cache');
//    Artisan::call('permission:cache-reset');
    return "Cache is cleared";
})->name('clear.cache');


require __DIR__ . '/auth.php';
