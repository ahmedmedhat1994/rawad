<?php

namespace Database\Seeders;

use App\Models\Backend\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tags::create(['name' => ['ar'=>'ملابس','en'=>'Clothes'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'احذية','en'=>'Shoes'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'ساعات','en'=>'Watches'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'اجهزه الكترونية','en'=>'Electronics'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'رجالى','en'=>'Men'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'نسائي','en'=>'Women'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'اولادى','en'=>'Boys'], 'status' => true]);
        Tags::create(['name' => ['ar'=>'بناتى','en'=>'Girls'], 'status' => true]);
    }
}
