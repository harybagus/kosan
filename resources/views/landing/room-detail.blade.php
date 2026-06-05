@extends('layouts.landing')

@section('title', 'Kamar ' . $room->room_number . ' — KosNusantara')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Beranda
            </a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6" />
            </svg>
            <a href="{{ route('rooms') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Kamar
            </a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6" />
            </svg>
            <span class="text-gray-700 dark:text-gray-300 font-medium">
                Kamar {{ $room->room_number }}
            </span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ===== KIRI — Info Utama ===== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Image --}}
                <div
                    class="relative h-64 sm:h-80 rounded-2xl overflow-hidden flex items-center justify-center
                {{ $room->isPremium()
                    ? 'bg-gradient-to-br from-blue-800 to-blue-600'
                    : 'bg-gradient-to-br from-gray-600 to-gray-500' }}">
                    @if ($room->image)
                        <img src="{{ Storage::url($room->image) }}" alt="Kamar {{ $room->room_number }}"
                            class="w-full h-full object-cover">
                    @else
                        <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" stroke-width="1"
                            viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                    @endif

                    {{-- Badges --}}
                    <div class="absolute top-4 left-4 flex gap-2">
                        @if ($room->isPremium())
                            <span class="bg-yellow-500 text-white text-sm font-semibold px-3 py-1.5 rounded-full shadow-sm">
                                ⭐ Premium
                            </span>
                        @else
                            <span
                                class="bg-white/20 backdrop-blur-sm text-white text-sm px-3 py-1.5 rounded-full border border-white/30">
                                Standard
                            </span>
                        @endif
                        <span
                            class="text-white text-sm font-medium px-3 py-1.5 rounded-full
                        {{ $room->isAvailable() ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $room->isAvailable() ? '✓ Tersedia' : '✗ Terisi' }}
                        </span>
                    </div>
                </div>

                {{-- Title --}}
                <div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">
                        {{ $room->isPremium() ? 'Premium Suite' : 'Standard Room' }}
                    </p>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Kamar {{ $room->room_number }}
                    </h1>
                </div>

                {{-- Description --}}
                @if ($room->description)
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            Deskripsi Kamar
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $room->description }}
                        </p>
                    </div>
                @endif

                {{-- Facilities --}}
                @if ($room->facilities->count() > 0)
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                            Fasilitas Kamar
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach ($room->facilities as $facility)
                                <div
                                    class="flex items-center gap-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl px-4 py-3">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></span>
                                    <span class="text-sm font-medium text-blue-700 dark:text-blue-300">
                                        {{ $facility->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Info tambahan --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">Tipe</div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white capitalize">
                            {{ $room->type }}
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">Fasilitas</div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $room->facilities->count() }} item
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">Status</div>
                        <div
                            class="text-sm font-semibold {{ $room->isAvailable() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ $room->isAvailable() ? 'Tersedia' : 'Terisi' }}
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== KANAN — Price & CTA ===== --}}
            <div>
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 sticky top-20">

                    {{-- Price --}}
                    <div class="mb-6">
                        <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">Harga sewa</div>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                            Rp {{ number_format($room->price, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-400 dark:text-gray-500">per bulan</div>
                    </div>

                    {{-- CTA --}}
                    @if ($room->isAvailable())
                        <a href="{{ route('home') }}#kontak"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 rounded-xl transition-colors mb-3">
                            Saya Tertarik
                        </a>
                        <a href="{{ route('home') }}#kontak"
                            class="block w-full border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:border-blue-500 dark:hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 text-center font-medium py-3 rounded-xl transition-colors">
                            Jadwalkan Kunjungan
                        </a>
                    @else
                        <div
                            class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm text-center py-3 rounded-xl mb-3">
                            Kamar sedang terisi
                        </div>
                        <a href="{{ route('rooms') }}"
                            class="block w-full border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 text-center font-medium py-3 rounded-xl transition-colors">
                            Lihat Kamar Lain
                        </a>
                    @endif

                    {{-- Summary --}}
                    <div class="mt-5 pt-5 border-t border-gray-100 dark:border-gray-800 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Nomor Kamar</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $room->room_number }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Tipe</span>
                            <span class="font-medium text-gray-900 dark:text-white capitalize">{{ $room->type }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Status</span>
                            <span
                                class="font-medium {{ $room->isAvailable() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $room->isAvailable() ? 'Tersedia' : 'Terisi' }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- ===== Similar Rooms ===== --}}
        @if ($similarRooms->count() > 0)
            <div class="mt-16">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        Kamar {{ ucfirst($room->type) }} Lainnya
                    </h3>
                    <a href="{{ route('rooms') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        Lihat semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    @foreach ($similarRooms as $similar)
                        <a href="{{ route('rooms.detail', $similar->room_number) }}"
                            class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                            {{-- Image --}}
                            <div
                                class="relative h-36 flex items-center justify-center overflow-hidden
                            {{ $similar->isPremium()
                                ? 'bg-gradient-to-br from-blue-800 to-blue-600'
                                : 'bg-gradient-to-br from-gray-600 to-gray-500' }}">
                                @if ($similar->image)
                                    <img src="{{ Storage::url($similar->image) }}" class="w-full h-full object-cover"
                                        alt="Kamar {{ $similar->room_number }}">
                                @else
                                    <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor"
                                        stroke-width="1" viewBox="0 0 24 24">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                @endif
                                <div class="absolute top-2 right-2">
                                    <span
                                        class="text-white text-xs px-2 py-0.5 rounded-full
                                    {{ $similar->isAvailable() ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $similar->isAvailable() ? 'Tersedia' : 'Terisi' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="p-4">
                                <div class="font-semibold text-gray-900 dark:text-white mb-1">
                                    Kamar {{ $similar->room_number }}
                                </div>
                                @if ($similar->facilities->count() > 0)
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        @foreach ($similar->facilities->take(3) as $fac)
                                            <span
                                                class="text-xs bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 px-1.5 py-0.5 rounded">
                                                {{ $fac->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="text-sm font-semibold text-blue-600 dark:text-blue-400">
                                    Rp {{ number_format($similar->price, 0, ',', '.') }}<span
                                        class="text-xs text-gray-400 font-normal">/bulan</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
