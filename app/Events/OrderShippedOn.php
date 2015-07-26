<?php namespace App\Events;

use App\Events\Event;

use App\Order;
use Illuminate\Queue\SerializesModels;

class OrderShippedOn extends Event {

	use SerializesModels;

    public $order;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Order $order)
	{
		$this->order = $order;
	}

}
