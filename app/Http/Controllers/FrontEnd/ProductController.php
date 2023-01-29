<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Review;
use App\Models\SubCategory;

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

    public function productQuickview($id)
    {
        $product = Product::with('category','subCategories','brand','pickupPoint')->findOrFail($id);

        return view('frontend.product.product-quick-view', compact('product'));
    }

    public function brandWiseProduct($id)
    {
        $branddds   = Brand::get();
        $brand       = Brand::where('id', $id)->first();;
        $categories   = Category::get();
        $products      = Product::where('brand_id',$id)->paginate(40);
        $random_products = Product::where('status',1)->inRandomOrder()->take(16)->get();

        return view('frontend.product.brand_wise_product',compact('branddds','brand','products','categories','random_products'));
    }

    public function categoryWiseProduct($id)
    {
        $branddds = Brand::get();
        $products = Product::where('category_id',$id)->paginate(40);
        $sub_categories  = SubCategory::with('category')->where('category_id',$id)->get();
        $random_products = Product::where('status',1)->inRandomOrder()->take(16)->get();

        return view('frontend.product.category_wise_product',compact('branddds','products','sub_categories','random_products'));
    }

    public function subCategoryWiseProduct($id)
    {
        $branddds = Brand::get();
        $products = Product::where('subcategory_id',$id)->paginate(40);
        $sub_category = SubCategory::where('id',$id)->first();
        $child_categories  = ChildCategory::with('subCategory')->where('subcategory_id',$id)->get();
        $random_products = Product::where('status',1)->inRandomOrder()->take(16)->get();

        return view('frontend.product.sub_category_wise_product',compact('branddds','products','sub_category','child_categories','random_products'));
    }

    public function childCategoryWiseProduct($id)
    {
        $branddds = Brand::get();
        $categories  = Category::get();
        $products = Product::where('childcategory_id',$id)->paginate(40);
        $child_category = ChildCategory::where('id',$id)->first();
        $random_products = Product::where('status',1)->inRandomOrder()->take(16)->get();

        return view('frontend.product.child_category_wise_product',compact('branddds','products','categories','child_category','random_products'));
    }

}
