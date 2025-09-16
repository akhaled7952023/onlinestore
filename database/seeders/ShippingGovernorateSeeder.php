<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governrate;
use App\Models\ShippingGovernorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingGovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::all();
        foreach ($cities as $city) {
            ShippingGovernorate::firstOrCreate(['city_id' => $city->id], ['price' => 10]);
        }
    }
}
