<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use App\PaymentType;
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
    public function show($id)
    {
        $payment = Payment::with(
            'order.user', 'type', 'order.products', 'order.status', 'order.products.category'
        )->findOrFail($id);

        return view('payments.show', compact('payment'));
    }
}
