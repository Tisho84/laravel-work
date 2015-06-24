<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller {

    /*
     * middleware
     */
    public function __construct() 
    {
        $this->middleware('isAdmin', ['except' => ['index', 'show']]);
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $products = Product::with('category')->get();
        $view = 'index';
        if(!Auth::user()->is_admin) { 
            $view .= '_client';
        }
		return view('products.' . $view, compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categories = Category::lists('name', 'id');
        
		return view('products.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProductRequest $request)
	{
		Product::create($request->all());
        return redirect('products')->with('success', 'Product added !');
	}

    /**
     * Display the specified resource.
     *
     * @param Product $
     * @return Response
     * @internal param int $id
     */
	public function show(Product $product)
	{
		return view('products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Product $product)
	{
        $categories = Category::lists('name', 'id');

		return view('products.edit', compact('product', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Product $product, ProductRequest $request)
	{
        $product->update($request->all());
        return redirect('products')->with('success', 'Product updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Product $product)
	{
        try {
            $product->delete();
        } catch(QueryException $e) {
            return redirect('products')->with('error', 'Product cant be deleted, because its been already ordered !');
        }
        return redirect('products');

	}

    public function getProductPrice($id)
    {
        $product = Product::findOrFail($id);
        return $product->price;
    }

}
