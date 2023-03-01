<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function orderReport(Request $request)
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
                    ->rawColumns(['category_name','subcategory_name','brnad_name','thumbnail','featured','toady_deal_id','status'])
                    ->make(true);
        }
        return view('backend.report.order.index');
    }

    public function orderReportPrint(Request $request)
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

            $orders = $query->orderBy('id','desc')->get();
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
                    ->rawColumns(['category_name','subcategory_name','brnad_name','thumbnail','featured','toady_deal_id','status'])
                    ->make(true);
        }

        return view('backend.report.order.print', compact('orders'));
    }
}
