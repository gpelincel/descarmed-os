<?php

use App\Invokables\EmailOSDiaSeguinte;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(EmailOSDiaSeguinte::class)
    ->everyTenSeconds()
    ->sendOutputTo(storage_path('logs/mail_schedule.log'));
