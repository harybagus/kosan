<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\Room;
use App\Models\Tenant;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $totalRooms     = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $occupiedRooms  = Room::where('status', 'occupied')->count();

        $activeTenants  = Tenant::where('status', 'active')->count();

        $revenueThisMonth = Payment::where('status', 'paid')
            ->whereMonth('paid_date', now()->month)
            ->whereYear('paid_date', now()->year)
            ->sum('amount');

        $revenueLastMonth = Payment::where('status', 'paid')
            ->whereMonth('paid_date', now()->subMonth()->month)
            ->whereYear('paid_date', now()->subMonth()->year)
            ->sum('amount');

        $overdueCount = Payment::where('status', 'overdue')->count();
        $dueSoonCount = Payment::where('status', 'due_soon')->count();

        // Hitung trend pendapatan
        $revenueTrend      = $revenueLastMonth > 0
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 1)
            : 0;
        $revenueTrendColor = $revenueTrend >= 0 ? 'success' : 'danger';
        $revenueTrendIcon  = $revenueTrend >= 0
            ? 'heroicon-m-arrow-trending-up'
            : 'heroicon-m-arrow-trending-down';

        return [
            Stat::make('Total Kamar', $totalRooms)
                ->description("{$occupiedRooms} terisi · {$availableRooms} tersedia")
                ->descriptionIcon('heroicon-m-home')
                ->color('primary')
                ->url(route('filament.admin.resources.rooms.index'))
                ->chart(
                    Room::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')
                        ->orderBy('date')
                        ->limit(7)
                        ->pluck('count')
                        ->toArray()
                ),

            Stat::make('Penghuni Aktif', $activeTenants)
                ->description('Dari ' . $totalRooms . ' total kamar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->url(route('filament.admin.resources.tenants.index')),

            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description(
                    ($revenueTrend >= 0 ? '+' : '') . $revenueTrend . '% dari bulan lalu'
                )
                ->descriptionIcon($revenueTrendIcon)
                ->color($revenueTrendColor)
                ->chart(
                    Payment::where('status', 'paid')
                        ->whereMonth('paid_date', now()->month)
                        ->selectRaw('DAY(paid_date) as day, SUM(amount) as total')
                        ->groupBy('day')
                        ->orderBy('day')
                        ->pluck('total')
                        ->toArray()
                ),

            Stat::make('Perlu Perhatian', $overdueCount + $dueSoonCount)
                ->description("{$overdueCount} terlambat · {$dueSoonCount} jatuh tempo")
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overdueCount > 0 ? 'danger' : 'warning')
                ->url(route('filament.admin.resources.payments.index')),
        ];
    }
}
