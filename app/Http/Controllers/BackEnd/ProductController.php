<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\PickupPoint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('products')
                ->orderBy('id','desc')
                ->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn = '<a href="#" class="btn btn-success btn-sm edit" title="Edit" data-toggle="modal"
                        data-target="#editModal" data-id="'.$row->id.'">
                            <i class="fa fa-pen"></i>
                            Edit
                        </a>

                        <button type="button" onclick="deleteData('.$row->id.')" class="btn btn-danger btn-sm" data-id="'.$row->id.'" title="Delete" >
                            <i class="fa fa-trash"></i>
                            <span>Delete</span>
                        </button>

                        <form id="delete-form-'.$row->id.'" method="POST" action="'.route('coupon.destroy',[$row->id]).'" style="display: none;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>';

                        return $actionbtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('backend.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('id','desc')->get();
        $pickups = PickupPoint::orderBy('id','desc')->get();
        $categories = Category::orderBy('id','desc')->get();
        $wareHouses = Warehouse::orderBy('id','desc')->get();

        return view('backend.product.create',compact('brands','pickups','categories','wareHouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $this->validate($request, [
            'name' => 'required|unique:products,name',
            'code' => 'required|unique:products,code',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);

        try {

            $slug = Str::slug($request->name,'-');

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = $slug . '.' . $file->getClientOriginalExtension();
                // $path = public_path('upload/product/').$filename;
                // Image::make($file)->resize(240,120)->save($path);
            }

            $images = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $value) {
                    $filename = 'IMG'. time() . '.' . $file->getClientOriginalExtension();
                    array_push($images,$filename);
                }

                $all_images = json_encode($images);
            }

            $subCategory = SubCategory::find($request->subcategory_id);

            Product::create([
                "name" => $request->name,
                "slug" => $slug,
                "code" => $request->code,
                "category_id" => $subCategory->category_id,
                "subcategory_id" => $request->subcategory_id,
                "childcategory_id" => $request->childcategory_id,
                "brand_id" => $request->brand_id,
                "pickup_id" => $request->pickup_id,
                "unit" => $request->unit,
                "tags" => $request->tags,
                "purchase_price" => $request->purchase_price,
                "selling_price" => $request->selling_price,
                "discount_price" => $request->discount_price,
                "warehouse" => $request->warehouse,
                "stock_quantity" => $request->stock_quantity,
                "color" => $request->color,
                "size" => $request->size,
                "description" => $request->description,
                "video" => $request->video,
                "thumbnail" => $filename,
                "images" => $all_images,
                "featured" => $request->filled('featured'),
                "toady_deal_id" => $request->filled('toady_deal_id'),
                "status" => $request->filled('status'),
                "created_by" => Auth::user()->id,
                "date" => date('Y-m-d'),
                "month" => date('F'),
            ]);

            notify()->success("Product Created Successfully.", "Success");
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Product Create Failed.", "Error");
            return back();
        }
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
        return view('backend.product.edit');
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
