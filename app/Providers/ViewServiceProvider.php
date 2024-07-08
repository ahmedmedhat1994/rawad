<?php

namespace App\Providers;

use App\Models\Backend\ProductCategories;
use App\Models\Backend\Tags;
use App\Models\Permission;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!request()->is('admin/*')) {
            view()->composer('*', function ($view) {
                if (!Cache::has('shop_categories_menu')) {
                    Cache::forever('shop_categories_menu', ProductCategories::tree());
                }
                $shop_categories_menu = Cache::get('shop_categories_menu');

                if (!Cache::has('shop_tags_menu')) {
                    Cache::forever('shop_tags_menu', Tags::whereStatus(true)->get());
                }
                $shop_tags_menu = Cache::get('shop_tags_menu');


                $cartListCount = Cart::instance('default')->count();


                $view->with([
                    'shop_categories_menu' => $shop_categories_menu,
                    'shop_tags_menu' => $shop_tags_menu,
                    'cartListCount'=>$cartListCount,
                ]);
            });
        }

        if (request()->is('admin/*')) {
            view()->composer('*', function ($view) {
                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Permission::tree());
                }
                $admin_side_menu = Cache::get('admin_side_menu');

                $view->with([
                    'admin_side_menu' => $admin_side_menu
                ]);
            });
        }
    }
}
