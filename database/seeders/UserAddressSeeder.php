<?php

namespace Database\Seeders;

use App\Models\Backend\City;
use App\Models\Backend\Country;
use App\Models\Backend\UserAddress;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $faker = Factory::create();

        $sami   = User::whereUsername('sami')->first();
        $ksa   = Country::with('states')->whereId(194)->first();
        $state = $ksa->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;

       $users= User::where('id','>',4)->get();

       foreach ($users as $user)
       {
           UserAddress::create([
               'user_id'         => $user->id,
               'address_title'         => 'Home',
               'default_address'       => true,
               'first_name'            => $faker->firstName,
               'last_name'             => $faker->lastName,
               'email'                 => $faker->email,
               'mobile'                => $faker->phoneNumber,
               'address'               => $faker->address,
               'address2'              => $faker->secondaryAddress,
               'country_id'            => $ksa->id,
               'state_id'              => $state,
               'city_id'               => $city,
               'zip_code'              => $faker->randomNumber(5),
               'po_box'                => $faker->randomNumber(4),
           ]);

       }



        Schema::enableForeignKeyConstraints();

    }
}
