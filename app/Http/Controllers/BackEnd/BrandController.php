<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brands')
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

                        <button type="button" onclick="deleteData('.$row->id.')" class="btn btn-danger btn-sm" title="Delete">
                            <i class="fa fa-trash"></i>
                            <span>Delete</span>
                        </button>

                        <form id="delete-form-'.$row->id.'" method="POST" action="'.route('brand.destroy',[$row->id]).'" style="display: none;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>';

                        return $actionbtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('backend.brand.index');
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
            'brnad_name' => 'required|unique:brands,brnad_name',
        ]);

        try {

            $slug = Str::slug($request->brnad_name,'-');

            if ($request->hasFile('brand_logo')) {
                $file = $request->file('brand_logo');
                $filename = $slug . '.' . $file->getClientOriginalExtension();
                // $file->move(public_path('upload/brand'), $filename);
                $path = public_path('upload/brand/').$filename;
                Image::make($file)->resize(240,120)->save($path);
            }

            Brand::create([
                'brnad_name' => $request->brnad_name,
                'brnad_slug' => $slug,
                'brand_logo' => URL::to('/').'/'.'upload/brand/'.$filename
            ]);

            notify()->success("Brand Created Successfully.", "Success");
            return redirect()->route('brand.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Brand Create Failed.", "Error");
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
