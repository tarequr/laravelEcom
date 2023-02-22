<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = "";
            $query = Order::query();

            if ($request->payment_type) {
                $query->where('payment_type',$request->payment_type);
            }

            if ($request->date) {
                $query->where('date', date('Y-m-d', strtotime($request->date)));
            }

            if ($request->status == '0') {
                $query->where('status','0');
            }

            if ($request->status == '1') {
                $query->where('status','1');
            }

            if ($request->status == '2') {
                $query->where('status','2');
            }

            if ($request->status == '3') {
                $query->where('status','3');
            }

            if ($request->status == '4') {
                $query->where('status','4');
            }

            if ($request->status == '5') {
                $query->where('status','5');
            }

            $data = $query->orderBy('id','desc')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('date', function($row){
                        return date('d-M-Y',strtotime($row->date));
                    })
                    ->editColumn('status', function($row){
                        if ($row->status == 0) {
                            return '<span class="badge badge-danger">Order Pending</span>';
                        } elseif ($row->status == 1) {
                            return '<span class="badge badge-info">Order Received</span>';
                        } elseif ($row->status == 2) {
                            return '<span class="badge badge-primary">Order Shipping</span>';
                        } elseif ($row->status == 3) {
                            return '<span class="badge badge-success">Order Done</span>';
                        } elseif ($row->status == 4) {
                            return '<span class="badge badge-warning">Order Return</span>';
                        } elseif ($row->status == 5) {
                            return '<span class="badge badge-danger">Order Cancle</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '
                        <div class="d-flex">
                            <a href="'.route('order.edit',[$row->id]).'" class="btn btn-success btn-sm edit mr-1" title="Edit" >
                                <i class="fa fa-pen"></i>
                            </a>

                            <a href="#" class="btn btn-info btn-sm edit mr-1" title="Show">
                                <i class="fa fa-eye"></i>
                            </a>

                            <button type="button" onclick="deleteData('.$row->id.')" class="btn btn-danger btn-sm" data-id="'.$row->id.'" title="Delete" >
                                <i class="fa fa-trash"></i>
                            </button>

                            <form id="delete-form-'.$row->id.'" method="POST" action="'.route('order.destroy',[$row->id]).'" style="display: none;">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                            </form>
                        </div>
                        ';

                        return $actionbtn;
                    })
                    ->rawColumns(['action','category_name','subcategory_name','brnad_name','thumbnail','featured','toady_deal_id','status'])
                    ->make(true);
        }

        return view('backend.order.index');
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
