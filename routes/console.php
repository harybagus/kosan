<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Jalankan setiap hari jam 00:01 dini hari
Schedule::command('payments:update-status')
    ->dailyAt('00:01')
    ->withoutOverlapping()
    ->runInBackground();
