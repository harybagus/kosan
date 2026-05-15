<?php

namespace App\Filament\Pages;

use App\Models\Payment;
use App\Models\Room;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Attributes\Computed;

class Reports extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Laporan & Analitik';
    protected static ?string $title           = 'Laporan & Analitik';
    protected static ?int    $navigationSort  = 4;
    protected static string  $view            = 'filament.pages.reports';

    // Filter state
    public string $selectedYear  = '';
    public string $selectedMonth = '';

    public function mount(): void
    {
        $this->selectedYear  = (string) now()->year;
        $this->selectedMonth = '';
    }

    // =========================================================
    // STATS SUMMARY
    // =========================================================
    #[Computed]
    public function summaryStats(): array
    {
        $year = $this->selectedYear;

        $totalRevenue = Payment::where('status', 'paid')
            ->whereYear('paid_date', $year)
            ->sum('amount');

        $totalPaid = Payment::where('status', 'paid')
            ->whereYear('paid_date', $year)
            ->count();

        $totalUnpaid = Payment::whereIn('status', ['pending', 'due_soon', 'overdue'])
            ->whereYear('due_date', $year)
            ->count();

        $totalPayments = Payment::whereYear('due_date', $year)->count();

        $avgPerMonth = $totalRevenue > 0
            ? $totalRevenue / 12
            : 0;

        $occupancyRate = Room::count() > 0
            ? round((Room::where('status', 'occupied')->count() / Room::count()) * 100)
            : 0;

        return [
            'total_revenue'   => $totalRevenue,
            'total_paid'      => $totalPaid,
            'total_unpaid'    => $totalUnpaid,
            'total_payments'  => $totalPayments,
            'avg_per_month'   => $avgPerMonth,
            'occupancy_rate'  => $occupancyRate,
        ];
    }

    // =========================================================
    // MONTHLY BREAKDOWN
    // =========================================================
    #[Computed]
    public function monthlyData(): array
    {
        $year = $this->selectedYear;
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $paid = Payment::where('status', 'paid')
                ->whereYear('paid_date', $year)
                ->whereMonth('paid_date', $month)
                ->sum('amount');

            $paidCount = Payment::where('status', 'paid')
                ->whereYear('paid_date', $year)
                ->whereMonth('paid_date', $month)
                ->count();

            $unpaidCount = Payment::whereIn('status', ['pending', 'due_soon', 'overdue'])
                ->whereYear('due_date', $year)
                ->whereMonth('due_date', $month)
                ->count();

            $data[] = [
                'month'        => Carbon::create($year, $month)->translatedFormat('F Y'),
                'month_short'  => Carbon::create($year, $month)->translatedFormat('M'),
                'revenue'      => $paid,
                'paid_count'   => $paidCount,
                'unpaid_count' => $unpaidCount,
                'total_count'  => $paidCount + $unpaidCount,
            ];
        }

        return $data;
    }

    // =========================================================
    // ROOM TYPE BREAKDOWN
    // =========================================================
    #[Computed]
    public function roomTypeData(): array
    {
        $year = $this->selectedYear;

        return [
            'standard_revenue' => Payment::where('status', 'paid')
                ->whereYear('paid_date', $year)
                ->whereHas('room', fn($q) => $q->where('type', 'standard'))
                ->sum('amount'),

            'premium_revenue' => Payment::where('status', 'paid')
                ->whereYear('paid_date', $year)
                ->whereHas('room', fn($q) => $q->where('type', 'premium'))
                ->sum('amount'),

            'standard_count' => Room::where('type', 'standard')->count(),
            'premium_count'  => Room::where('type', 'premium')->count(),
        ];
    }

    // =========================================================
    // TOP TENANTS
    // =========================================================
    #[Computed]
    public function topTenants(): \Illuminate\Support\Collection
    {
        $year = $this->selectedYear;

        return Payment::where('status', 'paid')
            ->whereYear('paid_date', $year)
            ->with(['tenant', 'room'])
            ->selectRaw('tenant_id, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('tenant_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    // =========================================================
    // YEAR OPTIONS
    // =========================================================
    public function getYearOptions(): array
    {
        $currentYear = now()->year;
        $options = [];
        for ($y = $currentYear; $y >= $currentYear - 4; $y--) {
            $options[(string) $y] = (string) $y;
        }
        return $options;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->url(fn() => route('reports.export.pdf', ['year' => $this->selectedYear]))
                ->openUrlInNewTab(),

            Action::make('export_excel')
                ->label('Export Excel')
                ->icon('heroicon-o-table-cells')
                ->color('success')
                ->url(fn() => route('reports.export.excel', ['year' => $this->selectedYear]))
                ->openUrlInNewTab(),
        ];
    }
}
