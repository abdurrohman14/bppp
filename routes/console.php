<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('send-pakan-reminder')->at('08:00');
Schedule::command('send-pakan-reminder')->at('13:00');
Schedule::command('send-pakan-reminder')->at('22:29');
