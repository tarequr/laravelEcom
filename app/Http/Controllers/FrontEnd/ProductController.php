<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

class ProductController extends Controller
{
    public function singleProduct($slug)
    {
        Product::where('slug', $slug)->increment('product_view'); //here add number of product view in product_view in column.

        $product = Product::with('category','subCategories','brand','pickupPoint')->where('slug', $slug)->firstOrFail();
        $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        $banner_product = Product::with('brand')->where('slider',1)->latest()->first();
        $reladed_produts = Product::where('subcategory_id',$product->subcategory_id)->orderBy('id','desc')->take(10)->get();
        $reviews = Review::with('user')->where('product_id',$product->id)->orderBy('id','desc')->get();

        return view('frontend.product.product-single', compact('product','categories','banner_product','reladed_produts','reviews'));
    }
}
