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
        '\App\Console\Commands\MerchantWalletTransfer',
        '\App\Console\Commands\PatientWalletTransfer'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
<<<<<<< HEAD
        $schedule->command('commend:merchant_wallet_transfer')->everyMinute();
        $schedule->command('commend:patient_wallet_transfer')->everyMinute();
=======
        $schedule->command('commend:merchant_wallet_transfer')->hourly();
        $schedule->command('commend:patient_wallet_transfer')->hourly();
>>>>>>> e332ce50d17116d82142a2ced09664c7714cb9ca
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
