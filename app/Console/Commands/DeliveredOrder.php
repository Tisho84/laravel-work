<?php namespace App\Console\Commands;

use App\Events\OrderWasDelivered;
use App\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeliveredOrder extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'orders:deliver';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Change order status to delivered.';

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
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $orders = Order::with('user', 'address')->where('status', 4)->where('expected_delivery_on', '<', Carbon::now())->get();
        if ($orders) {
            foreach ($orders as $order) {
                $order->update([
                    'status' => 5,
                    'delivered_on' => Carbon::now()
                ]);
                event(new OrderWasDelivered($order));
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
			//['example', InputArgument::REQUIRED, 'An example argument.'],
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
