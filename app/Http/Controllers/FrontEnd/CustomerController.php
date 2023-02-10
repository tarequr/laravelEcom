<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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

    public function newTicket()
    {
        return view('frontend.customer.new_ticket');
    }

    public function ticketStore(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required'
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('upload/ticket/').$filename;
                Image::make($file)->resize(240,120)->save($path);
            }

            Ticket::create([
                'user_id'  => Auth::id(),
                'subject'  => $request->subject,
                'service'  => $request->service,
                'image'    => $filename,
                'priority' => $request->priority,
                'message'  => $request->message,
                'date'     => date('Y-m-d'),
                'status'   => 0,
            ]);

            notify()->success("Ticket Created Successfully.", "Success");
            return redirect()->route('open.ticket');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Ticket Create Failed.", "Error");
            return back();
        }
    }

    public function openTicket()
    {
        $tickets = Ticket::where('user_id',Auth::id())->orderBy('id','desc')->take(10)->get();
        return view('frontend.customer.open_ticket',compact('tickets'));
    }

}
