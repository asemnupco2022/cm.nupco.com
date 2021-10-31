<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {


        //new import schedulers
        $schedule->command('lbs:import-sap-po')->dailyAt('02:00'); //SAP Import and copy files

         //Run Notification Scheduler
         $schedule->command('lbs:notification-scheduler')->everyMinute(); //Execute Notification Scheduler for manual-automation
         $schedule->command('lbs:po-scheduler-filter')->daily(); //filter data for sending notification

         $schedule->command('queue:work')->everyFourMinutes();
//         $schedule->command('lbs:po-scheduler-filter')->daily();
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
