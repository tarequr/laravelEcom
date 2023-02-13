<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TicketController extends Controller
{
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

    public function showTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('frontend.customer.show_ticket',compact('ticket'));
    }

    public function replyTicket(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('upload/ticket/').$filename;
                Image::make($file)->resize(240,120)->save($path);
            }

            TicketReply::create([
                'user_id'    => Auth::id(),
                'image'      => $request->hasFile('image') ? $filename : null,
                'ticket_id'  => $request->ticket_id,
                'message'    => $request->message,
                'reply_date' => date('Y-m-d')
            ]);

            notify()->success("Ticket Reply Successfully.", "Success");
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Ticket Reply Failed.", "Error");
            return back();
        }
    }
}
