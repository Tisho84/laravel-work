<?php namespace App\Handlers\Events;

use App\Events\OrderShippedOn;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderShippedOnHandler implements ShouldBeQueued {

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
	 * @param  OrderShippedOn  $event
	 * @return void
	 */
	public function handle(OrderShippedOn $event)
	{
        $data = [
            'expectedDate' => $event->order->expected_delivery_on,
        ];
        Mail::queue('emails.order.shipped', $data, function($message) use ($event)
        {
            $message->to($event->order->user->email, $event->order->user->getName())->subject('Order was shipped');
        });
	}

}
