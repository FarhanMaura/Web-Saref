<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,  // Tambahkan ini
            PackageSeeder::class,
            ReviewSeeder::class, // Optional
        ]);
    }
}
