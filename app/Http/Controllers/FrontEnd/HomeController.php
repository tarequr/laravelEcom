<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::inRandomOrder()->limit(12)->get();
        $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        $banner_product = Product::where('status',1)->with('brand')->where('slider',1)->latest()->first();
        $featureds = Product::where('status',1)->where('featured',1)->orderBy('id','desc')->take(16)->get();
        $popular_products = Product::where('status',1)->orderBy('product_view','desc')->take(16)->get();
        $random_products = Product::where('status',1)->inRandomOrder()->take(16)->get();
        $trendy_products = Product::with('category')->where('status',1)->where('trendy',1)->orderBy('id','desc')->take(8)->get();
        $home_categories = Category::with('subCategory','subCategory.childCategory','product')->where('home_page',1)->orderBy('name','asc')->get();

        return view('frontend.home.index',compact('brands','categories','banner_product','featureds','popular_products','random_products','trendy_products','home_categories'));
    }
}
