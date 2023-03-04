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
use App\Models\ChildCategory;
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

            $data = "";
            // $data = Product::orderBy('id','desc')->get();
            $query = Product::query();

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
                $path = public_path('upload/product/').$filename;
                Image::make($file->getRealPath())->resize(600,600)->save($path);
            }

            $images = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $filename2 = 'IMG'. time(). $key . '.' . $image->getClientOriginalExtension();
                    $path2 = public_path('upload/product_images/').$filename2;
                    Image::make($image->getRealPath())->resize(600,600)->save($path2);
                    array_push($images,$filename2);
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
                "slider" => $request->filled('slider'),
                "trendy" => $request->filled('trendy'),
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
        $product = Product::find($id);
        $brands    = Brand::orderBy('id','desc')->get();
        $pickups    = PickupPoint::orderBy('id','desc')->get();
        $categories  = Category::orderBy('id','desc')->get();
        $wareHouses    = Warehouse::orderBy('id','desc')->get();
        $childCategories = ChildCategory::orderBy('id','desc')->get();

        return view('backend.product.edit',compact('product','brands','pickups','categories','wareHouses','childCategories'));
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
        // dd($request->all());

        $product = Product::findOrFail($id);
        // dd($product);

        $this->validate($request, [
            'name' => 'required|unique:products,name,'.$product->id,
            'code' => 'required',
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
                @unlink(public_path('upload/product/' . $product->thumbnail));
                $filename = $slug . '.' . $file->getClientOriginalExtension();
                $path = public_path('upload/product/').$filename;
                Image::make($file->getRealPath())->resize(600,600)->save($path);
                $product->update([
                    "thumbnail" => $filename,
                ]);
            }

            if ($request->has('old_images')) {
                $all_images = json_encode($request->old_images);
            }

            $images = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    // $imageExists = Product::where('id',$id)->whereJsonContains('images', [$image])->first();
                    // if ($imageExists) {
                    //     array_push($images,$image);
                    // } else {
                    //     @unlink(public_path('upload/product_images/' . $image));
                    //     $filename2 = 'IMG'. time(). $key . '.' . $image->getClientOriginalExtension();
                    //     $path2 = public_path('upload/product_images/').$filename2;
                    //     Image::make($image->getRealPath())->resize(600,600)->save($path2);
                    //     array_push($images,$filename2);
                    // }

                    $filename2 = 'IMG'. time(). $key . '.' . $image->getClientOriginalExtension();
                    $path2 = public_path('upload/product_images/').$filename2;
                    Image::make($image->getRealPath())->resize(600,600)->save($path2);
                    array_push($images,$filename2);
                }

                $all_images = json_encode($images);
            }

            $subCategory = SubCategory::find($request->subcategory_id);

            $product->update([
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
                "images" => isset($all_images) ? $all_images : null,
                "featured" => $request->filled('featured'),
                "toady_deal_id" => $request->filled('toady_deal_id'),
                "slider" => $request->filled('slider'),
                "trendy" => $request->filled('trendy'),
                "status" => $request->filled('status'),
                "created_by" => Auth::user()->id,
                "date" => date('Y-m-d'),
                "month" => date('F'),
            ]);

            notify()->success("Product Updated Successfully.", "Success");
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Product Update Failed.", "Error");
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
            $product = Product::find($id);

            if ($product->thumbnail != NULL) {
                @unlink(public_path('upload/product/' . $product->thumbnail));
            }

            if ($product->images != NULL) {
                foreach (json_decode($product->images) as $key => $image) {
                    @unlink(public_path('upload/product_images/' . $image));
                }
            }
            $product->delete();

            notify()->success("Product Deleted Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Product Delete Failed.", "Error");
            return back();
        }
    }

    public function notFeatured($id)
    {
        Product::find($id)->update([
            'featured' => 0
        ]);

        return response()->json('Poduct Featured Deactive');
    }

    public function activeFeatured($id)
    {
        Product::find($id)->update([
            'featured' => 1
        ]);

        return response()->json('Poduct Featured Active');
    }

    public function notToadydeal($id)
    {
        Product::find($id)->update([
            'toady_deal_id' => 0
        ]);

        return response()->json('Poduct Toady Deal Deactive');
    }

    public function activeToadydeal($id)
    {
        Product::find($id)->update([
            'toady_deal_id' => 1
        ]);

        return response()->json('Poduct Toady Deal Active');
    }

    public function notStatus($id)
    {
        Product::find($id)->update([
            'status' => 0
        ]);

        return response()->json('Poduct Toady Deal Deactive');
    }

    public function activeStatus($id)
    {
        Product::find($id)->update([
            'status' => 1
        ]);

        return response()->json('Poduct Toady Deal Active');
    }
}
