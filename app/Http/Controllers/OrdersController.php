<?php namespace App\Http\Controllers;

use App\AddressType;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\PaymentType;
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
        //todo delete all address and payment = null, and orders() == 0
        $orders = Order::with('user', 'products', 'status')->get();
        foreach($orders as $order) {
            $amount = 0;
            foreach($order->products as $product) {
                $amount += $product->price * $product->pivot->quantity;
            }
            $order->amount = $amount;
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
        $categories = Category::lists('name', 'id');
        $products = Product::lists('name', 'id');
        $products = array_merge($select, $products);
        $categories = array_merge($select, $categories);

        //if id is set use already created order or create new
        if(Input::get('id')) {
            $order = Order::findOrFail(Input::get('id'));
        } else {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'address_id' => null,
                'payment_id' => null,
                'status_id' => 1,
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
                    //todo validaciika i tuka
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
        $order->load('products', 'status')->get();
        return view('orders.edit', compact('order'));
    }

    /**
     * @param Order $order
     * show order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
//        foreach($order->products()->get() as $product) {
//            //$product->total = $product->price * 
//        }
        //$order->load('products')->get();//, 'address', 'payment')->get();
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
        $products = $category->products()->get();
        $productsJSon = [];
        foreach($products as $product) {
            $productsJSon[$product->id] = ['name' => $product->name, 'price' => $product->price];
        }
        return $productsJSon;
    }

}
