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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Order $order, Product $product)
	{
        $select = ['-- Select --'];
        $categories = Category::active()->lists('name', 'id');
        $products = Product::sell()->lists('name', 'id');
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
        DB::transaction(function() use ($order, $product) {
            $oldQuantity = $order->products()->find($product->id)->pivot->quantity;
            $product->update(['quantity' => $product->quantity + $oldQuantity]);
            $order->products()->updateExistingPivot(
                $product->id, [
                    'product_id' => Input::get('product_id'),
                    'quantity' => Input::get('quantity')
                ]
            );
            $product = $order->products()->find(Input::get('product_id'));
            $newQuantity = $product->pivot->quantity;
            $order->products()->find(Input::get('product_id'))
                ->update(['quantity' => $product->quantity - $newQuantity]);

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
