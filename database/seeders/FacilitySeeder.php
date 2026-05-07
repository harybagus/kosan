<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'AC',
                'icon' => 'heroicon-o-sun',
            ],
            [
                'name' => 'WiFi',
                'icon' => 'heroicon-o-wifi',
            ],
            [
                'name' => 'Lemari',
                'icon' => 'heroicon-o-archive-box',
            ],
            [
                'name' => 'Meja Belajar',
                'icon' => 'heroicon-o-computer-desktop',
            ],
            [
                'name' => 'Kamar Mandi Dalam',
                'icon' => 'heroicon-o-home-modern',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::firstOrCreate(
                ['name' => $facility['name']],
                ['icon' => $facility['icon']]
            );
        }
    }
}
