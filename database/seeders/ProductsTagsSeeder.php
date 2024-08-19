<?php

namespace Database\Seeders;

use App\Models\Backend\Product;
use App\Models\Backend\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tags::whereStatus(true)->pluck('id')->toArray();

        Product::all()->each(function ($product) use ($tags) {
            $product->tags()->attach(Arr::random($tags, rand(2, 3)));
        });
    }
}
