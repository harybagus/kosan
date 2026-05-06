<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — {{ filament()->getBrandName() }}</title>

    <script>
        (function() {
            const stored = localStorage.getItem('kos-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = stored ? stored === 'dark' : prefersDark;
            if (isDark) document.documentElement.classList.add('dark');
        })();
    </script>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-50 dark:bg-gray-950 font-sans antialiased transition-colors duration-300">

    <div class="min-h-screen flex items-center justify-center p-6">
        <div
            class="w-full max-w-5xl overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm flex flex-col lg:flex-row">

            {{-- ===== LEFT PANEL ===== --}}
            <div
                class="relative w-full lg:w-[55%] bg-blue-700 dark:bg-blue-900 flex flex-col justify-between p-10 overflow-hidden">

                {{-- Dekorasi --}}
                <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/5"></div>
                <div class="pointer-events-none absolute -bottom-16 -left-16 h-52 w-52 rounded-full bg-white/5"></div>
                <div class="pointer-events-none absolute right-10 bottom-32 h-32 w-32 rounded-full bg-white/5"></div>

                {{-- Logo --}}
                <div class="relative z-10 flex items-center justify-between">
                    <a href="{{ url('/') }}" class="inline-block">
                        <span class="text-2xl font-semibold tracking-tight text-white">
                            {{ filament()->getBrandName() }}
                        </span>
                    </a>
                    <div
                        class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-white/20 bg-white/10 px-3 py-1">
                        <svg class="h-3 w-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <span class="text-xs text-white/80">Panel Admin</span>
                    </div>
                </div>

                {{-- Headline --}}
                <div class="relative z-10 my-10">
                    <h2 class="mb-3 text-3xl font-semibold leading-snug text-white">
                        Kelola kos Anda<br>dari satu tempat
                    </h2>
                    <p class="text-sm leading-relaxed text-white/70 max-w-sm">
                        Pantau kamar, penghuni, dan pembayaran secara real-time dengan sistem manajemen yang
                        terintegrasi dan modern.
                    </p>
                    <div class="mt-5 flex flex-wrap gap-2">
                        <span class="rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs text-white/90">10
                            Kamar</span>
                        <span class="rounded-full border border-white/20 bg-white/20 px-3 py-1 text-xs text-white/90">5
                            Premium (AC)</span>
                        <span
                            class="rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs text-white/90">Auto
                            Notifikasi</span>
                        <span
                            class="rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs text-white/90">Laporan
                            & Export</span>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="relative z-10 grid grid-cols-3 gap-3">
                    <div class="rounded-xl border border-white/15 bg-white/10 p-4 text-center">
                        <div class="text-2xl font-semibold text-white">10</div>
                        <div class="mt-1 text-xs text-white/60">Total Kamar</div>
                    </div>
                    <div class="rounded-xl border border-white/15 bg-white/10 p-4 text-center">
                        <div class="text-2xl font-semibold text-white">5</div>
                        <div class="mt-1 text-xs text-white/60">Premium (AC)</div>
                    </div>
                    <div class="rounded-xl border border-white/15 bg-white/10 p-4 text-center">
                        <div class="text-2xl font-semibold text-white">H-3</div>
                        <div class="mt-1 text-xs text-white/60">Auto Alert</div>
                    </div>
                </div>
            </div>

            {{-- ===== RIGHT PANEL ===== --}}
            <div class="flex w-full flex-col justify-center px-10 py-10 lg:w-[45%] bg-white dark:bg-gray-900">
                {{ $slot }}
            </div>

        </div>
    </div>

    @livewireScripts
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
