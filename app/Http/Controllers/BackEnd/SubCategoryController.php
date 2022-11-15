<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories     = Category::orderBy('id','desc')->get();
        $sub_categories = SubCategory::with('category')->orderBy('id','desc')->get();

        return view('backend.sub_category.index',compact('categories','sub_categories'));
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
        $this->validate($request, [
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name',
        ]);

        try {
            SubCategory::create([
                'category_id' => $request->category,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => Str::slug($request->subcategory_name,'-')
            ]);

            notify()->success("Sub Category Created Successfully.", "Success");
            return redirect()->route('subcategory.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Sub Category Create Failed.", "Error");
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
        $subCategory = SubCategory::find($id);
        $categories  = Category::orderBy('id','desc')->get();

        return view('backend.sub_category.edit',compact('subCategory','categories'));
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
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->update([
                'category_id'      => $request->category,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => Str::slug($request->subcategory_name,'-')
            ]);

            notify()->success("Sub Category Updated Successfully.", "Success");
            return redirect()->route('subcategory.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Sub Category Update Failed.", "Error");
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
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->delete();

            notify()->success("Sub Category Deleted Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Sub Category Delete Failed.", "Error");
            return back();
        }
    }
}
