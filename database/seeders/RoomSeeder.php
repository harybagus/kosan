<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua fasilitas
        $ac           = Facility::where('name', 'AC')->first();
        $wifi         = Facility::where('name', 'WiFi')->first();
        $lemari       = Facility::where('name', 'Lemari')->first();
        $mejaBelajar  = Facility::where('name', 'Meja Belajar')->first();
        $kmDalam      = Facility::where('name', 'Kamar Mandi Dalam')->first();

        // Fasilitas untuk Standard (tanpa AC)
        $standardFacilities = collect([$wifi, $lemari, $mejaBelajar, $kmDalam])
            ->filter()
            ->pluck('id')
            ->toArray();

        // Fasilitas untuk Premium (dengan AC + semua)
        $premiumFacilities = collect([$ac, $wifi, $lemari, $mejaBelajar, $kmDalam])
            ->filter()
            ->pluck('id')
            ->toArray();

        // =====================================================
        // 5 KAMAR STANDARD
        // =====================================================
        $standardRooms = [
            [
                'room_number' => '101',
                'type'        => 'standard',
                'price'       => 600000,
                'status'      => 'available',
                'description' => 'Kamar standard nyaman dengan fasilitas dasar lengkap. Cocok untuk mahasiswa atau pekerja dengan budget terjangkau.',
            ],
            [
                'room_number' => '102',
                'type'        => 'standard',
                'price'       => 600000,
                'status'      => 'occupied',
                'description' => 'Kamar standard di lantai 1. Akses mudah dan dekat dengan area parkir.',
            ],
            [
                'room_number' => '103',
                'type'        => 'standard',
                'price'       => 600000,
                'status'      => 'available',
                'description' => 'Kamar standard dengan pencahayaan alami yang baik. Hadap timur, sejuk di pagi hari.',
            ],
            [
                'room_number' => '104',
                'type'        => 'standard',
                'price'       => 600000,
                'status'      => 'available',
                'description' => 'Kamar standard luas dengan jendela besar. Sirkulasi udara sangat baik.',
            ],
            [
                'room_number' => '105',
                'type'        => 'standard',
                'price'       => 600000,
                'status'      => 'occupied',
                'description' => 'Kamar standard tenang di pojok gedung. Minim kebisingan, cocok untuk yang butuh fokus.',
            ],
        ];

        foreach ($standardRooms as $data) {
            $room = Room::firstOrCreate(
                ['room_number' => $data['room_number']],
                $data
            );
            $room->facilities()->sync($standardFacilities);
        }

        // =====================================================
        // 5 KAMAR PREMIUM
        // =====================================================
        $premiumRooms = [
            [
                'room_number' => '201',
                'type'        => 'premium',
                'price'       => 800000,
                'status'      => 'available',
                'description' => 'Kamar premium dengan AC. Suasana nyaman dan modern untuk profesional muda.',
            ],
            [
                'room_number' => '202',
                'type'        => 'premium',
                'price'       => 800000,
                'status'      => 'occupied',
                'description' => 'Kamar premium terluas di lantai 2. Dilengkapi semua fasilitas termasuk AC.',
            ],
            [
                'room_number' => '203',
                'type'        => 'premium',
                'price'       => 800000,
                'status'      => 'available',
                'description' => 'Kamar premium dengan view taman. Tenang, sejuk, dan dilengkapi AC inverter hemat energi.',
            ],
            [
                'room_number' => '204',
                'type'        => 'premium',
                'price'       => 800000,
                'status'      => 'available',
                'description' => 'Kamar premium corner unit dengan dua jendela besar. Pencahayaan maksimal dan sirkulasi udara optimal.',
            ],
            [
                'room_number' => '205',
                'type'        => 'premium',
                'price'       => 800000,
                'status'      => 'occupied',
                'description' => 'Kamar premium paling populer. Fasilitas lengkap, lokasi strategis dekat tangga dan lift.',
            ],
        ];

        foreach ($premiumRooms as $data) {
            $room = Room::firstOrCreate(
                ['room_number' => $data['room_number']],
                $data
            );
            $room->facilities()->sync($premiumFacilities);
        }
    }
}
