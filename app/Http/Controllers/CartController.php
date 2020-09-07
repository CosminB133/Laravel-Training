<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index()
    {
        if (session('cart')) {
            $products = Product::whereIn('id', session('cart'))->get();
        } else {
            $products = [];
        }
        return view('cart', ['products' => $products]);
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:products,id'
        ]);

        if ($request->session()->has('cart')) {
            $request->session()->push('cart', $request['id']);
        } else {
            $request->session()->put('cart', [$request['id']]);
        }
        return redirect('/');
    }

    public function removeFromCart(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:products,id'
        ]);

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            $index = array_search($request['id'], $cart);
            array_splice($cart, $index, 1);
            $request->session()->put('cart', $cart);
        }

        return redirect('/cart');
    }
}
