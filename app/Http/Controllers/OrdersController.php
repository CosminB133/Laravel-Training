<?php

namespace App\Http\Controllers;

use App\Order;
use Validator;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('orders.index', ['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'comments' => 'required',
                'contact' => 'required',
            ]
        );

        if (!$request->session()->get('cart')) {
            $request->flash();
            return redirect()->route('cart')->withErrors(['empty_cart' => 'Cart is empty!']);
        }

        $products = array_map('App\Product::find', $request->session()->get('cart'));
        $orderPrice = array_reduce(
            $products,
            function ($sum, $product) {
                return $sum + $product->price;
            }
        );
        $order = new Order();
        $order->name = $validatedData['name'];
        $order->comments = $validatedData['comments'];
        $order->contact = $validatedData['contact'];
        $order->price = $orderPrice;
        $order->save();

        foreach ($products as $product) {
            $order->products()->attach([$product->id => ['price' => $product->price]]);
        }

        Mail::send(
            'orders.show',
            ['order' => $order],
            function ($message) {
                $message->to(config('services.admin.email'))->subject('Order');
            }
        );
        return redirect()->route('index');
    }

    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order]);
    }
}
