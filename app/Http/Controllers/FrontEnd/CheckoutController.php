<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            notify()->success("Please login your account.", "Error");
            return redirect()->back();
        } else {
            return view('frontend.cart.checkout');
        }


    }
}
