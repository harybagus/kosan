<div>
    {{-- Header --}}
    <div class="mb-7">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Masuk ke Admin Panel
        </h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Gunakan akun yang telah didaftarkan
        </p>
    </div>

    {{-- Form --}}
    <form wire:submit.prevent="authenticate" class="space-y-5">

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Alamat Email <span class="text-red-500">*</span>
            </label>
            <input type="email" wire:model="data.email" required autofocus autocomplete="email"
                placeholder="name@email.com"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
            @error('data.email')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div x-data="{ show: false }">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Kata Sandi <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input x-bind:type="show ? 'text' : 'password'" wire:model="data.password" required
                    autocomplete="current-password" placeholder="••••••••"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 pr-11 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                <button type="button" x-on:click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300"
                    tabindex="-1">
                    <svg x-show="!show" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg x-show="show" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" />
                        <line x1="1" y1="1" x2="23" y2="23" />
                    </svg>
                </button>
            </div>
            @error('data.password')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" wire:model="data.remember" id="remember"
                class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 dark:bg-gray-800">
            <label for="remember" class="text-sm text-gray-600 dark:text-gray-400">
                Ingat saya
            </label>
        </div>

        {{-- Submit button --}}
        <button type="submit" wire:click="authenticate" wire:loading.attr="disabled"
            class="w-full rounded-lg bg-blue-700 dark:bg-blue-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 disabled:opacity-70 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="authenticate">
                Masuk ke Dashboard
            </span>

            <span wire:loading wire:target="authenticate" style="display: none;">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Memproses...
            </span>
        </button>

    </form>

    {{-- Divider --}}
    <div class="my-5 flex items-center gap-3">
        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
        <span class="text-xs text-gray-400 dark:text-gray-600">atau</span>
        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
    </div>

    {{-- Return to the main page --}}
    <p class="text-center text-sm text-gray-500 dark:text-gray-400">
        Kembali ke
        <a href="{{ url('/') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
            Halaman Utama
        </a>
    </p>

    {{-- Version badge --}}
    <div class="mt-6 flex justify-center">
        <div
            class="inline-flex items-center gap-1.5 rounded-full border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 px-3 py-1">
            <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
            <span class="text-xs text-gray-400 dark:text-gray-500">
                Laravel 11 · Filament 3 · Livewire 3
            </span>
        </div>
    </div>
</div>
