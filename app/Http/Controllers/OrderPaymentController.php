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
        if($order->payment !== null) {
            return redirect(route('orders.payment.edit', [$order->id, $order->payment->id]));
        }
        $types = PaymentType::lists('name', 'id');
        $types = array_merge([' -- Select -- '], $types);
		return view('payments.create', compact('order', 'types'));
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
        $type = PaymentType::findOrFail($input['type_id']);
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
	public function edit(Order $order, Payment $payment)
    {
        if(!$payment->type->info) {
            return redirect()->back()->with('error', 'Payment cant be changed.');
        }
        return view('payments.edit', compact('order', 'payment'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Order $order, Payment $payment, Request $request)
    {
        if($payment->type->info) {
            $this->validate($request, Payment::$rules['info']);
            $payment->update($request->all());
        }
        return redirect('orders')->with('success', 'Order payment information changed.');
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
