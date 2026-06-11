@extends('layouts.landing')

@section('title', 'Semua Kamar — KosNusantara')

@section('content')

    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Beranda
            </a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6" />
            </svg>
            <span class="text-gray-700 dark:text-gray-300 font-medium">Semua Kamar</span>
        </nav>

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Semua Kamar
            </h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm">
                Menampilkan
                <span class="font-medium text-gray-700 dark:text-gray-300">{{ $rooms->count() }}</span>
                kamar
                @if (request()->filled('type') || request()->filled('status'))
                    dengan filter aktif
                @endif
            </p>
        </div>

        {{-- Filter Panel --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-4 sm:p-5 mb-8">
            <form method="GET" action="{{ route('rooms') }}">
                <div class="flex flex-wrap items-end gap-3">

                    {{-- Tipe --}}
                    <div class="flex-1 min-w-32">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">
                            Tipe Kamar
                        </label>
                        <select name="type"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-2 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:outline-none transition">
                            <option value="">Semua Tipe</option>
                            <option value="standard" {{ request('type') === 'standard' ? 'selected' : '' }}>Standard
                            </option>
                            <option value="premium" {{ request('type') === 'premium' ? 'selected' : '' }}>Premium
                            </option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="flex-1 min-w-32">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">
                            Status
                        </label>
                        <select name="status"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-2 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:outline-none transition">
                            <option value="">Semua Status</option>
                            <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Tersedia
                            </option>
                            <option value="occupied" {{ request('status') === 'occupied' ? 'selected' : '' }}>Terisi
                            </option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            Filter
                        </button>

                        @if (request()->filled('type') || request()->filled('status'))
                            <a href="{{ route('rooms') }}"
                                class="inline-flex items-center gap-1.5 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-red-400 hover:text-red-500 dark:hover:text-red-400 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>

                </div>

                {{-- Active Filter Badges --}}
                @if (request()->filled('type') || request()->filled('status'))
                    <div class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <span class="text-xs text-gray-400 dark:text-gray-500 self-center">Filter aktif:</span>
                        @if (request()->filled('type'))
                            <span
                                class="inline-flex items-center bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                Tipe: {{ request('type') === 'premium' ? 'Premium' : 'Standard' }}
                            </span>
                        @endif
                        @if (request()->filled('status'))
                            <span
                                class="inline-flex items-center bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                Status: {{ request('status') === 'available' ? 'Tersedia' : 'Terisi' }}
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        {{-- Room Grid --}}
        @forelse($rooms as $room)
            @if ($loop->first)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @endif

            <div
                class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-200">

                {{-- Image --}}
                <div
                    class="relative h-48 flex items-center justify-center overflow-hidden
                {{ $room->isPremium()
                    ? 'bg-gradient-to-br from-blue-800 to-blue-600'
                    : 'bg-gradient-to-br from-gray-600 to-gray-500' }}">
                    @if ($room->image)
                        <img src="{{ Storage::url($room->image) }}" alt="Kamar {{ $room->room_number }}"
                            class="w-full h-full object-cover">
                    @else
                        <svg class="w-14 h-14 text-white/20" fill="none" stroke="currentColor" stroke-width="1"
                            viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                    @endif

                    {{-- Type Badge --}}
                    <div class="absolute top-3 left-3">
                        @if ($room->isPremium())
                            <span
                                class="inline-flex items-center gap-1 bg-yellow-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                                ⭐ Premium
                            </span>
                        @else
                            <span
                                class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full border border-white/30">
                                Standard
                            </span>
                        @endif
                    </div>

                    {{-- Status Badge --}}
                    <div class="absolute top-3 right-3">
                        <span
                            class="inline-flex items-center gap-1 text-white text-xs font-medium px-2.5 py-1 rounded-full
                        {{ $room->isAvailable() ? 'bg-green-500' : 'bg-red-500' }}">
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-white {{ $room->isAvailable() ? 'animate-pulse' : '' }}"></span>
                            {{ $room->isAvailable() ? 'Tersedia' : 'Terisi' }}
                        </span>
                    </div>
                </div>

                {{-- Body --}}
                <div class="p-5">
                    <div class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">
                        {{ $room->isPremium() ? 'Premium Suite' : 'Standard Room' }}
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-3">
                        Kamar {{ $room->room_number }}
                    </h3>

                    {{-- Facilities --}}
                    @if ($room->facilities->count() > 0)
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach ($room->facilities as $facility)
                                <span
                                    class="text-xs bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 px-2 py-0.5 rounded-md font-medium">
                                    {{ $facility->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Description --}}
                    @if ($room->description)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                            {{ $room->description }}
                        </p>
                    @endif

                    {{-- Footer --}}
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-800">
                        <div>
                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($room->price, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-400 dark:text-gray-500">/bulan</span>
                        </div>

                        <a href="{{ route('rooms.detail', $room->room_number) }}"
                            class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                            Detail
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            @if ($loop->last)
    </div>
    @endif

@empty
    <div class="py-20 text-center">
        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">
            Tidak ada kamar yang sesuai filter
        </p>
        <p class="text-sm text-gray-400 dark:text-gray-500 mb-4">
            Coba ubah atau reset filter di atas
        </p>
        <a href="{{ route('rooms') }}"
            class="inline-flex items-center gap-2 text-sm text-blue-600 dark:text-blue-400 hover:underline">
            Reset semua filter →
        </a>
    </div>
    @endforelse

    {{-- Back to Home --}}
    <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-800 text-center">
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    </div>

@endsection
