<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $this->validate(
            $request,
            [
                'product_id' => 'required|exists:products,id',
                'rating' => 'required',
                'comments' => 'required',
            ]
        );
        $review = new Review();
        $review->comment = $validatedData['comments'];
        $review->rating = $validatedData['rating'];
        $review->product_id = $validatedData['product_id'];
        $review->save();
        return redirect('/products/' . $validatedData['product_id']);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return redirect('/')->withErrors(['invalidId'=>'Invalid id!']);
        }
        $productId = $review->product_id;
        $review->delete();
        return redirect('/products/' . $productId . '/edit');
    }
}
