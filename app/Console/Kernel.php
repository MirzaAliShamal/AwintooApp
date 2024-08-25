<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Client Table
        $schedule->command('notify:expiring-id')->daily();
        $schedule->command('notify:expiring-passports')->daily();
        // Rest info
        $schedule->command('notify:expiring-insurance')->daily();
        $schedule->command('notify:expiring-driver')->daily();
        $schedule->command('notify:expiring-police')->daily();
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
