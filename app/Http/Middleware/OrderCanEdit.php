<?php namespace App\Http\Middleware;

use App\Order;
use Closure;
use Illuminate\Auth\Guard;

class OrderCanEdit {

	protected $auth;
	protected $order;
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function __construct(Guard $auth, Order $order)
	{
		$this->auth = $auth;
		$this->order = $order;
	}

	public function handle($request, Closure $next)
	{
		dd($this->order);
		if (!$this->auth->is_admin) {

		}
		return $next($request);
	}

}
