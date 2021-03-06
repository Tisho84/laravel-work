<?php namespace App\Http\Controllers;

use App\Address;
use App\Classes\AddressType;
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
        if($order->address !== null) {
            return redirect(route('orders.address.edit', [$order, $order->address_id]));
        }
        $types = AddressType::$types;
        $types = array_merge([0 => ' -- Select -- '], $types);
        return view('address.create', compact('order', 'types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AddressRequest $request, Order $order)
	{
        $order->address()->associate(Address::create($request->all()))->save();

        return redirect(route('orders.show', [$order->id]))->with('success', 'Address added');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Order $order, Address $address)
	{
        $types = AddressType::$types;
        $types = array_merge([0 => ' -- Select -- '], $types);
		return view('address.edit', compact('order', 'address', 'types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Order $order, Address $address, AddressRequest $request)
	{
        $address->update($request->all());
        return redirect('orders')->with('success', 'Order address information changed.');
	}
}
