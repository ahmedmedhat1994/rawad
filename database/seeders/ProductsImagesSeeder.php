<?php

namespace Database\Seeders;

use App\Models\Backend\ProductCategories;
use App\Models\Backend\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = Products::whereStatus(true)->pluck('id');

        $images[] = ['filename' => '01.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/01.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '02.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/02.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '03.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/03.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '04.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/04.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '05.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/05.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '06.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/06.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '07.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/07.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];
        $images[] = ['filename' => '08.jpg', 'mime' => 'image/jpg', 'size' => rand(100, 900), 'uid' => asset('uploads/products'.'/08.jpg'), 'attachable_id' => $products->random(),'attachable_type' => 'App/Models/Backend/products'];


        Products::all()->each(function ($product) use ($images) {
            $product->attachments()->createMany(Arr::random($images, rand(2, 3)));
        });

    }
}
