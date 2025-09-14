<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Admin::create([
        'name'     => 'admin1',
        'email'    => 'akhaled795@gmail.com',
        'password' => bcrypt('123456'),
        'type'     => 1,
    ]);

    $admin->assignRole('superadmin');
    }
}
