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
        $this->diac($schedule);
        $this->drc($schedule);
        $this->drcLocal($schedule);
       /*
         $this->dlmc();
         $this->onetime();
        */
    }

    protected function diac($schedule)
    {
        $schedule->command('diac:incomplete-autocancel');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('diac:notice-expiry');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('diac:notify-expiry');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('diac:delete-draft');//->dailyAt('23:10')->withoutOverlapping();
    }
    
    protected function drc($schedule)
    {
        $schedule->command('drc:incomplete-autocancel');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('drc:notice-expiry');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('drc:notify-expiry');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('drc:delete-draft');//->dailyAt('23:10')->withoutOverlapping();
    }

    protected function drcLocal($schedule)
    {
        $schedule->command('drcLocal:incomplete-autocancel');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('drcLocal:notice-expiry');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('drcLocal:notify-expiry');//->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('drcLocal:delete-draft');//->dailyAt('23:10')->withoutOverlapping();
    }

    protected function dlmc($schedule)
    {
        $schedule->command('dlmc:incomplete-autocancel')->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('dlmc:notice-expiry')->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('dlmc:notify-expiry')->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('dlmc:notice-temp-license')->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('dlmc:notify-temp-license')->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('ddlmc:notify-renewal')->dailyAt('23:10')->withoutOverlapping();
    }

    protected function onetime($schedule)
    {
        $schedule->command('onetime:incomplete-autocancel')->dailyAt('23:10')->withoutOverlapping();
        $schedule->command('onetime:delete-draft')->dailyAt('23:10')->withoutOverlapping();
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
