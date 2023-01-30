<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

}
