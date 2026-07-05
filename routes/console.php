<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('quicksmash:cleanup')
    ->everyMinute();

Schedule::command('quicksmash:purge')
    ->daily();