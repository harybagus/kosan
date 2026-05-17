<?php

namespace App\Exports;

use App\Models\Payment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MonthlyBreakdownSheet implements
    FromArray,
    WithHeadings,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function __construct(private int $year) {}

    public function array(): array
    {
        $rows = [];

        for ($month = 1; $month <= 12; $month++) {
            $revenue = Payment::where('status', 'paid')
                ->whereYear('paid_date', $this->year)
                ->whereMonth('paid_date', $month)
                ->sum('amount');

            $paid = Payment::where('status', 'paid')
                ->whereYear('paid_date', $this->year)
                ->whereMonth('paid_date', $month)
                ->count();

            $unpaid = Payment::whereIn('status', ['pending', 'due_soon', 'overdue'])
                ->whereYear('due_date', $this->year)
                ->whereMonth('due_date', $month)
                ->count();

            $total = $paid + $unpaid;

            $rows[] = [
                Carbon::create($this->year, $month)->translatedFormat('F'),
                Carbon::create($this->year, $month)->translatedFormat('Y'),
                $revenue,
                $paid,
                $unpaid,
                $total > 0 ? round(($paid / $total) * 100) . '%' : '—',
            ];
        }

        $totalRevenue = array_sum(array_column($rows, 2));
        $totalPaid = array_sum(array_column($rows, 3));
        $totalUnpaid = array_sum(array_column($rows, 4));

        $totalProgress = ($totalPaid + $totalUnpaid) > 0
            ? round(($totalPaid / ($totalPaid + $totalUnpaid)) * 100) . '%'
            : '—';

        $rows[] = [
            'TOTAL',
            '',
            $totalRevenue,
            $totalPaid,
            $totalUnpaid,
            $totalProgress,
        ];

        return $rows;
    }

    public function headings(): array
    {
        return ['Bulan', 'Tahun', 'Pendapatan (Rp)', 'Lunas', 'Belum Lunas', 'Progress (%)'];
    }

    public function styles(Worksheet $sheet): array
    {
        $lastRow = 14;

        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1D4ED8'],
                ],
            ],
            $lastRow => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DBEAFE'],
                ],
            ],
        ];
    }

    public function title(): string
    {
        return 'Laporan Bulanan';
    }
}
