<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Order;
use App\Mail\ReceivedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Mail;
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
                            <a href="#" class="btn btn-info btn-sm show mr-1" title="Show" data-toggle="modal" data-target="#showModal" data-id="'.$row->id.'">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="#" class="btn btn-success btn-sm edit mr-1" title="Edit" data-toggle="modal" data-target="#editModal" data-id="'.$row->id.'">
                                <i class="fa fa-pen"></i>
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
        $order = Order::findOrFail($id);
        return response()->json($order);


        // $order_details = OrderDetail::where('order_id', $id)->get();

        // return view('backend.order.show',compact('order','order_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.order.edit',compact('order'));
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
        $this->validate($request, [
            'c_name' => 'required',
            'c_phone' => 'required',
            'c_address' => 'required',
            'status' => 'required'
        ]);

        try {
            $order = Order::findOrFail($id);
            $order->update([
                "c_name" => $request->c_name,
                "c_email" => $request->c_email,
                "c_phone" => $request->c_phone,
                "c_address" => $request->c_address,
                "status" => $request->status,
            ]);

            if ($request->status == "1") {
                $orderMail = "";
                Mail::to($request->c_email)->send(new ReceivedMail($orderMail));
            }

            notify()->success("Order Updated Successfully.", "Success");
            return redirect()->route('order.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Order Update Failed.", "Error");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Order::findOrFail($id)->delete();
            OrderDetail::where('order_id', $id)->delete();

            notify()->success("Order Deleted Successfully.", "Success");
            return redirect()->route('order.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Order Delete Failed.", "Error");
            return back();
        }
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        $order_details = OrderDetail::where('order_id', $id)->get();

        return view('backend.order.show',compact('order','order_details'));
    }
}
