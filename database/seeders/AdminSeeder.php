<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new \App\Models\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->username = 'admin';
        $admin->password = bcrypt('123456');
        $admin->role = 1;
        $admin->status = 1;
        $admin->save();
    }
}
