<?php namespace App\Events;

use App\Events\Event;

use App\Order;
use App\User;
use Illuminate\Queue\SerializesModels;

class OrderWasPlaced extends Event {

	use SerializesModels;

    public $user;
    public $order;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Order $order)
	{
		$this->user = $user;
        $this->order = $order;
	}

}
