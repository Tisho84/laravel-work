<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrderProductsController extends Controller {
    /**
     * product add view
     * @param Order $order which will add product
     */
    public function create(Order $order)
    {
        if (!Auth::user()->active) {
            return redirect()->back()->with('error', 'You cant shop from our store(not active)');
        }

        if (!$order->isAuthorized()) {
            return redirect(route('orders.show', [$order->id]))->with('error', 'You cant add products to that order');
        }

        $products = [];
        $productsModel = Product::sell()->get();
        foreach ($productsModel as $product) {
            $products[$product->id] = $product->name . ' - price ' . $product->price;
        }
        $products = [ 0 => '-- Select --' ] + $products;
        return view('orders.products.create', compact('products', 'order'));
    }

    public function store(Order $order, OrderRequest $request)
    {
        if (!$order->isAuthorized()) {
            return redirect(route('orders.show', [$order->id]))->with('error', 'You cant add products to that order');
        }

        DB::transaction(function() use ($order, $request) {
            $id = $request->get('product_id');
            $quantity = $request->get('quantity');
            $order->products()->attach([$id => ['quantity' => $quantity]]);//todo increase same
            if ($order->status != 1) {
                $product = Product::find($id);
                $product->update(['quantity' => $product->quantity - $quantity]);
            }
        });
        return redirect(route('orders.edit', [$order->id]))->with('success', 'Product successfully added');
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Order $order, Product $product)
	{
        if (!$order->isAuthorized()) {
            return redirect(route('orders.edit', [$order->id]))->with('error', 'You can\'t change product');
        }

        $products = Product::sell()->lists('name', 'id');
        $pivot = $order->products()->find($product->id);

        if (!$pivot) {
            return redirect()->back()->with('error', 'This product don\'t belongs to that order');
        }
        $pivot = $pivot->pivot;

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
        if (!$order->isAuthorized()) {
            return redirect(route('orders.edit', [$order->id]))->with('error', 'You can\'t change product');
        }
        DB::transaction(function() use ($order, $product) {
            if ($order->status != 1) { #quantity must be changed
                $oldQuantity = $order->products()->find($product->id)->pivot->quantity;
                $product->update(['quantity' => $product->quantity + $oldQuantity]); #increase old product quantity
                $newProduct = Product::find(Input::get('product_id'));
                $newProduct->update(['quantity' => $newProduct->quantity - Input::get('quantity')]); #decrease new product quantity
            }
            $order->products()->updateExistingPivot(
                $product->id, [
                    'product_id' => Input::get('product_id'),
                    'quantity' => Input::get('quantity')
                ]
            );
        });
        return redirect(route('orders.edit', [$order->id]))->with('success', 'product changed');
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
            if ($order->status != 1) {
                $product->update([
                    'quantity' => $product->quantity + $order->products()->find($product->id)->pivot->quantity
                ]);
            }
            $order->products()->detach($product->id);
        });
        return redirect(route('orders.edit', $order->id));
	}

}
