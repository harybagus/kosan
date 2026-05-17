<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PaymentsExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function __construct(
        private int $year,
        private ?int $month = null
    ) {}

    public function query()
    {
        return Payment::with(['tenant', 'room'])
            ->whereYear('due_date', $this->year)
            ->when($this->month, fn($q) => $q->whereMonth('due_date', $this->month))
            ->orderBy('due_date');
    }

    public function headings(): array
    {
        return [
            'No',
            'Penghuni',
            'Nomor Kamar',
            'Tipe Kamar',
            'Jumlah (Rp)',
            'Jatuh Tempo',
            'Tanggal Bayar',
            'Status',
            'Metode Pembayaran',
            'Catatan',
        ];
    }

    public function map($payment): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $payment->tenant?->name ?? '—',
            'Kamar ' . ($payment->room?->room_number ?? '—'),
            ucfirst($payment->room?->type ?? '—'),
            $payment->amount,
            $payment->due_date?->format('d/m/Y') ?? '—',
            $payment->paid_date?->format('d/m/Y') ?? '—',
            match ($payment->status) {
                'pending'  => 'Pending',
                'due_soon' => 'Jatuh Tempo',
                'overdue'  => 'Terlambat',
                'paid'     => 'Lunas',
                default    => $payment->status,
            },
            match ($payment->payment_method) {
                'cash'     => 'Tunai',
                'transfer' => 'Transfer Bank',
                'qris'     => 'QRIS',
                default    => '—',
            },
            $payment->notes ?? '—',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            // Header row bold + background biru
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1D4ED8'],
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function title(): string
    {
        return 'Data Pembayaran';
    }
}
