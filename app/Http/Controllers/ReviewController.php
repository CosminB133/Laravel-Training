<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('destroy');
    }

    public function store(Request $request)
    {
        $request->validate([
                'product_id' => 'required|exists:products,id',
                'rating' => 'required',
                'comments' => 'required',
        ]);

        $review = new Review();

        $review->fill([
                'comment' => $request->input('comments'),
                'rating' => $request->input('rating'),
        ]);
        $review->product()->associate($request->input('product_id'));

        $review->save();

        return redirect()->route('products.show', ['product' => $request->input('product_id')]);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('products.edit', ['product' => $review->product_id]);
    }
}
