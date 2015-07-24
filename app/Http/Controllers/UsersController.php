<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
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
    public function store(UserCreateRequest $request)
    {
        User::create($request->all());

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
        $user->load('orders', 'orders.products');
        $orders = $user->orders()->get();
        
        return view('users.show', compact('user', 'orders'));
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
    public function update(User $user, ProfileUpdateRequest $request)
    {
        $user->update($request->all());

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
        try {
            $user->delete();
        } catch(QueryException $e) {
            return redirect('users')->with('error', 'Cant delete this user has orders');
        }

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
