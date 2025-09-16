<?php

namespace Database\Seeders;

use App\Models\Governrate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            ['name' => ['en' => 'Riyadh', 'ar' => 'الرياض'], 'country_id' => 1],
            ['name' => ['en' => 'Makkah', 'ar' => 'مكة المكرمة'], 'country_id' => 1],
            ['name' => ['en' => 'Medina', 'ar' => 'المدينة المنورة'], 'country_id' => 1],
            ['name' => ['en' => 'Eastern Province', 'ar' => 'المنطقة الشرقية'], 'country_id' => 1],
            ['name' => ['en' => 'Asir', 'ar' => 'عسير'], 'country_id' => 1],
            ['name' => ['en' => 'Tabuk', 'ar' => 'تبوك'], 'country_id' => 1],
            ['name' => ['en' => 'Hail', 'ar' => 'حائل'], 'country_id' => 1],
            ['name' => ['en' => 'Al-Jawf', 'ar' => 'الجوف'], 'country_id' => 1],
            ['name' => ['en' => 'Jizan', 'ar' => 'جازان'], 'country_id' => 1],
            ['name' => ['en' => 'Najran', 'ar' => 'نجران'], 'country_id' => 1],
            ['name' => ['en' => 'Al-Baha', 'ar' => 'الباحة'], 'country_id' => 1],
            ['name' => ['en' => 'Northern Borders', 'ar' => 'الحدود الشمالية'], 'country_id' => 1],
            ['name' => ['en' => 'Al-Qassim', 'ar' => 'القصيم'], 'country_id' => 1],
        ];

        // Seed governorates
        foreach ($governorates as $governorate) {
            $gov = Governrate::create($governorate);

            // Create associated shipping governorate
            // ShippingGovernorate::create([
            //     'governorate_id' => $gov->id,
            //     'price' => 100,
            // ]);
        }
    }
}
