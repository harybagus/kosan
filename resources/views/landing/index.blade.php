@extends('layouts.landing')

@section('title', 'Kosan — Hunian Nyaman & Modern')

@section('content')

    {{-- ============================================================
     HERO SECTION
    ============================================================ --}}
    <section class="relative overflow-hidden bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">

        {{-- Background gradient --}}
        <div
            class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-white dark:from-blue-950/20 dark:via-gray-900 dark:to-gray-900 pointer-events-none">
        </div>

        {{-- Decorative circles --}}
        <div
            class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-100/40 dark:bg-blue-900/10 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-blue-100/30 dark:bg-blue-900/10 blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- ===== LEFT — Headline & CTA ===== --}}
                <div>
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-blue-700 dark:text-blue-300 text-xs font-medium px-3 py-1.5 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                        {{ $stats['available'] }} Kamar Tersedia Sekarang
                    </div>

                    {{-- Headline --}}
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-5">
                        Temukan
                        <span class="text-blue-600 dark:text-blue-400 font-serif italic"> Hunian </span>
                        <br class="hidden sm:block">
                        Nyaman Anda
                    </h1>

                    {{-- Subheadline --}}
                    <p class="text-gray-500 dark:text-gray-400 text-lg leading-relaxed mb-8 max-w-lg">
                        Kos modern dengan fasilitas lengkap, manajemen profesional, dan lokasi strategis. Tersedia kamar
                        Standard & Premium untuk semua kebutuhan.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-wrap gap-3">
                        <a href="#kamar"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl transition-all duration-200 shadow-sm shadow-blue-200 dark:shadow-none">
                            Lihat Kamar Tersedia
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#fasilitas"
                            class="inline-flex items-center gap-2 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:border-blue-500 dark:hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 font-medium px-6 py-3 rounded-xl transition-all duration-200">
                            Pelajari Fasilitas
                        </a>
                    </div>

                    {{-- Social proof --}}
                    <div class="mt-8 flex items-center gap-3">
                        <div class="flex -space-x-2">
                            @foreach (['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-yellow-500'] as $color)
                                <div
                                    class="w-8 h-8 rounded-full {{ $color }} border-2 border-white dark:border-gray-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                                    </svg>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <span
                                class="font-semibold text-gray-700 dark:text-gray-300">{{ $stats['total'] - $stats['available'] }}+</span>
                            penghuni aktif
                        </p>
                    </div>
                </div>

                {{-- ===== RIGHT — Stats Cards ===== --}}
                <div class="grid grid-cols-2 gap-4">

                    {{-- Total Kamar --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div
                            class="w-9 h-9 bg-blue-100 dark:bg-blue-900/40 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white mb-1">
                            {{ $stats['total'] }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3">Total Kamar</div>
                        <div class="h-1.5 rounded-full bg-gray-100 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-blue-500" style="width: 100%"></div>
                        </div>
                    </div>

                    {{-- Tersedia --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div
                            class="w-9 h-9 bg-green-100 dark:bg-green-900/40 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-1">
                            {{ $stats['available'] }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3">Tersedia</div>
                        <div class="h-1.5 rounded-full bg-gray-100 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-green-500"
                                style="width: {{ $stats['total'] > 0 ? round(($stats['available'] / $stats['total']) * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>

                    {{-- Premium --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div
                            class="w-9 h-9 bg-yellow-100 dark:bg-yellow-900/40 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-1">
                            {{ $stats['premium'] }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3">Premium (AC)</div>
                        <div class="flex gap-1 flex-wrap">
                            @for ($i = 0; $i < $stats['premium']; $i++)
                                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                            @endfor
                        </div>
                    </div>

                    {{-- Standard --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-9 h-9 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-700 dark:text-gray-300 mb-1">
                            {{ $stats['standard'] }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3">Standard</div>
                        <div class="flex gap-1 flex-wrap">
                            @for ($i = 0; $i < $stats['standard']; $i++)
                                <span class="w-2 h-2 rounded-full bg-gray-400 dark:bg-gray-500"></span>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
     ADVANTAGES SECTION
    ============================================================ --}}
    <section id="fasilitas" class="py-16 sm:py-20 bg-gray-50 dark:bg-gray-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            {{-- Header --}}
            <div class="text-center mb-12">
                <div
                    class="inline-block text-xs font-semibold text-blue-600 dark:text-blue-400 tracking-widest uppercase mb-3">
                    Keunggulan Kami
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Kenapa Memilih Kosan?
                </h2>
                <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto leading-relaxed">
                    Kami hadir dengan sistem manajemen modern yang memudahkan penghuni dan pengelola dalam satu platform
                    terintegrasi.
                </p>
            </div>

            {{-- Grid Keunggulan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                {{-- 1 — Lokasi Strategis --}}
                <div
                    class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 hover:border-blue-300 dark:hover:border-blue-700 hover:shadow-md dark:hover:shadow-none transition-all duration-200">
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Lokasi Strategis</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Terletak di pusat kota, dekat kampus, perkantoran, dan pusat perbelanjaan. Akses mudah ke
                        transportasi umum.
                    </p>
                </div>

                {{-- 2 — Keamanan 24 Jam --}}
                <div
                    class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 hover:border-green-300 dark:hover:border-green-700 hover:shadow-md dark:hover:shadow-none transition-all duration-200">
                    <div
                        class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Keamanan 24 Jam</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        CCTV di area strategis, akses kunci digital, dan petugas keamanan berjaga setiap hari tanpa henti.
                    </p>
                </div>

                {{-- 3 — Manajemen Digital --}}
                <div
                    class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 hover:border-purple-300 dark:hover:border-purple-700 hover:shadow-md dark:hover:shadow-none transition-all duration-200">
                    <div
                        class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Manajemen Digital</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Pembayaran, tagihan, dan laporan tersedia secara digital. Transparansi penuh untuk penghuni dan
                        pemilik.
                    </p>
                </div>

                {{-- 4 — WiFi Super Cepat --}}
                <div
                    class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 hover:border-cyan-300 dark:hover:border-cyan-700 hover:shadow-md dark:hover:shadow-none transition-all duration-200">
                    <div
                        class="w-10 h-10 rounded-xl bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">WiFi Super Cepat</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Internet fiber optik berkecepatan tinggi tersedia di seluruh area. Cocok untuk kerja, kuliah, maupun
                        hiburan.
                    </p>
                </div>

                {{-- 5 — Lingkungan Nyaman --}}
                <div
                    class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 hover:border-pink-300 dark:hover:border-pink-700 hover:shadow-md dark:hover:shadow-none transition-all duration-200">
                    <div
                        class="w-10 h-10 rounded-xl bg-pink-100 dark:bg-pink-900/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Lingkungan Nyaman</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Area bersih, taman hijau, dan komunitas penghuni yang ramah. Suasana tenang untuk istirahat dan
                        produktivitas.
                    </p>
                </div>

                {{-- 6 — Harga Transparan --}}
                <div
                    class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 hover:border-orange-300 dark:hover:border-orange-700 hover:shadow-md dark:hover:shadow-none transition-all duration-200">
                    <div
                        class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Harga Transparan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Tidak ada biaya tersembunyi. Harga jelas, pembayaran mudah, dan laporan bulanan tersedia kapan saja.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
     ROOM LISTING & FILTER
    ============================================================ --}}
    <section id="kamar" class="py-16 sm:py-20 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            {{-- Header & Filter --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-10">

                <div>
                    <div class="text-xs font-semibold text-blue-600 dark:text-blue-400 tracking-widest uppercase mb-2">
                        Pilihan Kamar
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Kamar Tersedia
                    </h2>
                </div>

                {{-- Filter Tabs --}}
                <div x-data="{ active: 'all' }" class="flex gap-2">
                    <button x-on:click="active = 'all'; filterRooms('all')"
                        x-bind:class="active === 'all'
                            ?
                            'bg-blue-600 text-white border-blue-600' :
                            'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600 hover:border-blue-400 dark:hover:border-blue-500'"
                        class="px-4 py-1.5 rounded-lg text-sm font-medium border transition-all duration-200">
                        Semua
                    </button>
                    <button x-on:click="active = 'standard'; filterRooms('standard')"
                        x-bind:class="active === 'standard'
                            ?
                            'bg-blue-600 text-white border-blue-600' :
                            'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600 hover:border-blue-400 dark:hover:border-blue-500'"
                        class="px-4 py-1.5 rounded-lg text-sm font-medium border transition-all duration-200">
                        Standard
                    </button>
                    <button x-on:click="active = 'premium'; filterRooms('premium')"
                        x-bind:class="active === 'premium'
                            ?
                            'bg-blue-600 text-white border-blue-600' :
                            'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600 hover:border-blue-400 dark:hover:border-blue-500'"
                        class="px-4 py-1.5 rounded-lg text-sm font-medium border transition-all duration-200">
                        Premium
                    </button>
                </div>

            </div>

            {{-- Room Grid --}}
            <div id="roomsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($availableRooms as $room)
                    <div class="room-card group bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-200"
                        data-type="{{ $room->type }}">
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
                                <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor"
                                    stroke-width="1" viewBox="0 0 24 24">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>
                            @endif

                            {{-- Type Badge --}}
                            <div class="absolute top-3 left-3">
                                @if ($room->isPremium())
                                    <span
                                        class="inline-flex items-center gap-1 bg-yellow-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
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

                            {{-- Footer --}}
                            <div
                                class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                        Rp {{ number_format($room->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">/bulan</span>
                                </div>

                                <a href="{{ route('rooms.detail', $room->room_number) }}"
                                    class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                                    Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 py-20 text-center">
                        <div
                            class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada kamar tersedia saat ini</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Silakan hubungi kami untuk informasi lebih
                            lanjut</p>
                    </div>
                @endforelse
            </div>

            {{-- Empty state saat filter tidak ada hasil --}}
            <div id="roomsEmpty" class="hidden py-20 text-center">
                <div
                    class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada kamar untuk tipe ini</p>
            </div>

            {{-- CTA lihat semua --}}
            @if ($availableRooms->count() >= 6)
                <div class="text-center mt-10">

                    <a href="{{ route('rooms') }}"
                        class="inline-flex items-center gap-2 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:border-blue-500 dark:hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                        Lihat Semua Kamar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @endif

        </div>
    </section>

    {{-- ============================================================
     CTA SECTION
    ============================================================ --}}
    <section class="py-16 sm:py-20 bg-gray-50 dark:bg-gray-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="relative bg-blue-600 dark:bg-blue-700 rounded-3xl px-8 py-14 text-center overflow-hidden">

                {{-- Decorative circles --}}
                <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-white/5 pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-36 h-36 rounded-full bg-white/5 pointer-events-none"></div>
                <div
                    class="absolute top-1/2 left-8 -translate-y-1/2 w-20 h-20 rounded-full bg-white/5 pointer-events-none">
                </div>

                <div class="relative">
                    {{-- Label --}}
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/90 text-xs font-medium px-3 py-1.5 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                        Siap Membantu Anda
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4 leading-tight">
                        Siap Pindah ke Hunian Impian?
                    </h2>
                    <p class="text-blue-100 max-w-xl mx-auto mb-8 leading-relaxed text-sm sm:text-base">
                        Hubungi kami sekarang untuk informasi ketersediaan kamar, tur langsung, atau konsultasi gratis
                        bersama tim kami.
                    </p>

                    <div class="flex flex-wrap justify-center gap-3">
                        <a href="#kontak"
                            class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Hubungi Sekarang
                        </a>
                        <a href="#kamar"
                            class="inline-flex items-center gap-2 border-2 border-white/40 hover:border-white text-white font-medium px-6 py-3 rounded-xl transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            Lihat Kamar
                        </a>
                    </div>

                    {{-- Stats bawah --}}
                    <div class="mt-10 grid grid-cols-3 gap-4 max-w-sm mx-auto">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">10</div>
                            <div class="text-xs text-blue-200 mt-0.5">Total Kamar</div>
                        </div>
                        <div class="text-center border-x border-white/20">
                            <div class="text-2xl font-bold text-white">5★</div>
                            <div class="text-xs text-blue-200 mt-0.5">Premium AC</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">H-3</div>
                            <div class="text-xs text-blue-200 mt-0.5">Auto Alert</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
     FAQ SECTION
    ============================================================ --}}
    <section id="faq" class="py-16 sm:py-20 bg-white dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">

            {{-- Header --}}
            <div class="text-center mb-12">
                <div
                    class="inline-block text-xs font-semibold text-blue-600 dark:text-blue-400 tracking-widest uppercase mb-3">
                    FAQ
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                    Pertanyaan yang Sering Ditanyakan
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Temukan jawaban dari pertanyaan yang paling sering ditanyakan oleh calon penghuni kami.
                </p>
            </div>

            {{-- FAQ List --}}
            <div class="space-y-3" x-data>
                @foreach ($faqs as $i => $faq)
                    <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }}, id: {{ $i }} }" x-on:faq-open.window="if ($event.detail.id !== id) open = false"
                        class="border rounded-xl overflow-hidden transition-colors duration-200"
                        x-bind:class="open
                            ?
                            'border-blue-300 dark:border-blue-700 bg-blue-50/50 dark:bg-blue-900/10' :
                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900'">
                        {{-- Question --}}
                        <button x-on:click="open = !open; if (open) $dispatch('faq-open', { id: id })"
                            class="w-full flex items-center justify-between px-5 py-4 text-left transition-colors">
                            <span class="font-medium text-sm pr-4 transition-colors"
                                x-bind:class="open
                                    ?
                                    'text-blue-700 dark:text-blue-300' :
                                    'text-gray-900 dark:text-white'">
                                {{ $faq['question'] }}
                            </span>
                            <span
                                class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center transition-all duration-200"
                                x-bind:class="open
                                    ?
                                    'bg-blue-600 text-white rotate-180' :
                                    'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400'">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </span>
                        </button>

                        {{-- Answer --}}
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1" class="px-5 pb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                {{ $faq['answer'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bottom CTA --}}
            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                    Tidak menemukan jawaban yang kamu cari?
                </p>
                <a href="#kontak"
                    class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                    Hubungi kami langsung
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    {{-- Filter Script --}}
    <script>
        function filterRooms(type) {
            const cards = document.querySelectorAll('.room-card');
            const empty = document.getElementById('roomsEmpty');
            let visibleCount = 0;

            cards.forEach(card => {
                const show = type === 'all' || card.dataset.type === type;
                card.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            // Tampilkan empty state jika tidak ada kamar
            if (empty) {
                empty.classList.toggle('hidden', visibleCount > 0);
            }
        }
    </script>

@endsection
