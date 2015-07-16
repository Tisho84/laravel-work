<?php namespace App\Http\Controllers;

use App\Category;
use App\Classes\AddressType;
use App\Classes\OrderStatus;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Product;
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
//        Order::with(['products' => function($query){
//            $query->where('')
//        }]);
        //todo delete all address and payment = null, and orders() == 0
        $user = Auth::user();
        if($user->is_admin) {
            $orders = Order::with('user', 'products')->get();
        } else {
            $orders = $user->orders()->with('products')->get();
        }
        foreach($orders as $order) {
            $order->status = OrderStatus::getStatus($order->status);
            $amount = 0;
            if($order->products) {
                foreach($order->products as $product) {
                    $amount += $product->price * $product->pivot->quantity;
                }
                $order->amount = $amount;
            }
        }
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $select = ['-- Select --'];
        $categories = Category::where('active', 1)->lists('name', 'id');
        $products = Product::sell()
            ->lists('name', 'id');
        $products = array_merge($select, $products);
        $categories = array_merge($select, $categories);
        if(!Auth::user()->active) {
            return redirect()->back()->with('error', 'You cant shop from our store');
        }
        //if id is set use already created order or create new
        if(Input::get('id')) {
            $order = Order::findOrFail(Input::get('id'));
        } else {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'address_id' => null,
                'status' => 1,
            ]);
        }
        return view('orders.create', compact('products', 'categories', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $product = Input::get('product');
            $quantity = Input::get('quantity');
            $product = Product::where('id', $product)
                ->where('available', '=', 1)
                ->where('active', '=', 1)
                ->first();
            $code = 200;
            $message = 'Product added successfully to cart';
            if ($product) {
                if ($product->quantity > $quantity) {
                    DB::transaction(function() use ($product, $quantity){
                        $product->update(['quantity' => $product->quantity - $quantity]);
                        $order = Order::find(Input::get('order'));
                        $order->products()->attach($product, ['quantity' => $quantity]);
                    });
                } else {
                    $message = 'reduce quantity';
                    $code = 400;
                }
            } else {
                $message = 'product is not available or active';
                $code = 400;
            }

            return response()->json(['message' => $message], $code);
        }
    }

    /**
     * edit Order $order
     */
    public function edit(Order $order)
    {
        $order->load('products')->get();
        return view('orders.edit', compact('order'));
    }

    /**
     * @param Order $order
     * show order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order->status = OrderStatus::getStatus($order->status);
        $order->address->type = AddressType::getType($order->address->type);
        return view('orders.show', compact('order'));
    }

    /**
     * get products by selected category used with ajax
     * @param $id
     * @return mixed
     */
    public function getProductsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()
            ->sell()
            ->get();
        $productsJSon = [];
        foreach($products as $product) {
            $productsJSon[$product->id] = ['name' => $product->name, 'price' => $product->price];
        }
        return $productsJSon;
    }

}
