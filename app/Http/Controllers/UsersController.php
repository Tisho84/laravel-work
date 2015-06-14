<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        User::create(Input::all());

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     *
     * @param User $user
     *
     * @return Response
     */
    public function show(User $user)
    {
        $user->load('orders');

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     *
     * @return Response
     */
    public function update(User $user)
    {
        $user->update(Input::all());

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('users');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function viewProfile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    /**
     * @param ProfileUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect('home')->with('success', 'Profile updated!');
    }

}
