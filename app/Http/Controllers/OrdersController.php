<?php namespace App\Http\Controllers;

use App\Category;
use App\Classes\AddressType;
use App\Classes\OrderStatus;
use App\Events\OrderWasCanceled;
use App\Events\OrderWasPlaced;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrdersController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('isActive', ['except' => ['index', 'show']]);
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = 'orders.index';
        $statuses = [];
        if ($this->user->is_admin) {
            $statuses = OrderStatus::$statuses;
            if (Input::get('status')) {
                $orders = Order::where('status', Input::get('status'))->with('user', 'products')->get();
            } else {
                $orders = Order::with('user', 'products')->get();
            }
        } else {
            $view .= '_client';
            if (!Input::get('status')) {
                $orders = $this->user->orders()->with('products')->get();
            } else {
                $orders = $this->user->orders()->where('status', Input::get('status'))->with('products')->get();
            }
        }
        return view($view, compact('orders', 'statuses'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
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
        return view('orders.create', compact('products', 'selectedProducts'));
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

        DB::transaction(function() use ($data){
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
            $order->setQuantity($increase = false);
            event(new OrderWasPlaced($this->user, $order));
        });
        return redirect(route('orders.index'))->with('success', 'Order successful created');
    }

    /**
     * edit Order $order
     */
    public function edit(Order $order)
    {
        if (!$this->user->isAuthorized($order) || !$order->canEdit()) {
            return redirect(route('orders.index', [$order->id]))->with('error', 'You can\'t edit that order');
        }
        $order->load('products', 'products.category');
        return view('orders.edit', compact('order'));
    }

    /**
     * update $order
     */
    public function update(Order $order)
    {
        if (!$this->user->isAuthorized($order) || !$order->canEdit()) {
            return redirect(route('orders.index', [$order->id]))->with('error', 'You can\'t edit that order');
        }
        $user = User::findOrFail(Input::get('user'));
        DB::transaction(function() use ($order, $user){
            $order->user()->associate($user)->save();
            if ($order->status != Input::get('status')) { #if status changed
                $order->update(['status' => Input::get('status')]);
            }
        });

        return redirect(route('orders.index'))->with('success', 'Order data changed');
    }

    /**
     * @param Order $order
     * show order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        if (!$this->user->isAuthorized($order)) {
            return redirect(route('orders.index'))->with('error', 'Order not found.');
        }

        $users = array();
        if ($this->user->is_admin) {
            $users = User::lists('username', 'id');
        }

        $order->load('user', 'products', 'products.category');
        $statuses = OrderStatus::$statuses;
        return view('orders.show', compact('order', 'users', 'statuses'));
    }

    /**
     * get products by selected category used with ajax
     * @param $id
     * @return mixed
     */
    public function destroy(Order $order)
    {
        if (!$this->user->isAuthorized($order)) {
            return redirect()->back()->with('error', 'Order not deleted.');
        }
        DB::transaction(function() use ($order) {
            $order->setQuantity(true);
            $order->delete();
        });
        return redirect()->back()->with('success', 'Order deleted.');
    }

    public function cancel($orderId)
    {
        $order = Order::findOrFail($orderId);
        if (!$this->user->isAuthorized($order)) {
            return redirect()->back()->with('error', 'Order not canceled u don\'t have permissions.');
        }

        $return = $order->canCancel();//$order->status != 1 && $order->status != 2 && $order->status != 3 ? true: false; #if status is (New,Processed, Prepared) allow cancel)

        if(!$return || $order->status == 100) {
            return redirect()->back()->with('error', 'Order can\'t be canceled.');
        }

        DB::transaction(function () use ($order) {
            $order->update(['status' => 100]); #update order to canceled
            $order->setQuantity($increase = true); #increase products quantity
            event(new OrderWasCanceled($order, Auth::user()));
        });

        return redirect(route('orders.index'))->with('success', 'Order was canceled');

    }
}
