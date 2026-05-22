<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReportExportController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/kamar', [LandingController::class, 'rooms'])->name('rooms');
Route::get('/kamar/{room:room_number}', [LandingController::class, 'roomDetail'])->name('rooms.detail');
Route::post('/kontak', [LandingController::class, 'contact'])->name('contact.send');

// Fix route login → Filament
Route::get('/login', fn() => redirect('/admin/login'))->name('login');

// Export Reports
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reports/export/pdf/{year}', [ReportExportController::class, 'exportPdf'])
        ->name('reports.export.pdf');

    Route::get('/admin/reports/export/excel/{year}', [ReportExportController::class, 'exportExcel'])
        ->name('reports.export.excel');
});
