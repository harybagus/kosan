<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1f2937;
            padding-bottom: 20px;
        }

        .header {
            background: #1d4ed8;
            color: white;
            padding: 20px 24px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 11px;
            opacity: 0.85;
        }

        .content {
            padding: 0 24px;
        }

        .summary {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            flex: 1;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
        }

        .stat-card .label {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .stat-card .value {
            font-size: 15px;
            font-weight: bold;
            color: #111827;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #1d4ed8;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 2px solid #1d4ed8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background: #1d4ed8;
            color: white;
            padding: 7px 8px;
            text-align: left;
            font-size: 10px;
        }

        td {
            padding: 6px 8px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 10px;
        }

        tr:nth-child(even) td {
            background: #f9fafb;
        }

        tr.total td {
            background: #dbeafe;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-overdue {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-soon {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-pending {
            background: #f3f4f6;
            color: #374151;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            margin-top: 20px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Laporan Keuangan Kosan</h1>
        <p>Tahun {{ $year }} · Dicetak
            {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}</p>
    </div>

    <div class="content">

        {{-- Summary --}}
        <table style="margin-bottom:16px;">
            <tr>
                <td style="width:25%;border:1px solid #e5e7eb;border-radius:6px;padding:10px;">
                    <div style="font-size:10px;color:#6b7280;">Total Pendapatan</div>
                    <div style="font-size:14px;font-weight:bold;color:#1d4ed8;">Rp
                        {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </td>
                <td style="width:25%;border:1px solid #e5e7eb;padding:10px;">
                    <div style="font-size:10px;color:#6b7280;">Pembayaran Lunas</div>
                    <div style="font-size:14px;font-weight:bold;color:#166534;">{{ $totalPaid }}</div>
                </td>
                <td style="width:25%;border:1px solid #e5e7eb;padding:10px;">
                    <div style="font-size:10px;color:#6b7280;">Belum Lunas</div>
                    <div style="font-size:14px;font-weight:bold;color:#991b1b;">{{ $totalUnpaid }}</div>
                </td>
                <td style="width:25%;border:1px solid #e5e7eb;padding:10px;">
                    <div style="font-size:10px;color:#6b7280;">Tingkat Hunian</div>
                    <div style="font-size:14px;font-weight:bold;color:#1d4ed8;">{{ $occupancyRate }}%</div>
                </td>
            </tr>
        </table>

        {{-- Laporan Bulanan --}}
        <div class="section-title">Rincian Pendapatan Bulanan</div>
        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th style="text-align:right;">Pendapatan</th>
                    <th style="text-align:center;">Lunas</th>
                    <th style="text-align:center;">Belum Lunas</th>
                    <th style="text-align:center;">Progress</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monthlyData as $row)
                    <tr>
                        <td>{{ explode(' ', $row['month'])[0] }}</td>
                        <td>{{ $row['year'] ?? $year }}</td>
                        <td style="text-align:right;">
                            {{ $row['revenue'] > 0 ? 'Rp ' . number_format($row['revenue'], 0, ',', '.') : '—' }}
                        </td>
                        <td style="text-align:center;">{{ $row['paid_count'] ?: '—' }}</td>
                        <td style="text-align:center;">{{ $row['unpaid_count'] ?: '—' }}</td>
                        <td style="text-align:center;">
                            @if ($row['total_count'] > 0)
                                {{ round(($row['paid_count'] / $row['total_count']) * 100) }}%
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td>TOTAL</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:right;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                    <td style="text-align:center;">{{ $totalPaid }}</td>
                    <td style="text-align:center;">{{ $totalUnpaid }}</td>
                    <td style="text-align:center;">
                        @if ($totalPaid + $totalUnpaid > 0)
                            {{ round(($totalPaid / ($totalPaid + $totalUnpaid)) * 100) }}%
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Detail Pembayaran --}}
        <div class="section-title">Detail Pembayaran</div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penghuni</th>
                    <th>Kamar</th>
                    <th style="text-align:right;">Jumlah</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $i => $payment)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $payment->tenant?->name ?? '—' }}</td>
                        <td>Kamar {{ $payment->room?->room_number ?? '—' }}</td>
                        <td style="text-align:right;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>{{ $payment->due_date?->format('d/m/Y') }}</td>
                        <td>
                            <span
                                class="badge {{ match ($payment->status) {
                                    'paid' => 'badge-paid',
                                    'overdue' => 'badge-overdue',
                                    'due_soon' => 'badge-soon',
                                    default => 'badge-pending',
                                } }}">
                                {{ match ($payment->status) {
                                    'paid' => 'Lunas',
                                    'overdue' => 'Terlambat',
                                    'due_soon' => 'Jatuh Tempo',
                                    default => 'Pending',
                                } }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            KosNusantara · Sistem Manajemen Kos · {{ config('app.url') }}
        </div>

    </div>

</body>

</html>
