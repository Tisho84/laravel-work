<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
        'App\Console\Commands\ProcessOrder',
        'App\Console\Commands\TravelOrder',
        'App\Console\Commands\DeliveredOrder'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
//		$schedule->command('inspire')
//				 ->hourly();
        $schedule->command('orders:processed')->hourly();
        $schedule->command('orders:travel')->dailyAt('18:30');
        $schedule->command('orders:deliver')->dailyAt('19:00');
    }

}
