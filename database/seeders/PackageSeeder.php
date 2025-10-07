<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Paket Prewedding Basic',
                'description' => 'Paket prewedding dengan konsep simple dan elegant. Cocok untuk pasangan yang menginginkan momen spesial tanpa ribet.',
                'price' => 2500000,
                'features' => json_encode([
                    '2 jam sesi foto',
                    '50 foto edited high resolution',
                    '1 lokasi shooting',
                    'Hasil dalam 7 hari kerja',
                    'Free konsultasi konsep'
                ]),
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Wedding Silver',
                'description' => 'Paket lengkap untuk dokumentasi wedding hari pernikahan Anda. Capture momen berharga sepanjang acara.',
                'price' => 5000000,
                'features' => json_encode([
                    '8 jam dokumentasi',
                    '200 foto edited high resolution',
                    '1 videographer',
                    'Video highlight 3-5 menit',
                    'All files dalam USB flashdisk',
                    'Free konsultasi pre-wedding'
                ]),
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Wedding Gold',
                'description' => 'Paket premium untuk pernikahan dengan coverage lebih lengkap dan hasil maksimal.',
                'price' => 8000000,
                'features' => json_encode([
                    '10 jam dokumentasi',
                    '2 photographer',
                    '1 videographer',
                    '300+ foto edited high resolution',
                    'Video highlight 5-7 menit',
                    'Video full ceremony',
                    'Drone footage',
                    'All files dalam hardcase exclusive'
                ]),
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Engagement',
                'description' => 'Dokumentasi momen lamaran yang romantis dan penuh makna.',
                'price' => 1500000,
                'features' => json_encode([
                    '2 jam sesi foto',
                    '30 foto edited high resolution',
                    '1 lokasi shooting',
                    'Hasil dalam 5 hari kerja',
                    'Free 1 cetak foto ukuran 8R'
                ]),
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Birthday Party',
                'description' => 'Dokumentasi ulang tahun yang menyenangkan dan penuh warna.',
                'price' => 1200000,
                'features' => json_encode([
                    '3 jam dokumentasi',
                    '50 foto edited high resolution',
                    '1 photographer',
                    'Hasil dalam 5 hari kerja',
                    'Free 5 foto instant print'
                ]),
                'image' => null,
                'is_active' => true,
            ]
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
