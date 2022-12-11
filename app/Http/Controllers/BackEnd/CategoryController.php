<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('backend.category.index',compact('categories'));
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
            'name' => 'required',
        ]);

        try {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name,'-')
            ]);

            notify()->success("Category Created Successfully.", "Success");
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Category Create Failed.", "Error");
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
        $data = Category::find($id);
        return response()->json($data);
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
            Category::find($request->category_id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name,'-')
            ]);

            notify()->success("Category Updated Successfully.", "Success");
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Category Updated Failed.", "Error");
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
            $category = Category::find($id);
            $category->delete();

            notify()->success("Category Deleted Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Category Delete Failed.", "Error");
            return back();
        }

    }

    public function getChildCategory($id)
    {
        $data = ChildCategory::where('subcategory_id',$id)->get();
        return response()->json($data);
    }
}
