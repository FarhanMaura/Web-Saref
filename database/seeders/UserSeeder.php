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
        // Create admin user
        User::create([
            'name' => 'Admin Wedding',
            'email' => 'admin@weddingcreator.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create regular user
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create few more test users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sari Dewi',
            'email' => 'sari@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
