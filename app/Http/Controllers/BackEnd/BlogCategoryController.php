<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('backend.blog_category.index',compact('blog_categories'));
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
            'name' => 'required|unique:blog_categories,name',
        ]);

        try {
            BlogCategory::create([
                'name' => $request->name,
                'slug'  => Str::slug($request->name,'-'),
                'status' => $request->status,
            ]);

            notify()->success("Blog Category Created Successfully.", "Success");
            return redirect()->route('blog-category.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Blog Category Create Failed.", "Error");
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
        $data = BlogCategory::find($id);
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
            $blogCategory = BlogCategory::find($request->blogcategory_id);
            $blogCategory->update([
                'name' => $request->name,
                'slug'  => Str::slug($request->name,'-'),
                'status' => $request->status,
            ]);

            notify()->success("Blog Category Updated Successfully.", "Success");
            return redirect()->route('blog-category.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Blog Category Update Failed.", "Error");
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
            $blogCategory = BlogCategory::find($id);
            $blogCategory->delete();

            notify()->success("Blog Category Deleted Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Blog Category Delete Failed.", "Error");
            return back();
        }
    }
}
