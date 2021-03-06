<?php namespace App\Console\Commands;

use App\Events\OrderWasProcessed;
use App\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessOrder extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'orders:processed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update orders from pending to processed.';

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
		$orders = Order::with('user')->where('status', 1)->whereNotNull('address_id')->get();
        if (count($orders)) {
            foreach ($orders as $order) {
                $order->update(['status' => 2, 'processed_on' => Carbon::now()]);
                event(new OrderWasProcessed($order));
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
