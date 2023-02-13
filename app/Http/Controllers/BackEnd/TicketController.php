<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                            return '<span class="badge badge-warning">Running</span>';
                        } elseif ($row->status == 2) {
                            return '<span class="badge badge-muted">Close</span>';
                        } else{
                            return '<span class="badge badge-danger">Pending</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '<a href="#" class="btn btn-success btn-sm edit" title="Edit" data-toggle="modal"
                        data-target="#editModal" data-id="'.$row->id.'">
                            <i class="fa fa-pen"></i>
                            Edit
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
                    // ->rawColumns(['action','status','date'])
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
        //
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
}
