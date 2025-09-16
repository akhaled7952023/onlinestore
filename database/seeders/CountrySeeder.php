<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $countries = [
            [
                'id' => 1,
                'phone_code' => '966',
                'name' => ['en' => 'Saudi Arabia', 'ar' => 'السعودية'],
                'flag_code' => 'sa',
            ],
         ];
         foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
