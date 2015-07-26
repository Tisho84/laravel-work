<?php namespace App\Handlers\Events;

use App\Events\OrderWasDelivered;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderWasDeliveredClientHandler implements ShouldBeQueued {

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
	 * @param  OrderWasDelivered  $event
	 * @return void
	 */
	public function handle(OrderWasDelivered $event)
	{
        $data = [
            'city' => $event->order->address->city,
            'date' => getCarbonDate(Carbon::now()),
            'address' => $event->order->address->street
        ];
        Mail::queue('emails.order.delivered', $data, function($message) use ($event)
        {
            $message->to($event->order->user->email, $event->order->user->getName())->subject('Order was delivered');
        });
	}

}
