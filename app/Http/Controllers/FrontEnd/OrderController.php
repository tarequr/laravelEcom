<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Order;
use App\Mail\InvoiceMail;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PaymentGatewayBD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function orderPlace(Request $request)
    {
        try {
            if (!Auth::check()) {
                notify()->error("Please login your account.", "Error");
                return redirect()->back();
            }

            $randNumber = rand(100000,999999);

            if ($request->payment_type == "hand_cash") {

                DB::beginTransaction();

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_id' => $randNumber,
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

                $orderMail['order_id'] = $randNumber;
                $orderMail['date'] = date('Y-m-d');
                $orderMail['total'] = Cart::total();
                $orderMail['c_name'] = $request->c_name;
                $orderMail['c_phone'] = $request->c_phone;
                $orderMail['c_address'] = $request->c_address;

                Mail::to($request->c_email)->send(new InvoiceMail($orderMail));

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

                DB::commit();

                Cart::destroy();
                if (Session::has('coupon')){
                    Session::forget('coupon');
                }

                notify()->success("Order placed successfully!", "Success");
                return redirect('/');

            } else if ($request->payment_type == "aamarpay") {
                $aamarpay = PaymentGatewayBD::first();

                if ($aamarpay->store_id == "") {
                    notify()->error("Please setting your payment gateway!", "Error");
                    return redirect('/');
                } else {
                    if ($aamarpay->status == 1) {
                        $url = 'https://secure.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
                    } else {
                        $url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
                    }

                    $fields = array(
                        'store_id' => $aamarpay->store_id, //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                        'amount' => '200', //transaction amount
                        'payment_type' => 'VISA', //no need to change
                        'currency' => 'BDT',  //currenct will be USD/BDT
                        'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
                        'cus_name' => $request->c_name,  //customer name
                        'cus_email' => $request->c_email, //customer email address
                        'cus_add1' => $request->c_address,  //customer address
                        'cus_add2' => 'Mohakhali DOHS', //customer address
                        'cus_city' => $request->c_city,  //customer city
                        'cus_state' => 'Dhaka',  //state
                        'cus_postcode' =>  $request->c_zipcode, //postcode or zipcode
                        'cus_country' => $request->c_country, //country
                        'cus_phone' => $request->c_phone, //customer phone number
                        'cus_fax' => $request->c_extra_phone,  //fax
                        'ship_name' => 'ship name', //ship name
                        'ship_add1' => 'House B-121, Road 21',  //ship address
                        'ship_add2' => 'Mohakhali',
                        'ship_city' => 'Dhaka',
                        'ship_state' => 'Dhaka',
                        'ship_postcode' => '1212',
                        'ship_country' => 'Bangladesh',
                        'desc' => 'payment description',
                        'success_url' => route('success'), //your success route
                        'fail_url' => route('fail'), //your fail route
                        'cancel_url' => 'http://localhost/foldername/cancel.php', //your cancel url
                        'opt_a' => Session::has('coupon') ? Cart::subtotal() : Cart::total(),  //optional paramter
                        'opt_b' => $request->payment_type,
                        'opt_c' => Auth::id(),
                        'opt_d' => $randNumber,
                        'signature_key' => $aamarpay->signature_key
                    ); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

                        $fields_string = http_build_query($fields);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_VERBOSE, true);
                    curl_setopt($ch, CURLOPT_URL, $url);

                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
                    curl_close($ch);

                    $this->redirect_to_merchant($url_forward);

                }
            }

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error("Review Submit Failed.", "Error");
            return back();
        }
    }


    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
            <script type="text/javascript">
                function closethisasap() { document.forms["redirectpost"].submit(); }
            </script>
          </head>
          <body onLoad="closethisasap();">

            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php
        exit;
    }

    public function success(Request $request)
    {
        return $request;
    }

    public function fail(Request $request)
    {
        return $request;
    }

    public function myOrder()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.customer.my_order', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::findOrFail($id);
        $order_details = OrderDetail::with('order')->where('order_id',$id)->get();

        return view('frontend.customer.order_details', compact('order','order_details'));
    }

    public function orderTracking()
    {
        return view('frontend.customer.order_tracking');
    }

    public function checkOrder(Request $request)
    {
        $order = Order::where('order_id',$request->order_id)->first();
        if ($order) {
            $order_details = OrderDetail::where('order_id',$order->id)->get();

            return view('frontend.customer.order_tracking_details',compact('order','order_details'));
        } else {
            notify()->error("Invalid Order ID!", "Error");
            return back();
        }
    }
}
