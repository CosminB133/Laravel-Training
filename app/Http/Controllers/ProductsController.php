<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PostDec;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,
        [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'img' => 'required|mimes:jpg,jpeg,png,gif',
        ]);

        $product = new Product();
        $product['title'] = $request['title'];
        $product['description'] = $request['description'];
        $product['price'] = $request['price'];
        $product->save();

        $path = public_path() . '/img/';
        $request->img->move($path, $product->id);

        return redirect('/products');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
                        [
                            'title' => 'required',
                            'description' => 'required',
                            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                            'img' => 'required|mimes:jpg,jpeg,png,gif',
                        ]);

        $product = Product::find($id);
        $product['title'] = $request['title'];
        $product['description'] = $request['description'];
        $product['price'] = $request['price'];
        $product->save();

        $request->img->move(public_path() . '/img/', $product->id);

        return redirect('/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
