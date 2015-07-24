<?php namespace App\Handlers\Events;

use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class ClientRegistration implements ShouldBeQueued {

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
	 * @param  Registered  $event
	 * @return void
	 */
	public function handle(Registered $event)
	{
		$data = [
			'username' => $event->user->username
		];
		Mail::queue('emails.registration', $data, function($message) use ($event)
		{
			$message->to($event->user->email, $event->user->getName())->subject('Registration successful');
		});
	}

}
