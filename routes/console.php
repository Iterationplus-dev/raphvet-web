<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ── Scheduled tasks ────────────────────────────────────────────────────────────
// Send vaccination due reminders every morning at 8 AM
Schedule::command('vet:send-vaccination-reminders')->dailyAt('08:00');

// Send 24-hour appointment reminders every morning at 7 AM
Schedule::command('vet:send-appointment-reminders')->dailyAt('07:00');
