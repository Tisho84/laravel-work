<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller {

    /**
     * Display all payments
     */
    public function index()
    {
        $payments = Payment::with('order', 'type')->get();
        
        return view('payments.index', compact('payments'));
    }
    
    /*
     *  Show payment
     */
    public function show($id) {
        $payment = Payment::with(
                'order.user', 'type', 'order.products', 'order.status','order.products.category'
            )->findOrFail($id);
        if(count($payment->order->products()))
        {
            foreach($payment->order->products()->get() as $product) 
            {
                //dd($product->toArray());
            }
        }
        //dd($payment->toArray());
        return view('payments.show', compact('payment'));
    }

}
