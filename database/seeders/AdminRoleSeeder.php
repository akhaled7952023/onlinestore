<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            1 => ['name' => 'superadmin', 'name_ar' => 'سوبر مدير'],
            2 => ['name' => 'admin', 'name_ar' => 'مدير'],
            3 => ['name' => 'seller', 'name_ar' => 'بائع'],
            4 => ['name' => 'editor', 'name_ar' => 'محرر'],
            5 => ['name' => 'content', 'name_ar' => 'مدير محتوى'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(['name' => $roleData['name'], 'guard_name' => 'admin'], ['name_ar' => $roleData['name_ar']]);
        }
    }
}
