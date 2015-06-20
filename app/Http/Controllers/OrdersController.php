<?php namespace App\Http\Controllers;

use App\AddressType;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\PaymentType;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
        $orders = Order::with('user', 'products', 'status')->get();
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

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'address_id' => null,
            'payment_id' => null,
            'status_id' => 1,
        ]);

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
                    $order = Order::find(Input::get('order'));
                    $order->products()->attach($product, ['quantity' => $quantity]);
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
     * @param Order $order
     * show order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order->load('user', 'service');
        return view('orders.show', compact('order'));
    }

    /**
     * @param Order $order
     * delete order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect('orders');
    }

    /**
     * get products by selected category used with ajax
     * @param $id
     * @return mixed
     */
    public function getProductsByCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category->products()->lists('name', 'id');
    }

}
