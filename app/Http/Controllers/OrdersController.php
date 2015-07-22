<?php namespace App\Http\Controllers;

use App\Category;
use App\Classes\AddressType;
use App\Classes\OrderStatus;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Product;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = 'orders.index';
        $user = Auth::user();
        if ($user->is_admin) {
            $orders = Order::with('user', 'products')->get();
        } else {
            $view .= '_client';
            $orders = $user->orders()->with('products')->get();
        }
        return view($view, compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!Auth::user()->active) {
            return redirect()->back()->with('error', 'You cant shop from our store(not active)');
        }

        $selectedProducts = [];
        if (session()->has('products')) {
            $selectedProducts = session()->pull('products');;
        }

        $select = [ 0 => '-- Select --' ];
        $productsModel = Product::sell()->get();
        $products = [];
        foreach ($productsModel as $product) {
            $products[$product->id] = $product->name . ' - price ' . $product->price;
        }
        if (Input::get('product') && empty($selectedProducts)) {
            $selectedProducts[] = [ 'product_id' => Input::get('product'), 'quantity' => 1 ];
        }
        $products = $select + $products;
        return view('orders.create', compact('products', 'order', 'selectedProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $product = $request->get('product');
        $quantity = $request->get('quantity');
        $data = [];
        for ($i = 0; $i < count($product); $i++) {
            if (!$product[$i] || !$quantity[$i] || $quantity[$i] <= 0 || !is_integer((int)$quantity[$i])) {
                $errors[] = 'product and quantity is required and > 0';
            }
            $data[] = [
                'product_id' => $product[$i],
                'quantity' => $quantity[$i]
            ];
        }

        if (isset($errors) && count($errors) > 0) {
            return redirect()->back()->withErrors($errors)->with('products', $data);
        }

        $ids = implode(',', $product);
        $products = Product::whereRaw("id IN ({$ids})")->get();
        $counter = 0;
        foreach ($products as $product) {
            if ($product->quantity < $data[$counter]['quantity']) {
                $errors[] = $product->name . 'quantity must be reduced' . ' max(' . $product->quantity . ')';
            }
            $counter++;
        }

        if (isset($errors) && count($errors) > 0) {
            return redirect()->back()->withErrors($errors)->with('products', $data);
        }

        DB::transaction(function() use ($data){ #todo quantity --
            $newData = [];
            foreach ($data as $value) {
                $newData[$value['product_id']] = ['quantity' => $value['quantity']];
            }
            $order = Order::create([
                'status' => 1,
                'user_id' => Auth::user()->id,
                'address_id' => null,
            ]);
            $order->products()->attach($newData);
        });
        return redirect(route('orders.index'))->with('success', 'Order successful');
    }

    /**
     * edit Order $order
     */
    public function edit(Order $order)
    {
        if (!$order->isAuthorized()) {
            return redirect(route('orders.index', [$order->id]))->with('error', 'You can\'t edit that order');
        }
        if ($order->status != 1 && !Auth::user()->is_admin) {
            return redirect(route('orders.show', [$order->id]))->with('error', 'Order can\'t be edited.');
        }
        $order->load('products', 'products.category');
        return view('orders.edit', compact('order'));
    }

    /**
     * update $order
     */
    public function update(Order $order)
    {
        $user = User::findOrFail(Input::get('user'));
        $order->user()->associate($user);
        $order->save();
        return redirect(route('orders.index'))->with('success', 'Order owner changed');
    }

    /**
     * @param Order $order
     * show order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        if(!$order->isAuthorized()){
            return redirect(route('orders.index'))->with('error', 'Order not found.');
        }
        $users = array();
        if (Auth::user()->is_admin) {
            $users = User::lists('username', 'id');
        }
        $order->load('products', 'products.category');
        $canEdit = $order->status == 1 ? true : false;
        if (Auth::user()->is_admin) {
            $canEdit = true;
        }
        return view('orders.show', compact('order', 'canEdit', 'users'));
    }

    /**
     * get products by selected category used with ajax
     * @param $id
     * @return mixed
     */
    public function destroy($order)
    {
        if (!$order->isAuthorized()) {
            return redirect()->back()->with('error', 'Order not deleted.');
        }

        if ($order->status == 1) {
            $order->delete();
        }

        if (Auth::user()->is_admin && $order->status != 1) {
            $products = $order->products()->get();
            DB::transaction(function() use ($products, $order) {
                foreach ($products as $product) { #increase quantity if status != 1
                    $product->update(['quantity' => $product->quantity + $product->pivot->quantity]);
                }
                $order->delete();
            });
        }
        return redirect()->back()->with('success', 'Order deleted.');
    }
}
