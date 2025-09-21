<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminRoleSeeder::class,
            AdminSeeder::class,
            ManageAdminPermissionSeeder::class,
            ManageShippingPermissionSeeder::class,
            CountrySeeder::class,
            GovernrateSeeder::class,
            CitySeeder::class,
            ShippingGovernorateSeeder::class,
            ManageCategoriesPermissionSeeder::class,
            ManageBrandsPermissionSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            CouponSeeder::class,
            ManageCouponsPermissionSeeder::class,
        ]);
    }
}
