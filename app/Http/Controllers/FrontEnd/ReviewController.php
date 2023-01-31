<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\WebsiteReview;
use App\Models\Wishlist;
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

    public function writeReview()
    {
        return view('frontend.customer.write_review');
    }

    public function writeReviewStore(Request $request)
    {
        $this->validate($request, [
            'review' => 'required',
            'rating' => 'required',
        ]);

        try {
            $checkExists = WebsiteReview::where('user_id',Auth::user()->id)->first();

            if ($checkExists) {
                notify()->error("Sorry! Review already exist.", "Error");
                return back();
            }

            WebsiteReview::create([
                'user_id' => Auth::id(),
                'name'    => Auth::user()->name,
                'review'  => $request->review,
                'rating'  => $request->rating,
                'status'  => 0
            ]);

            notify()->success("Review submited successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Review Submit Failed.", "Error");
            return back();
        }
    }

    public function wishlist($id)
    {
        try {
            $checkExists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();

            if ($checkExists) {
                notify()->error("Sorry! Already have it on wishlist.", "Error");
                return back();
            }

            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
            ]);

            notify()->success("Product added on your wishlist.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Wishlist Added Failed.", "Error");
            return back();
        }
    }
}
