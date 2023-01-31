<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('frontend.customer.dashboard');
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
