<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            notify()->error("Please login your account.", "Error");
            return redirect()->back();
        } else {
            $contents = Cart::content();
            return view('frontend.cart.checkout',compact('contents'));
        }
    }

    public function applyCoupon(Request $request)
    {
        # code...
    }
}
