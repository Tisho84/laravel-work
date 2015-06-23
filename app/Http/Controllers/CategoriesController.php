<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\NameRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller {

    /*
     * middleware
     */
    public function __construct() 
    {
        $this->middleware('isAdmin', ['except' => 'show']);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

        return view('categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categories.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
	public function store(NameRequest $request)
	{
        //$this->validate($request, Category::$rules);
        Category::create($request->all());

        return redirect('categories')->with('success', 'Category added !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Category $category)
	{
		$category->load('products');
        $products = $category->products()->get();
        $view = 'show';
        if(!Auth::user()->is_admin) {
            $view .= '_client';
        }
        
        return view('categories.' . $view, compact('category', 'products'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Category $category)
	{
		return view('categories.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Category $category, NameRequest $request)
	{
		$category->update($request->all());

        return redirect('categories')->with('success', 'Category updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Category $category)
	{
        $category->delete();

        return redirect('categories');
	}

}
