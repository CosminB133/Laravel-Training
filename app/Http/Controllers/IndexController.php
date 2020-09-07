<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        if (session('cart')) {
            $products = Product::whereNotIn('id', session('cart'))->get();
        } else {
            $products = Product::all();
        }
        return view('index', ['products' => $products]);
    }
}
