<?php namespace App\Console\Commands;

use App\Events\OrderShippedOn;
use App\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TravelOrder extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'orders:travel';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set orders statuses to traveling.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 * updating status prepared to traveling
	 * @return mixed
	 */
	public function fire()
	{
        $orders = Order::with('user')->where('status', 3)->get();
        if ($orders) {
            foreach ($orders as $order) {
                $order->update([
                    'status' => 4,
                    'shipped_on' => Carbon::now(),
                    'expected_delivery_on' => Carbon::now()->addDay()
                ]);
                event(new OrderShippedOn($order));
            }
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		//	['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
