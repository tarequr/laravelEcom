<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

            if ($request->category_id) {
                $query->where('category_id',$request->category_id);
            }

            if ($request->brand_id) {
                $query->where('brand_id',$request->brand_id);
            }

            if ($request->status == '1') {
                $query->where('status','1');
            }

            if ($request->status == '0') {
                $query->where('status','0');
            }

            $data = $query->orderBy('id','desc')->get();

            $imagePath = asset('upload/product');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('thumbnail', function($row) use($imagePath) {
                        return '<img src="'.$imagePath.'/'.$row->thumbnail.'" height="50" width="70" >';
                    })
                    ->editColumn('category_name', function($row){
                        return $row->category->name;
                    })
                    ->editColumn('subcategory_name', function($row){
                        return $row->subCategories->subcategory_name;
                    })
                    ->editColumn('brnad_name', function($row){
                        return $row->brand->brnad_name;
                    })
                    ->editColumn('featured', function($row){
                        if ($row->featured == 1) {
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_featured"><i class="fa fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active</span></a>';
                        } else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_featured"><i class="fa fa-thumbs-up text-success"></i> <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })
                    ->editColumn('toady_deal_id', function($row){
                        if ($row->toady_deal_id == 1) {
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_toadydeal"><i class="fa fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active</span></a>';
                        } else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_toadydeal"><i class="fa fa-thumbs-up text-success"></i> <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })
                    ->editColumn('status', function($row){
                        if ($row->status == 1) {
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_status"><i class="fa fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active</span></a>';
                        } else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_status"><i class="fa fa-thumbs-up text-success"></i> <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '
                        <a href="'.route('product.edit',[$row->id]).'" class="btn btn-success btn-sm edit" title="Edit">
                            <i class="fa fa-pen"></i>
                            Edit
                        </a>

                        <a href="#" class="btn btn-info btn-sm edit" title="Show">
                            <i class="fa fa-eye"></i>
                            Show
                        </a>

                        <button type="button" onclick="deleteData('.$row->id.')" class="btn btn-danger btn-sm" data-id="'.$row->id.'" title="Delete" >
                            <i class="fa fa-trash"></i>
                            <span>Delete</span>
                        </button>

                        <form id="delete-form-'.$row->id.'" method="POST" action="'.route('product.destroy',[$row->id]).'" style="display: none;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>';

                        return $actionbtn;
                    })
                    ->rawColumns(['action','category_name','subcategory_name','brnad_name','thumbnail','featured','toady_deal_id','status'])
                    ->make(true);
        }

        $categories = Category::orderBy('id','desc')->get();
        $brands = Brand::orderBy('id','desc')->get();

        return view('backend.product.index',compact('categories','brands'));
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
