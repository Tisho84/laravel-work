<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrderProductsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Order $order, Product $product)
	{
        $select = ['-- Select --'];
        $categories = Category::lists('name', 'id');
        $products = Product::lists('name', 'id');
        $products = array_merge($select, $products);
        $categories = array_merge($select, $categories);
        $pivot = $order->products()->find($product->id)->pivot;

        return view('orders.products.edit', compact('order', 'products', 'categories', 'product', 'pivot'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Order $order, Product $product, OrderRequest $request)
	{
        $product = Product::findOrFail(Input::get('product_id'));
        if(!$product->available || !$product->active) {
            return redirect()->back()->with('error', 'Product is not active or out of stock');
        }
        DB::transaction(function() use ($order, $product, $request){
            $pivot = OrderProduct::findOrFail(Input::get('pivot_id'));
            $oldQuantity = $pivot->quantity;
            $newQuantity = Input::get('quantity');
            $newProductQuantity = $oldQuantity - $newQuantity;
            dd($product->quantity);
            if($product->quantity < $newProductQuantity) {
                echo 'wtf';
                return redirect()->back()->with('error', 'Reduce quantity - max:', $newProductQuantity);
            }
            dd('ok');
            $pivot->delete();
            $order->products()->attach($product, ['quantity' => $newQuantity]);
            //refresh quantity + old - new
            $product->update(['quantity' => $newProductQuantity]);
            $pivot->delete();
        });
	}

	/**
	 * Remove the specified resource from storage.
	 * order product
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Order $order, Product $product)
	{
        DB::transaction(function() use ($product, $order){
            $product->update([
                'quantity' => $product->quantity + $order->products()->find($product->id)->pivot->quantity
            ]);
            $order->products()->detach($product->id);
        });
        return redirect(route('orders.show', $order->id));
	}

}
