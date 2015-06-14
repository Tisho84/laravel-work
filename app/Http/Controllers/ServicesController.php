<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ServiceRequest;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $services = Service::all();

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ServiceRequest $request)
    {
        Service::create($request->all());

        return redirect('services');
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     *
     * @return Response
     * @internal param int $id
     *
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     *
     * @return Response
     * @internal param int $id
     *
     */
    public function edit(Service $service)
    {

        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Service $service
     *
     * @return Response
     * @internal param int $id
     *
     */
    public function update(Service $service)
    {
        $service->update(Input::all());

        return redirect('services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     *
     * @return Response
     * @throws \Exception
     * @internal param int $id
     *
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect('services');
    }

}
