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
        return redirect()->route('products.show', ['id' => $validatedData['id']]);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return redirect()->route('index')->withErrors(['invalidId'=>'Invalid id!']);
        }

        $review->delete();
        return redirect()->route('products.edit', ['id' => $review->product_id]);
    }
}
