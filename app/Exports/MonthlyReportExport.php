<?php

namespace App\Exports;

use App\Exports\MonthlyBreakdownSheet;
use App\Models\Payment;
use App\Models\Room;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MonthlyReportExport implements WithMultipleSheets
{
    public function __construct(private int $year) {}

    public function sheets(): array
    {
        return [
            new PaymentsExport($this->year),
            new MonthlyBreakdownSheet($this->year),
        ];
    }
}
