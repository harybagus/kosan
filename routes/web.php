<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reports/export/pdf', function () {
        return redirect('/admin/reports');
    })->name('reports.export.pdf');

    Route::get('/admin/reports/export/excel', function () {
        return redirect('/admin/reports');
    })->name('reports.export.excel');
});
