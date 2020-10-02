<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    public function index()
    {
        $orders = Order::all();

        return view('orders.index', ['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comments' => 'required',
            'contact' => 'required',
        ]);

        if (!$request->session()->get('cart')) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Cart is empty!'])->withInput();
        }

        $products = Product::whereIn('id', $request->session()->get('cart'))->get();

        $order = new Order();

        $order->fill([
            'name' => $request->input('name'),
            'comments' => $request->input('comments'),
            'contact' => $request->input('contact'),
            'price' => $products->sum('price'),
        ]);

        $order->save();

        foreach ($products as $product) {
            $order->products()->attach([$product->id => ['price' => $product->price]]);
        }
        Mail::to(config('services.admin.email'))->send(new OrderEmail($order, $products));

        return redirect()->route('index');
    }

    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order, 'products' => $order->products]);
    }
}
