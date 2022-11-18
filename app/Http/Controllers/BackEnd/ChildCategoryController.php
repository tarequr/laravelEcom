<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
// use DataTables;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("hello");
        if ($request->ajax()) {
            $data = DB::table('child_categories')
                ->leftJoin('categories','child_categories.category_id','categories.id')
                ->leftJoin('sub_categories','child_categories.subcategory_id','sub_categories.id')
                ->select('categories.name','sub_categories.subcategory_name','child_categories.*')
                ->orderBy('child_categories.id','desc')
                ->get();

            return DataTables::of($data)
                    ->addIndexColumn()
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

                        <form id="delete-form-'.$row->id.'" method="POST" action="'.route('childcategory.destroy',[$row->id]).'" style="display: none;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>';

                        return $actionbtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $categories = Category::orderBy('id','desc')->get();

        return view('backend.child_category.index', compact('categories'));
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
        // dd($request->all());
        $this->validate($request, [
            'childcategory_name' => 'required|unique:child_categories,childcategory_name',
        ]);

        try {
            $sub_cat = SubCategory::where('id',$request->subcategory_id)->first();
            ChildCategory::create([
                'category_id' => $sub_cat->category_id,
                'subcategory_id' => $request->subcategory_id,
                'childcategory_name' => $request->childcategory_name,
                'childcategory_slug'   => Str::slug($request->childcategory_name,'-')
            ]);

            notify()->success("Child Category Created Successfully.", "Success");
            return redirect()->route('childcategory.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Child Category Create Failed.", "Error");
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
        $categories = Category::orderBy('id','desc')->get();
        $childCategory = ChildCategory::findOrFail($id);

        return view('backend.child_category.edit', compact('categories','childCategory'));
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
        try {
            $sub_cat = SubCategory::where('id',$request->subcategory_id)->first();

            $childCategory = ChildCategory::findOrFail($id);
            $childCategory->update([
                'category_id' => $sub_cat->category_id,
                'subcategory_id' => $request->subcategory_id,
                'childcategory_name' => $request->childcategory_name,
                'childcategory_slug'   => Str::slug($request->childcategory_name,'-')
            ]);

            notify()->success("Child Category Updated Successfully.", "Success");
            return redirect()->route('childcategory.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Child Category Update Failed.", "Error");
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
            $childCategory = ChildCategory::findOrFail($id);
            $childCategory->delete();

            notify()->success("Child Category Deleted Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Child Category Delete Failed.", "Error");
            return back();
        }
    }
}
