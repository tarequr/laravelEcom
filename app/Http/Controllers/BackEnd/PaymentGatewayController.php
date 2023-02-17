<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\PaymentGatewayBD;
use App\Http\Controllers\Controller;

class PaymentGatewayController extends Controller
{
    public function paymentGateway()
    {
        $aamarpay   = PaymentGatewayBD::first();
        $shurjopay  = PaymentGatewayBD::skip(1)->first();
        $sslcommerz = PaymentGatewayBD::skip(2)->first();

        return view('backend.payment_gateway.edit',compact('aamarpay','shurjopay','sslcommerz'));
    }

    public function aamarpayUpdate(Request $request)
    {
        # code...
    }
}
