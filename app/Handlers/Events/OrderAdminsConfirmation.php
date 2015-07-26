<?php namespace App\Handlers\Events;

use App\Events\OrderWasPlaced;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderAdminsConfirmation implements ShouldBeQueued {

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
		$admins = getAdmins();
		$data = [
			'amount' => $event->order->getAmount(),
			'username' => $event->user->username
		];
		foreach ($admins as $admin) {
			Mail::queue('emails.admin.placed', $data, function($message) use ($admin)
			{
				$message->to($admin->email, $admin->getName())->subject('Order was placed');
			});
		}
	}

}
