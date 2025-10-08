<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Update or create admin user with main_admin role
        User::updateOrCreate(
            ['email' => 'admin@weddingcreator.com'],
            [
                'name' => 'Admin Wedding',
                'password' => Hash::make('password123'),
                'role' => 'main_admin', // Tambahkan ini
                'email_verified_at' => now(),
            ]
        );

        // Update or create regular user
        User::updateOrCreate(
            ['email' => 'customer@test.com'],
            [
                'name' => 'Customer Test',
                'password' => Hash::make('password123'),
                'role' => 'user', // Tambahkan ini
                'email_verified_at' => now(),
            ]
        );

        // Update existing users to have 'user' role if role is null
        User::whereNull('role')->update(['role' => 'user']);

        // Create few more test users dengan role
        $testUsers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@test.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sari Dewi',
                'email' => 'sari@test.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Manager Event',
                'email' => 'manager@test.com',
                'password' => Hash::make('password123'),
                'role' => 'admin', // Admin biasa
                'email_verified_at' => now(),
            ]
        ];

        foreach ($testUsers as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
