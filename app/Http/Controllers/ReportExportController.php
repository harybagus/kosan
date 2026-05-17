<?php

namespace App\Http\Controllers;

use App\Exports\MonthlyReportExport;
use App\Exports\PaymentsExport;
use App\Models\Payment;
use App\Models\Room;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportController extends Controller
{
    public function exportExcel(int $year)
    {
        $filename = "laporan-keuangan-{$year}.xlsx";

        return Excel::download(
            new MonthlyReportExport($year),
            $filename
        );
    }

    public function exportPdf(int $year)
    {
        // Monthly breakdown
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $paid = Payment::where('status', 'paid')
                ->whereYear('paid_date', $year)
                ->whereMonth('paid_date', $month)
                ->count();

            $unpaid = Payment::whereIn('status', ['pending', 'due_soon', 'overdue'])
                ->whereYear('due_date', $year)
                ->whereMonth('due_date', $month)
                ->count();

            $monthlyData[] = [
                'month'        => Carbon::create($year, $month)->translatedFormat('F Y'),
                'revenue'      => Payment::where('status', 'paid')
                    ->whereYear('paid_date', $year)
                    ->whereMonth('paid_date', $month)
                    ->sum('amount'),
                'paid_count'   => $paid,
                'unpaid_count' => $unpaid,
                'total_count'  => $paid + $unpaid,
            ];
        }

        $payments = Payment::with(['tenant', 'room'])
            ->whereYear('due_date', $year)
            ->orderBy('due_date')
            ->get();

        $totalRooms   = Room::count();
        $pdf = Pdf::loadView('exports.report-pdf', [
            'year'          => $year,
            'monthlyData'   => $monthlyData,
            'payments'      => $payments,
            'totalRevenue'  => Payment::where('status', 'paid')->whereYear('paid_date', $year)->sum('amount'),
            'totalPaid'     => Payment::where('status', 'paid')->whereYear('paid_date', $year)->count(),
            'totalUnpaid'   => Payment::whereIn('status', ['pending', 'due_soon', 'overdue'])->whereYear('due_date', $year)->count(),
            'occupancyRate' => $totalRooms > 0
                ? round((Room::where('status', 'occupied')->count() / $totalRooms) * 100)
                : 0,
        ])->setPaper('a4', 'portrait');

        return $pdf->download("laporan-keuangan-{$year}.pdf");
    }
}
