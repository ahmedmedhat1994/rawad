<?php

namespace Database\Seeders;

use App\Models\Backend\ProductCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clothes = ProductCategories::create(['name' => ['ar'=>'ملابس','en'=>'Clothes'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategories::create(['name' => ['ar'=>'ملابس نسائي','en'=>'Women\'s T-Shirts'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategories::create(['name' => ['ar'=>'ملابس رجالي','en'=>'Men\'s T-Shirts'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategories::create(['name' => ['ar'=>'فساتين','en'=>'Dresses'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategories::create(['name' => ['ar'=>'شرابات','en'=>'Novelty socks'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategories::create(['name' => ['ar'=>'نظارات نسائية','en'=>'Women\'s sunglasses'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategories::create(['name' => ['ar'=>'نظارات رجالي','en'=>'Men\'s sunglasses'], 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);

        $shoes = ProductCategories::create(['name' => ['ar'=>'احذية','en'=>'Shoes'], 'cover' => 'shoes.jpg', 'status' => true]);
        ProductCategories::create(['name' => ['ar'=>'احذية نسائي','en'=>'Women\'s Shoes'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategories::create(['name' => ['ar'=>'احذية رجالى','en'=>'Men\'s Shoes'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategories::create(['name' => ['ar'=>'احذية اطفالي','en'=>'Boy\'s Shoes'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategories::create(['name' => ['ar'=>'احذية بناتى','en'=>'Girls\'s Shoes'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);

        $watches = ProductCategories::create(['name' => ['ar'=>'ساعات','en'=>'Watches'], 'cover' => 'watches.jpg', 'status' => true]);
        ProductCategories::create(['name' => ['ar'=>'ساعات نسائي','en'=>'Women\'s Watches'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategories::create(['name' => ['ar'=>'ساعات رجالي','en'=>'Men\'s Watches'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategories::create(['name' => ['ar'=>'ساعات اولادى','en'=>'Boy\'s Watches'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategories::create(['name' => ['ar'=>'ساعات بناتى ','en'=>'Girls\'s Watches'], 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);

        $electronics = ProductCategories::create(['name' => ['ar'=>'اجهزة الكترونية','en'=>'Electronics'], 'cover' => 'electronics.jpg', 'status' => true]);
        ProductCategories::create(['name' => ['ar'=>'الكترونيات','en'=>'Electronics'], 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategories::create(['name' => ['ar'=>'اقراص تخزين','en'=>'USB Flash drives'], 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategories::create(['name' => ['ar'=>'سماعات','en'=>'Headphones'], 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategories::create(['name' => ['ar'=>'سماعات مكتبية','en'=>'Portable speakers'], 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategories::create(['name' => ['ar'=>'اكسسوارات موبايل','en'=>'Cell Phone bluetooth headsets'], 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategories::create(['name' => ['ar'=>'اجهزه تحكم','en'=>'Keyboards'], 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
    }
}
