<?php

namespace App\Http\Controllers;

use App\Product;
use Validator;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create', session('data', []));
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('index')->withErrors(['invalidId' => 'Invalid id!']);
        }
        return view('products.show', ['product' => $product]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'img' => 'required|mimes:jpg,jpeg,png,gif',
            ]
        );

        $product = new Product();
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->save();

        $path = public_path() . '/img/';
        $request->img->move($path, $product->id);

        return redirect()->route('products');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->withErrors(['invalidId' => 'Invalid id!']);
        }
        return view('products.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'img' => 'required|mimes:jpg,jpeg,png,gif',
            ]
        );

        $product = Product::find($id);
        if (!$product) {
            $request->flash();
            return redirect()->route('products')->withErrors(['invalidId' => 'Invalid id!']);
        }

        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->save();

        $request->img->move(public_path() . '/img/', $product->id);

        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->withErrors(['invalidId' => 'Invalid id!']);
        }
        $product->delete();
        return redirect()->route('products');
    }
}
