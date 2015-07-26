<?php namespace App\Handlers\Events;

use App\Events\OrderWasDelivered;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class OrderWasDeliveredAdminHandler implements ShouldBeQueued {

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
        $admins = getAdmins();
        $data = [
            'amount' => $event->order->getAmount(),
            'username' => $event->order->user->username,
            'date' => getCarbonDate(Carbon::now())
        ];
        foreach ($admins as $admin) {
            Mail::queue('emails.admin.delivered', $data, function($message) use ($admin)
            {
                $message->to($admin->email, $admin->getName())->subject('Order was delivered');
            });
        }
	}

}
