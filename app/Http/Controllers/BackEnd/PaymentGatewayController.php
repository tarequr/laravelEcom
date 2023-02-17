<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\PaymentGatewayBD;
use Illuminate\Support\Facades\Log;
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
        try {
            $aamarpay = PaymentGatewayBD::findOrFail($request->id);
            $aamarpay->update([
                'store_id' => $request->store_id,
                'signature_key' => $request->signature_key,
                'status' => $request->filled('status')
            ]);

            notify()->success("Payment Updated Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Payment Update Failed.", "Error");
            return back();
        }
    }

    public function shurjopayUpdate(Request $request)
    {
        try {
            $shurjopay = PaymentGatewayBD::findOrFail($request->id);
            $shurjopay->update([
                'store_id' => $request->store_id,
                'signature_key' => $request->signature_key,
                'status' => $request->filled('status')
            ]);

            notify()->success("Payment Updated Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Payment Update Failed.", "Error");
            return back();
        }
    }
}
