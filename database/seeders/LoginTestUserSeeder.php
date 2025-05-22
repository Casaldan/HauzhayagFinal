<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'testuser@example.com'],
            [
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => Hash::make('test12345'),
                'role' => 'admin', // or 'user' depending on your app
                'status' => 'active',
                'is_admin' => 1,
            ]
        );
    }
} 