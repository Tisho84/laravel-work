<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NameRequest;
use App\OrderStatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderStatusesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = OrderStatus::all();

        return view('statuses.index', compact('statuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('statuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NameRequest $request)
	{
		OrderStatus::create($request->all());

        return redirect('statuses')->with('success', 'Status added !');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(OrderStatus $status)
	{
		return view('statuses.edit', compact('status'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(NameRequest $request, OrderStatus $status)
	{
        $status->update($request->all());

        return redirect('statuses')->with('success', 'Status updated !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(OrderStatus $status)
	{
        try {
            $status->delete();
        } catch(QueryException $e) {
            return redirect('statuses')->with('error', 'Status cant be deleted, because its been already been used !');
        }
        return redirect('statuses');
	}

}
