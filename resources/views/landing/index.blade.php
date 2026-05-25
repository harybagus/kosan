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

@endsection
