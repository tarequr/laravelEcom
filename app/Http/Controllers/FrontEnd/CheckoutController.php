<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

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
        $check = Coupon::where('coupon_code', $request->coupon)->first();

        if ($check) {
            if (date('Y-m-d',strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                Session::put('coupon',[
                    'name' => $check->coupon_code,
                    'discount' => $check->coupon_amount,
                    'after_discount' => Cart::subtotal() - $check->coupon_amount,
                ]);
                notify()->success("Coupon Applied!", "Success");
                return redirect()->back();
            } else {
                notify()->error("Expired Coupon Code!", "Error");
                return redirect()->back();
            }
        } else {
            notify()->error("Invalid Coupon Code! Try again", "Error");
            return redirect()->back();
        }
    }

    public function couponRemove()
    {
        Session::forget('coupon');
        notify()->success("Session removed successfully", "Success");
        return redirect()->back();
    }

}
