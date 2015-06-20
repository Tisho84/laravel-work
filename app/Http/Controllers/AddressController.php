<?php namespace App\Http\Controllers;

use App\Address;
use App\AddressType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AddressRequest;
use App\Order;
use Illuminate\Http\Request;

class AddressController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo 'index';
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Order $order)
	{
        $types = AddressType::lists('name', 'id');
        return view('orders.address', compact('order', 'types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AddressRequest $request, Order $order)
	{
        $order->address()->associate(Address::create($request->all()))->save();

        return redirect(route('orders.payment.create', [$order->id]))->with('success', 'Address added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
