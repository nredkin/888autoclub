<?php

namespace App\Console;

use App\Console\Commands\InsuranceIsEnding;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('notify:insurance-is-ending')->cron('0 9 * * *');
         $schedule->command('insurance-is-ending-for-client')->cron('0 10 * * *')->timezone('Asia/Vladivostok');
         $schedule->command('notify:overdue-payment')->cron('0 9,14,19 * * *');
         $schedule->command('notify:payday-is-coming')->cron('0 9 * * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
