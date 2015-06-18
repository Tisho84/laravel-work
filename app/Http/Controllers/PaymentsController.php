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
        $payments = Payment::with('order')->get();
        dd($payments);

        return view('payments.index', compact('payments'));
    }

}
