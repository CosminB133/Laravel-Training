<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Element;
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
        $validatedData = $this->validate($request,
        [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'img' => 'required|mimes:jpg,jpeg,png,gif',
        ]);

        $product = new Product();
        $product['title'] = $validatedData['title'];
        $product['description'] = $validatedData['description'];
        $product['price'] = $validatedData['price'];
        $product->save();

        $path = public_path() . '/img/';
        $validatedData['img']->move($path, $product->id);

        return redirect('/products');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect('products');
        }
        return view('products.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $this->validate($request,
                        [
                            'title' => 'required',
                            'description' => 'required',
                            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                            'img' => 'required|mimes:jpg,jpeg,png,gif',
                        ]);

        $product = Product::find($id);
        if ($product) {
            $product['title'] = $validatedData['title'];
            $product['description'] = $validatedData['description'];
            $product['price'] = $validatedData['price'];
            $product->save();

            $validatedData['img']->move(public_path() . '/img/', $product->id);
        }

        return redirect('/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
