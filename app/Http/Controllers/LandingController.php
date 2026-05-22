<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $availableRooms = Room::with('facilities')
            ->where('status', 'available')
            ->orderByRaw("FIELD(type, 'premium', 'standard')")
            ->orderBy('room_number')
            ->limit(6)
            ->get();

        $stats = [
            'total'     => Room::count(),
            'available' => Room::where('status', 'available')->count(),
            'premium'   => Room::where('type', 'premium')->count(),
            'standard'  => Room::where('type', 'standard')->count(),
        ];

        $faqs = [
            [
                'question' => 'Apa perbedaan kamar Standard dan Premium?',
                'answer'   => 'Kamar Premium dilengkapi AC, kamar mandi dalam, dan fasilitas tambahan lainnya. Kamar Standard memiliki fasilitas dasar yang nyaman tanpa AC dengan harga lebih terjangkau.',
            ],
            [
                'question' => 'Bagaimana sistem pembayaran sewa?',
                'answer'   => 'Pembayaran dilakukan bulanan melalui transfer bank atau tunai. Sistem kami akan mengirimkan notifikasi H-3 sebelum jatuh tempo agar tidak terlewat.',
            ],
            [
                'question' => 'Apakah tersedia parkir kendaraan?',
                'answer'   => 'Ya, tersedia parkir motor dan mobil di area kos. Kapasitas terbatas, first-come first-served basis tanpa biaya tambahan.',
            ],
            [
                'question' => 'Berapa lama kontrak minimum?',
                'answer'   => 'Kontrak minimum 3 bulan untuk penghuni baru. Perpanjangan bisa dilakukan secara bulanan tanpa penalti.',
            ],
            [
                'question' => 'Apakah bisa melihat kamar terlebih dahulu?',
                'answer'   => 'Tentu! Silakan hubungi kami untuk menjadwalkan kunjungan. Kami siap menemani Anda melihat kondisi kamar secara langsung.',
            ],
        ];

        return view('landing.index', compact('availableRooms', 'stats', 'faqs'));
    }

    public function rooms(Request $request)
    {
        $query = Room::with('facilities')->orderBy('room_number');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rooms = $query->get();

        return view('landing.rooms', compact('rooms'));
    }

    public function roomDetail(Room $room)
    {
        $room->load('facilities', 'activeTenant');

        $similarRooms = Room::with('facilities')
            ->where('type', $room->type)
            ->where('id', '!=', $room->id)
            ->where('status', 'available')
            ->limit(3)
            ->get();

        return view('landing.room-detail', compact('room', 'similarRooms'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
