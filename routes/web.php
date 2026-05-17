<?php

use App\Http\Controllers\ReportExportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reports/export/pdf/{year}', [ReportExportController::class, 'exportPdf'])
        ->name('reports.export.pdf');

    Route::get('/admin/reports/export/excel/{year}', [ReportExportController::class, 'exportExcel'])
        ->name('reports.export.excel');
});
