<?php namespace App\Handlers\Events;

use App\Events\OrderWasProcessed;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderWasProcessedHandler implements ShouldBeQueued {

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
	 * @param  OrderWasProcessed  $event
	 * @return void
	 */
	public function handle(OrderWasProcessed $event)
	{
        $data = [
            'shipped' => $event->order->shipped_on,
        ];
        Mail::queue('emails.order.processed', $data, function($message) use ($event)
        {
            $message->to($event->order->user->email, $event->order->user->getName())->subject('Order was processed');
        });
	}

}
