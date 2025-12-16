<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run() {
        Admin::create([
            'name' => 'Default Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0123456789',
            'address' => 'BRACU, Dhaka',
        ]);
    }
}
