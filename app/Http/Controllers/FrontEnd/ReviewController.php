<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'review' => 'required',
            'rating' => 'required',
        ]);

        try {
            $review = Review::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

            if ($review) {
                notify()->error("Sorry! Already you have a review for this product.", "Error");
                return back();
            }

            Review::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'review' => $request->review,
                'rating' => $request->rating
            ]);

            notify()->success("Review Submited Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Review Submit Failed.", "Error");
            return back();
        }
    }
}
