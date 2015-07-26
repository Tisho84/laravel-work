<?php namespace App\Handlers\Events;

use App\Events\OrderWasCanceled;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderClientCancel implements ShouldBeQueued{

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
	 * @param  OrderWasCanceled  $event
	 * @return void
	 */
	public function handle(OrderWasCanceled $event)
	{
		$admins = getAdmins();
		$data = [
			'username' => $event->order->user->username,
			'id' => $event->order->id
		];
		foreach ($admins as $admin) {
			Mail::queue('emails.admin.canceled', $data, function($message) use ($event, $admin)
			{
				$message->to($admin->email, $admin->getName())->subject('Order canceled');
			});
		}
	}

}
