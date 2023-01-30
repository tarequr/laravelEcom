<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

}
