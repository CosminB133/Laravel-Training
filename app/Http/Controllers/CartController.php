<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $products = session('cart') ? Product::whereIn('id', $request->session()->get('cart'))->get() : [];

        return view('cart', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'id' => 'required|exists:products,id'
            ]
        );

        if (
            $request->session()->has('cart')
            && !in_array($request->id, $request->session()->get('cart'))
        ) {
            $request->session()->push('cart', $request->id);
        } else {
            $request->session()->put('cart', [$request->id]);
        }

        return redirect()->route('index');
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
                'id' => 'required|exists:products,id'
            ]
        );

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            array_splice(
                $cart,
                array_search($request->input('id'), $cart),
                1
            );
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }
}
