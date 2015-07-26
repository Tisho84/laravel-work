<?php namespace App\Handlers\Events;

use App\Events\OrderWasPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderClientConfirmation implements ShouldBeQueued {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  OrderWasPlaced  $event
	 * @return void
	 */
	public function handle(OrderWasPlaced $event)
	{
		$data = [
			'amount' => $event->order->getAmount(),
			'date' => $event->order->created_at->format('Y-m-d')
		];
		Mail::queue('emails.order.placed', $data, function($message) use ($event)
		{
			$message->to($event->user->email, $event->user->getName())->subject('Order was placed');
		});
	}

}
