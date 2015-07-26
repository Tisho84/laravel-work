<?php namespace App\Providers;

use App\Events\OrderShippedOn;
use App\Events\OrderWasCanceled;
use App\Events\OrderWasDelivered;
use App\Events\OrderWasPlaced;
use App\Events\OrderWasProcessed;
use App\Events\Registered;
use App\Handlers\Events\ClientRegistration;
use App\Handlers\Events\OrderAdminsConfirmation;
use App\Handlers\Events\OrderClientCancel;
use App\Handlers\Events\OrderClientConfirmation;
use App\Handlers\Events\OrderShippedOnHandler;
use App\Handlers\Events\OrderWasDeliveredAdminHandler;
use App\Handlers\Events\OrderWasDeliveredClientHandler;
use App\Handlers\Events\OrderWasProcessedHandler;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
		Registered::class => [
			ClientRegistration::class
		],
        OrderWasPlaced::class => [
            OrderClientConfirmation::class,
			OrderAdminsConfirmation::class
        ],
		OrderWasCanceled::class => [
			OrderClientCancel::class
		],
        OrderWasProcessed::class => [
            OrderWasProcessedHandler::class
        ],
        OrderShippedOn::class => [
            OrderShippedOnHandler::class
        ],
        OrderwasDelivered::class => [
            OrderWasDeliveredClientHandler::class,
            OrderWasDeliveredAdminHandler::class
        ]
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
