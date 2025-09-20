<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManageCategoriesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permission = 'categories';
        Permission::firstOrCreate([
            'name' => $permission,
            'guard_name' => 'admin',
        ]);

        $superadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'admin']);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'admin']);
        $seller = Role::firstOrCreate(['name' => 'seller', 'guard_name' => 'admin']);
        $content = Role::firstOrCreate(['name' => 'content', 'guard_name' => 'admin']);

        $superadmin->givePermissionTo($permission);
        $admin->givePermissionTo($permission);
        $editor->givePermissionTo($permission);
    }
}
