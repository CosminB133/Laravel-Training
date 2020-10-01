<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        return view('products.index', ['products' => Product::all()]);
    }

    public function create(Request $request)
    {
        return view('products.create');
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product, 'reviews' => $product->reviews]);
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();

        $product->fill([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
        ]);

        $product->save();

        $request->file('img')->storeAs('/public/img', $product->id);

        return redirect()->route('products.index');
    }


    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'img' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        $product->fill([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
        ]);

        $product->save();

        if ($request->file('img')) {
            $request->file('img')->storeAs('/public/img', $product->id);
        }

        return redirect()->route('products.index');
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        Storage::delete('public/img/' . $product->id);

        return redirect()->route('products.index');
    }
}
