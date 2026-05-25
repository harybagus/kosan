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
</body>

</html>
