<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user dan package dulu sebelum run seeder ini
        $users = User::take(3)->get();
        $packages = Package::all();

        if ($users->count() > 0 && $packages->count() > 0) {
            $reviews = [
                [
                    'user_id' => $users[0]->id,
                    'package_id' => $packages[0]->id,
                    'rating' => 5,
                    'comment' => 'Hasil foto sangat bagus! Photographer ramah dan profesional. Highly recommended!',
                    'is_visible' => true,
                ],
                [
                    'user_id' => $users[1]->id,
                    'package_id' => $packages[0]->id,
                    'rating' => 4,
                    'comment' => 'Pelayanan cukup baik, hasil foto sesuai ekspektasi. Harga worth it untuk kualitas yang didapat.',
                    'is_visible' => true,
                ],
                [
                    'user_id' => $users[2]->id,
                    'package_id' => $packages[1]->id,
                    'rating' => 5,
                    'comment' => 'Paket wedding silver sangat lengkap! Hasil video highlightnya bagus banget, keluarga sangat puas.',
                    'is_visible' => true,
                ],
            ];

            foreach ($reviews as $review) {
                Review::create($review);
            }
        }
    }
}
