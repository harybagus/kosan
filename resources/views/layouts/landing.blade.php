<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kosan — Hunian Nyaman & Modern')</title>

    {{-- Cegah flash of wrong theme --}}
    <script>
        (function() {
            const theme = localStorage.getItem('kos-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
    isDark: localStorage.getItem('kos-theme') === 'dark' ||
        (!localStorage.getItem('kos-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
}" x-init="$watch('isDark', val => {
    localStorage.setItem('kos-theme', val ? 'dark' : 'light');
    document.documentElement.classList.toggle('dark', val);
});"
    class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white font-sans antialiased transition-colors duration-300">
    @include('landing.partials.navbar')

    @yield('content')

    @include('landing.partials.footer')
</body>

</html>
