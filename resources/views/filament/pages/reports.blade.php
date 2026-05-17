<x-filament-panels::page>

    {{-- Filter Tahun --}}
    <div class="mb-8 flex items-center gap-4">

        <div class="flex items-center gap-3">

            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                Tahun:
            </span>

            <select wire:model.live="selectedYear"
                class="appearance-none rounded-xl
                    border border-gray-200 dark:border-white/10
                    bg-white dark:bg-gray-900
                    px-10 py-2.5 pr-10
                    text-sm font-medium text-gray-900 dark:text-white
                    shadow-sm
                    focus:border-primary-500
                    focus:ring-2 focus:ring-primary-500">

                @foreach ($this->getYearOptions() as $value => $label)
                    <option value="{{ $value }}">
                        {{ $label }}
                    </option>
                @endforeach

            </select>

        </div>

        <span class="hidden md:block text-sm text-gray-500 dark:text-gray-400">
            Menampilkan data tahun {{ $selectedYear }}
        </span>

    </div>

    {{-- Summary Stats --}}
    @php $stats = $this->summaryStats; @endphp

    <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2">

        {{-- Total Pendapatan --}}
        <div
            class="rounded-xl
            border border-gray-200 dark:border-white/5
            bg-white dark:bg-gray-900
            p-6 shadow-sm transition hover:shadow-md">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Pendapatan
                    </p>

                    <h3 class="mt-2 text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </h3>

                    <p class="mt-2 text-xs text-primary-600 dark:text-primary-400">
                        Avg. Rp {{ number_format($stats['avg_per_month'], 0, ',', '.') }} / bulan
                    </p>

                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl
                    bg-primary-50 text-primary-600
                    dark:bg-primary-500/10 dark:text-primary-400">

                    <x-heroicon-o-banknotes class="h-6 w-6" />

                </div>

            </div>

        </div>

        {{-- Pembayaran Lunas --}}
        <div
            class="rounded-xl
            border border-gray-200 dark:border-white/5
            bg-white dark:bg-gray-900
            p-6 shadow-sm transition hover:shadow-md">

            <div class="flex items-start justify-between">

                <div class="w-full">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Pembayaran Lunas
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-green-600 dark:text-green-400">
                        {{ $stats['total_paid'] }}

                        <span class="text-sm font-normal text-gray-400">
                            / {{ $stats['total_payments'] }}
                        </span>
                    </h3>

                    <div class="mt-4 h-2 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">

                        <div class="h-2 rounded-full bg-green-500"
                            style="width: {{ $stats['total_payments'] > 0 ? ($stats['total_paid'] / $stats['total_payments']) * 100 : 0 }}%">
                        </div>

                    </div>

                </div>

                <div
                    class="ml-4 flex h-12 w-12 items-center justify-center rounded-xl
                    bg-green-100 text-green-600 
                    dark:bg-green-500/10 dark:text-green-400">

                    <x-heroicon-o-check-circle class="h-6 w-6" />

                </div>

            </div>

        </div>

        {{-- Belum Lunas --}}
        <div
            class="rounded-xl
            border border-gray-200 dark:border-white/5
            bg-white dark:bg-gray-900
            p-6 shadow-sm transition hover:shadow-md">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Belum Lunas
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-red-600 dark:text-red-400">
                        {{ $stats['total_unpaid'] }}
                    </h3>

                    <p class="mt-2 text-xs italic text-gray-400">
                        Perlu tindak lanjut
                    </p>

                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl
                    text-red-600 dark:text-red-400
                    bg-red-100 dark:bg-red-500/10">

                    <x-heroicon-o-x-circle class="h-6 w-6" />

                </div>

            </div>

        </div>

        {{-- Tingkat Hunian --}}
        <div
            class="rounded-xl
            border border-gray-200 dark:border-white/5
            bg-white dark:bg-gray-900
            p-6 shadow-sm transition hover:shadow-md">

            <div class="flex items-start justify-between">

                <div class="w-full">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Tingkat Hunian
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-blue-600 dark:text-blue-400">
                        {{ $stats['occupancy_rate'] }}%
                    </h3>

                    <div class="mt-4 h-2 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">

                        <div class="h-2 rounded-full bg-blue-500" style="width: {{ $stats['occupancy_rate'] }}%">
                        </div>

                    </div>

                </div>

                <div
                    class="ml-4 flex h-12 w-12 items-center justify-center rounded-xl
                    text-blue-600 dark:text-blue-400
                    bg-blue-100 dark:bg-blue-500/10">

                    <x-heroicon-o-home-modern class="h-6 w-6" />

                </div>

            </div>

        </div>

    </div>

    {{-- Secondary Cards --}}
    <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Pendapatan per Tipe --}}
        <div
            class="lg:col-span-1 rounded-xl
            border border-gray-200 dark:border-white/5
            bg-white dark:bg-gray-900
            p-6 shadow-sm">

            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-gray-950 dark:text-white">
                Pendapatan per Tipe
            </h4>

            @php $roomType = $this->roomTypeData; @endphp

            <div class="space-y-4">

                {{-- Standard --}}
                <div
                    class="flex items-center justify-between rounded-xl
                    border border-gray-100 dark:border-white/5
                    bg-gray-50 dark:bg-gray-800
                    p-3">

                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                        Standard
                    </span>

                    <span class="text-sm font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($roomType['standard_revenue'], 0, ',', '.') }}
                    </span>

                </div>

                {{-- Premium --}}
                <div
                    class="flex items-center justify-between rounded-xl
                    border border-gray-300 dark:border-white/10
                    p-3">

                    <span class="text-sm font-medium italic text-gray-900 dark:text-white">
                        Premium ⭐
                    </span>

                    <span class="text-sm font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($roomType['premium_revenue'], 0, ',', '.') }}
                    </span>

                </div>

            </div>

        </div>

        {{-- Top Penghuni --}}
        <div
            class="lg:col-span-2 rounded-xl
            border border-gray-200 dark:border-white/5
            bg-white dark:bg-gray-900
            p-6 shadow-sm">

            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-gray-950 dark:text-white">
                Top Penghuni
            </h4>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                @foreach ($this->topTenants->take(3) as $index => $item)
                    <div
                        class="rounded-xl
                        border border-gray-100 dark:border-white/5
                        bg-gray-50/50 dark:bg-gray-800/30
                        p-4">

                        <p class="mb-1 text-xs font-bold text-primary-600 dark:text-primary-400">
                            Rank #{{ $index + 1 }}
                        </p>

                        <p class="truncate text-sm font-bold text-gray-900 dark:text-white">
                            {{ $item->tenant?->name ?? '—' }}
                        </p>

                        <p class="mt-2 text-lg font-black text-gray-900 dark:text-white">
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    {{-- Monthly Table --}}
    <div
        class="overflow-hidden rounded-xl
        border border-gray-200 dark:border-white/5
        bg-white dark:bg-gray-900
        shadow-sm">

        <div class="border-b border-gray-100 dark:border-white/5 px-6 py-4">

            <h3 class="text-base font-bold text-gray-950 dark:text-white">
                Rincian Pendapatan Bulanan
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr
                        class="bg-gray-50/50 dark:bg-gray-800/50
                        text-[10px] font-bold uppercase tracking-widest
                        text-gray-500 dark:text-gray-400">

                        <th class="px-6 py-4 text-left">
                            Bulan
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tahun
                        </th>

                        <th class="px-6 py-4 text-right">
                            Pendapatan
                        </th>

                        <th class="px-6 py-4 text-center">
                            Lunas
                        </th>

                        <th class="px-6 py-4 text-center">
                            Belum Lunas
                        </th>

                        <th class="px-6 py-4 text-center">
                            Progress
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-white/5">

                    @foreach ($this->monthlyData as $row)
                        <tr class="transition-colors hover:bg-gray-50/50 dark:hover:bg-gray-800/30">

                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $row['month'] }}
                            </td>

                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                {{ $row['year'] }}
                            </td>

                            <td class="px-6 py-4 text-right">

                                <span
                                    class="{{ $row['revenue'] > 0 ? 'font-bold text-gray-900 dark:text-white' : 'text-gray-400' }}">

                                    {{ $row['revenue'] > 0 ? 'Rp ' . number_format($row['revenue'], 0, ',', '.') : '—' }}

                                </span>

                            </td>

                            {{-- Lunas --}}
                            <td class="px-6 py-4 text-center">

                                @if ($row['paid_count'] > 0)
                                    <span
                                        class="inline-flex items-center justify-center rounded-full
                                        bg-green-100 dark:bg-green-900/30
                                        px-3 py-1 text-xs font-bold
                                        text-green-700 dark:text-green-400">

                                        {{ $row['paid_count'] }}

                                    </span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif

                            </td>

                            {{-- Belum Lunas --}}
                            <td class="px-6 py-4 text-center">

                                @if ($row['unpaid_count'] > 0)
                                    <span
                                        class="inline-flex items-center justify-center rounded-full
                                        bg-red-100 dark:bg-red-900/30
                                        px-3 py-1 text-xs font-bold
                                        text-red-700 dark:text-red-400">

                                        {{ $row['unpaid_count'] }}

                                    </span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif

                            </td>

                            {{-- Progress --}}
                            <td class="px-6 py-4 text-center">

                                @if ($row['total_count'] > 0)
                                    @php
                                        $pct = round(($row['paid_count'] / $row['total_count']) * 100);
                                    @endphp

                                    <div class="inline-flex items-center gap-3">

                                        <div class="h-2 w-24 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">

                                            <div class="h-2 rounded-full {{ $pct === 100 ? 'bg-green-500' : ($pct >= 50 ? 'bg-primary-500' : 'bg-red-500') }}"
                                                style="width: {{ $pct }}%">
                                            </div>

                                        </div>

                                        <span
                                            class="min-w-[36px] text-center text-[10px] font-bold text-gray-500 dark:text-gray-400">
                                            {{ $pct }}%
                                        </span>

                                    </div>
                                @else
                                    <span class="text-gray-400">
                                        —
                                    </span>
                                @endif

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-filament-panels::page>
