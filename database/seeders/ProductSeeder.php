<?php

namespace Database\Seeders;

use App\Models\Backend\ProductCategories;
use App\Models\Backend\Products;
use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ar_JO');

        $categories = ProductCategories::whereNotNull('parent_id')->pluck('id');

        for ($i = 1; $i <= 50; $i++) {
            $products[] = [
                'name'                  => json_encode(['ar'=>$faker->sentence(2, true),'en'=>$faker->sentence(2, true)]),
                'slug'                  => json_encode(['ar'=>$faker->unique()->slug(2, true),'en'=>$faker->unique()->slug(2, true)]),
                'description'           => $faker->paragraph,
                'price'                 => $faker->numberBetween(5, 200),
                'quantity'              => $faker->numberBetween(10, 100),
                'product_category_id'   => $categories->random(),
                'featured'              => rand(0, 1),
                'status'                => true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        $chunks = array_chunk($products, 100);
        foreach ($chunks as $chunk) {
            Products::insert($chunk);
        }
    }
}
