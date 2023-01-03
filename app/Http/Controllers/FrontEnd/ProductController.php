<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function singleProduct($slug)
    {
        $product = Product::with('category','subCategories','brand','pickupPoint')->where('slug', $slug)->firstOrFail();
        $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        $banner_product = Product::with('brand')->where('slider',1)->latest()->first();

        return view('frontend.product.product-single', compact('product','categories','banner_product'));
    }
}
