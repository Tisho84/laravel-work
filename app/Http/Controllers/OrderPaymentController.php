<?php namespace App\Http\Controllers;

use App\AddressType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Payment;
use App\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OrderPaymentController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Order $order)
	{
        $payments = PaymentType::lists('name', 'id');
        $payments = array_merge([' -- Select -- '], $payments);
		return view('orders.payment', compact('order', 'payments'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Order $order, Request $request)
	{
        $this->validate($request, Payment::$rules['id']);
        $input = $request->all();
		$type = PaymentType::findOrFail($input['payment_type']);
        $input['type_id'] = $input['payment_type'];
        if($type->info) {
            $this->validate($request, Payment::$rules['info']);
        }
        $payment = Payment::create($input);
        $order->payment()->associate($payment)->save();

        return redirect('orders')->with('success', 'Your order accepted, we will contact you soon.');
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
     * get payment type info used with ajax
     * @param $id
     * @return mixed
     */
    public function getPaymentType($order, $type)
    {
        $type = PaymentType::findOrFail($type);
        return $type->info;
    }

}
