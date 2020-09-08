<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = session('cart') ? Product::whereNotIn('id', session('cart'))->get() : Product::all();
        return view('index', ['products' => $products]);
    }
}
