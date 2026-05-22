<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">

            {{-- Brand --}}
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="text-xl font-semibold tracking-tight">
                    <span class="text-blue-600 dark:text-blue-400">Kos</span><span
                        class="text-gray-900 dark:text-white font-normal">an</span>
                </a>
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 leading-relaxed max-w-sm">
                    Platform manajemen kos modern yang menghubungkan penghuni dan pengelola dengan teknologi digital
                    yang transparan dan efisien.
                </p>
            </div>

            {{-- Navigasi --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Navigasi</h4>
                <ul class="space-y-2.5">
                    <li>
                        <a href="{{ route('home') }}#kamar"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Kamar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#fasilitas"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Fasilitas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#faq"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#kontak"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Kontak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rooms') }}"
                            class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Semua Kamar
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Kontak</h4>
                <ul class="space-y-2.5">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">+62 899-9977-7755</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">info@kosan.id</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Depok, Jawa Barat</span>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Bottom --}}
        <div
            class="border-t border-gray-100 dark:border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-500 ">
                © {{ date('Y') }} Kosan. Made with <span class="animate-pulse">❤️</span>
            </p>
            <p class="text-xs text-gray-500">
                Laravel 11 · Filament 3 · Livewire 3
            </p>
        </div>

    </div>
</footer>
