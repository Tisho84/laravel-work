<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NameRequest;
use App\PaymentType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Name;

class PaymentTypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $results = PaymentType::all();
        return view('payments.types.index', compact('results'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('payments.types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NameRequest $request)
	{
        PaymentType::create($request->all());
        return redirect('types/payment')->with('success', 'Payment type added !');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(PaymentType $type)
	{
		return view('payments.types.edit', compact('type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PaymentType $type, NameRequest $request)
	{
        $type->update($request->all());
        return redirect('/types/payment')->with('success', 'Payment type updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(PaymentType $type)
	{
        try {
            $type->delete();
        } catch(QueryException $e) {
            return redirect('/types/payment')->with('error', 'Payment type cant be deleted, because its been already been used !');
        }
        return redirect('/types/payment');
	}

}
