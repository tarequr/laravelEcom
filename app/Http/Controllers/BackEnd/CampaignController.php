<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Product;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('campaigns')
                ->orderBy('id','desc')
                ->get();

            $imagePath = asset('upload/campaign');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function($row) use($imagePath) {
                        return '<img src="'.$imagePath.'/'.$row->image.'" height="50" width="70" >';
                    })
                    ->editColumn('start_date', function($row){
                        return '<b>Start Date: </b>'.date('d-m-Y',strtotime($row->start_date)).'<br>'.'<b>End Date: </b>'.date('d-m-Y',strtotime($row->end_date));
                    })
                    ->editColumn('status', function($row){
                        if ($row->status == 1) {
                            return '<span class="badge badge-success">Active</span>';
                        } else{
                            return '<span class="badge badge-danger">Deactive</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '<a href="'.route('campaign.product',[$row->id]).'" class="btn btn-primary btn-sm campaign_product" title="Add Campaign Product">
                            <i class="fa fa-plus"></i>
                        </a>

                        <a href="#" class="btn btn-success btn-sm edit" title="Edit" data-toggle="modal"
                        data-target="#editModal" data-id="'.$row->id.'">
                            <i class="fa fa-pen"></i>
                        </a>

                        <button type="button" onclick="deleteData('.$row->id.')" class="btn btn-danger btn-sm" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>

                        <form id="delete-form-'.$row->id.'" method="POST" action="'.route('campaign.destroy',[$row->id]).'" style="display: none;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>';

                        return $actionbtn;
                    })
                    ->rawColumns(['action','image','status','start_date'])
                    ->make(true);
        }

        return view('backend.offer.campaign.index');
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
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
            'image' => 'required'
        ]);

        try {

            $slug = Str::slug($request->title,'-');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $slug . '.' . $file->getClientOriginalExtension();
                $path = public_path('upload/campaign/').$filename;
                Image::make($file->getRealPath())->resize(468,90)->save($path);
            }

            Campaign::create([
                "title" => $request->title,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "image" => $filename,
                "discount" => $request->discount,
                "status" => $request->filled('status'),
            ]);

            notify()->success("Campaign Created Successfully.", "Success");
            return redirect()->route('campaign.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Campaign Create Failed.", "Error");
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

    public function campaignProduct($campaign_id)
    {
        $products = Product::where('status',1)->orderBy('id', 'desc')->get();
        return view('backend.offer.campaign.campaign_product', compact('campaign_id', 'products'));
    }
}
