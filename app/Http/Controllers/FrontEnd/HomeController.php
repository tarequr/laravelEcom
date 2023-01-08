<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        $banner_product = Product::with('brand')->where('slider',1)->latest()->first();
        $featureds = Product::where('featured',1)->orderBy('id','desc')->take(8)->get();
        // dd($categories);
        return view('frontend.home.index',compact('categories','banner_product','featureds'));
    }
}
