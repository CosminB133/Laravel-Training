<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->session()->get('cart') ? Product::whereNotIn('id', $request->session()->get('cart'))->get() : Product::all();

        return view('index', ['products' => $products]);
    }
}
