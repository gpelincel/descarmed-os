<?php

use App\Invokables\EmailOSDiaSeguinte;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(EmailOSDiaSeguinte::class)
    ->daily()
    ->sendOutputTo(storage_path('logs/mail_schedule.log'));

Schedule::command('backup:clean')->dailyAt('00:01');
Schedule::command('backup:run')->dailyAt('00:01');