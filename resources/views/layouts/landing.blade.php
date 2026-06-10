<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kosan — Hunian Nyaman & Modern')</title>

    <script>
        (function() {
            const stored = localStorage.getItem('kos-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white font-sans antialiased transition-colors duration-300">
    @include('landing.partials.navbar')

    @yield('content')

    @include('landing.partials.footer')

    {{-- Back to Top Button --}}
    <button x-data="{ show: false }" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })" x-show="show"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-50 w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center transition-colors"
        style="display: none;" title="Kembali ke atas">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <polyline points="18 15 12 9 6 15" />
        </svg>
    </button>
</body>

</html>
