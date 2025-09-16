<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['governorate_id' => 1, 'name' => ['ar' => 'الرياض', 'en' => 'Riyadh']],
            ['governorate_id' => 1, 'name' => ['ar' => 'الدرعية', 'en' => 'Ad Diriyah']],
            ['governorate_id' => 1, 'name' => ['ar' => 'الخرج', 'en' => 'Al Kharj']],
            ['governorate_id' => 2, 'name' => ['ar' => 'مكة المكرمة', 'en' => 'Makkah']],
            ['governorate_id' => 2, 'name' => ['ar' => 'جدة', 'en' => 'Jeddah']],
            ['governorate_id' => 2, 'name' => ['ar' => 'الطائف', 'en' => 'Taif']],
            ['governorate_id' => 3, 'name' => ['ar' => 'المدينة المنورة', 'en' => 'Medina']],
            ['governorate_id' => 3, 'name' => ['ar' => 'العلا', 'en' => 'AlUla']],
            ['governorate_id' => 4, 'name' => ['ar' => 'الدمام', 'en' => 'Dammam']],
            ['governorate_id' => 4, 'name' => ['ar' => 'الخبر', 'en' => 'Khobar']],
            ['governorate_id' => 4, 'name' => ['ar' => 'الأحساء', 'en' => 'Al Ahsa']],
            ['governorate_id' => 4, 'name' => ['ar' => 'القطيف', 'en' => 'Qatif']],
            ['governorate_id' => 5, 'name' => ['ar' => 'أبها', 'en' => 'Abha']],
            ['governorate_id' => 5, 'name' => ['ar' => 'خميس مشيط', 'en' => 'Khamis Mushait']],
            ['governorate_id' => 6, 'name' => ['ar' => 'تبوك', 'en' => 'Tabuk']],
            ['governorate_id' => 6, 'name' => ['ar' => 'حقل', 'en' => 'Haql']],
            ['governorate_id' => 7, 'name' => ['ar' => 'حائل', 'en' => 'Hail']],
            ['governorate_id' => 7, 'name' => ['ar' => 'بقعاء', 'en' => 'Baqqa']],
            ['governorate_id' => 8, 'name' => ['ar' => 'الجوف', 'en' => 'Al-Jawf']],
            ['governorate_id' => 8, 'name' => ['ar' => 'سكاكا', 'en' => 'Sakaka']],
            ['governorate_id' => 9, 'name' => ['ar' => 'جازان', 'en' => 'Jizan']],
            ['governorate_id' => 9, 'name' => ['ar' => 'أبو عريش', 'en' => 'Abu Arish']],
            ['governorate_id' => 10, 'name' => ['ar' => 'نجران', 'en' => 'Najran']],
            ['governorate_id' => 10, 'name' => ['ar' => 'شرورة', 'en' => 'Sharurah']],
            ['governorate_id' => 11, 'name' => ['ar' => 'الباحة', 'en' => 'Al-Baha']],
            ['governorate_id' => 11, 'name' => ['ar' => 'بلجرشي', 'en' => 'Baljurashi']],
            ['governorate_id' => 12, 'name' => ['ar' => 'الحدود الشمالية', 'en' => 'Northern Borders']],
            ['governorate_id' => 12, 'name' => ['ar' => 'عرعر', 'en' => 'Arar']],
            ['governorate_id' => 13, 'name' => ['ar' => 'القصيم', 'en' => 'Al-Qassim']],
            ['governorate_id' => 13, 'name' => ['ar' => 'بريدة', 'en' => 'Buraidah']],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
