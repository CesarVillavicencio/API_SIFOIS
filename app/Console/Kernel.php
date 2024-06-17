<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('microsip:mongo:update')->dailyAt('21:00');
        // $schedule->command('reports:mongo:update')->dailyAt('21:40');
        // $schedule->command('mongo:dump')->dailyAt('01:00');
        // $schedule->command('mysql:dump')->dailyAt('01:10');
        // $schedule->command('rsync:backup')->dailyAt('01:20');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
