<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Admin::create([
        'name'     => 'admin1',
        'email'    => 'akhaled700@gmail.com',
        'password' => bcrypt('123456'),
        'type'     => 2,
    ]);

    $admin->assignRole('admin');
    }
}
