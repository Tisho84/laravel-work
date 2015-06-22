<?php namespace App\Http\Controllers;

use App\AddressType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NameRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AddressTypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $results = AddressType::all();
        return view('address.types.index', compact('results'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('address.types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NameRequest $request)
	{
        AddressType::create($request->all());
        return redirect('/types/addresses')->with('success', 'Address type created');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(AddressType $type)
	{
		return view('address.types.edit', compact('type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AddressType $type, NameRequest $request)
	{
		$type->update($request->all());
        return redirect('/types/addresses')->with('success', 'Address type updated');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param AddressType $type
     * @return Response
     * @internal param int $id
     */
	public function destroy(AddressType $type)
	{
        try {
            $type->delete();
        } catch(QueryException $e) {
            return redirect('/types/addresses')->with('error', 'Address type cant be deleted, because its been already been used !');
        }
        return redirect('/types/addresses');
	}

}
