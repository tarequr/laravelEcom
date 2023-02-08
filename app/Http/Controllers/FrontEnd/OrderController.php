<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function orderPlace(Request $request)
    {
        if (!Auth::check()) {
            notify()->error("Please login your account.", "Error");
            return redirect()->back();
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_id' => rand(100000,999999),
            'c_name' => $request->c_name,
            'c_email' => $request->c_email,
            'c_phone' => $request->c_phone,
            'c_country' => $request->c_country,
            'c_address' => $request->c_address,
            'c_zipcode' => $request->c_zipcode,
            'c_city' => $request->c_city,
            'c_extra_phone' => $request->c_extra_phone,
            'total' => Cart::total(),
            'subtotal' => Session::has('coupon') ? Cart::subtotal() : null,
            'coupon_code' => Session::has('coupon') ? Session::get('coupon')['name'] : null,
            'coupon_discount' => Session::has('coupon') ? Session::get('coupon')['discount'] : null,
            'after_discount' => Session::has('coupon') ? Session::get('coupon')['after_discount'] : null,
            'payment_type' => $request->payment_type,
            'tax' => 0,
            'shipping_charge' => 0,
            'date' => date('Y-m-d'),
            'status' => 0
        ]);

        if ($order){
            $contents = Cart::content();
            if ($contents) {
                foreach ($contents as $key => $row) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $row->id,
                        'product_name' => $row->name,
                        'color' => $row->options->color,
                        'size' => $row->options->size,
                        'quantity' => $row->qty,
                        'single_price' => $row->price,
                        'subtotal_price' => $row->price * $row->qty
                    ]);
                }
            }
        }

        Cart::destroy();
        if (Session::has('coupon')){
            Session::forget('coupon');
        }

        notify()->success("Order placed successfully!", "Success");
        return redirect('/');
    }
}
