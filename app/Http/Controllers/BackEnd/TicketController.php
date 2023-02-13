<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Ticket::query();

            //___________SERVEICE FILTERING__________//
            if ($request->service == 'Technical') {
                $query->where('service',$request->service);
            }
            if ($request->service == 'Payment') {
                $query->where('service',$request->service);
            }
            if ($request->service == 'Affiliate') {
                $query->where('service',$request->service);
            }
            if ($request->service == 'Return') {
                $query->where('service',$request->service);
            }
            if ($request->service == 'Refund') {
                $query->where('service',$request->service);
            }

            //___________STATUS FILTERING__________//
            if ($request->status == '0') {
                $query->where('status',$request->status);
            }
            if ($request->status == '1') {
                $query->where('status',$request->status);
            }
            if ($request->status == '2') {
                $query->where('status',$request->status);
            }

            //___________DATE FILTERING__________//
            if ($request->date) {
                $query->where('date',$request->date);
            }

            $data = $query->orderBy('id','desc')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($row){
                        return $row->user->name;
                    })
                    ->editColumn('date', function($row){
                        return date('d-M-Y', strtotime($row->date));
                    })
                    ->editColumn('status', function($row){
                        if ($row->status == 1) {
                            return '<span class="badge badge-success">Replied</span>';
                        } elseif ($row->status == 2) {
                            return '<span class="badge badge-muted">Close</span>';
                        } else{
                            return '<span class="badge badge-danger">Pending</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '
                        <a href="'.route('ticket.show',[$row->id]).'" class="btn btn-info btn-sm" title="Show">
                            <i class="fa fa-eye"></i>
                            Show
                        </a>

                        <button type="button" onclick="deleteData('.$row->id.')" class="btn btn-danger btn-sm" title="Delete">
                            <i class="fa fa-trash"></i>
                            <span>Delete</span>
                        </button>

                        <form id="delete-form-'.$row->id.'" method="POST" action="'.route('ticket.destroy',[$row->id]).'" style="display: none;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>';

                        return $actionbtn;
                    })
                    ->rawColumns(['action','name','status','date'])
                    ->make(true);
        }

        return view('backend.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('backend.ticket.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ticketReply(Request $request)
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
                'user_id'    => 1,
                'image'      => $request->hasFile('image') ? $filename : null,
                'ticket_id'  => $request->ticket_id,
                'message'    => $request->message,
                'reply_date' => date('Y-m-d')
            ]);

            Ticket::where('id', $request->ticket_id)->update(['status' => 1]);

            notify()->success("Ticket Reply Successfully.", "Success");
            return redirect()->route('ticket.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Ticket Reply Failed.", "Error");
            return back();
        }
    }
}
