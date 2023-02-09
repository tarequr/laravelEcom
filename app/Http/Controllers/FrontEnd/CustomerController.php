<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function customerLogin()
    {
        return view('frontend.customer.login');
    }

    public function dashboard()
    {
        $orders          = Order::where('user_id', Auth::id())->orderBy('id','DESC')->take(10)->get();
        $complete_orders = Order::where('user_id', Auth::id())->where('status',3)->count();
        $return_orders   = Order::where('user_id', Auth::id())->where('status',4)->count();
        $cancel_orders   = Order::where('user_id', Auth::id())->where('status',5)->count();

        return view('frontend.customer.dashboard',compact('orders','complete_orders','return_orders','cancel_orders'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.home');
    }

    public function setting()
    {
        return view('frontend.customer.setting');
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request,[
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        $hassedPassword = $user->password;

        if (Hash::check($request->current_password, $hassedPassword)) {
            if (!Hash::check($request->password, $hassedPassword)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                return redirect()->route('frontend.home');
            }else{
                notify()->warning('New password can not be as old password!', 'Warning');
            }
        }else{
            notify()->error('Current password not match!','Error');
        }

        return back();
    }

}
