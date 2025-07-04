<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hauzhayag.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
            'class_year' => '2025',
            'is_admin' => 1,
        ]);
    }
} 