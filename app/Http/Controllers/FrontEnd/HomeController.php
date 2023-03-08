<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Page;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Models\WebsiteReview;
use App\Models\CampaignProduct;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $latest_reviews = WebsiteReview::where('status',1)->orderBy('id','desc')->take(12)->get();
        $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        $banner_product = Product::where('status',1)->with('brand')->where('slider',1)->latest()->first();
        $featureds = Product::where('status',1)->where('featured',1)->orderBy('id','desc')->take(16)->get();
        $toady_deals = Product::with('category','subCategories')->where('status',1)->where('toady_deal_id',1)->orderBy('id','desc')->take(6)->get();
        $popular_products = Product::where('status',1)->orderBy('product_view','desc')->take(16)->get();
        $random_products = Product::where('status',1)->inRandomOrder()->take(16)->get();
        $trendy_products = Product::with('category')->where('status',1)->where('trendy',1)->orderBy('id','desc')->take(8)->get();
        $home_categories = Category::with('subCategory','subCategory.childCategory','product')->where('home_page',1)->orderBy('name','asc')->get();
        $campaign = Campaign::where('status',1)->orderBy('id','desc')->first();

        return view('frontend.home.index',compact('latest_reviews','categories','banner_product','featureds','toady_deals','popular_products','random_products','trendy_products','home_categories','campaign'));
    }

    public function pageView($slug)
    {
        $page = Page::where('page_slug',$slug)->first();
        return view('frontend.page.index', compact('page'));
    }

    public function newsletterStore(Request $request)
    {
        if($request->ajax()){
            $check = NewsLetter::where('email',$request->email)->first();

            if (!$check) {
                NewsLetter::create([
                    'email' => $request->email
                ]);

                return response()->json(['status' => 1]);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            return redirect()->back();
        }

    }

    public function campaignProduct($id)
    {
        $campaignProducts = CampaignProduct::with('product')->where('campaign_id', $id)->get();
        return view('frontend.home.campaign_product_list', compact('campaignProducts'));
    }

    public function singleCampaignProduct($slug)
    {
        // dd($slug);
        Product::where('slug', $slug)->increment('product_view'); //here add number of product view in product_view in column.
        $product = Product::with('category','subCategories','brand','pickupPoint')->where('slug', $slug)->firstOrFail();
        $campaignProduct = CampaignProduct::where('product_id', $product->id)->firstOrFail();

        $related_products = CampaignProduct::with('product')->where('campaign_id', $campaignProduct->campaign_id)->inRandomOrder()->take(16)->get();

        // $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        // $banner_product = Product::with('brand')->where('slider',1)->latest()->first();
        // $reladed_produts = Product::where('subcategory_id',$product->subcategory_id)->orderBy('id','desc')->take(10)->get();
        $reviews = Review::with('user')->where('product_id',$product->id)->orderBy('id','desc')->get();

         // Share button 1
        $shareButtons = \Share::page(
                                url()->current()
                            )
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->telegram()
                            ->whatsapp()
                            ->reddit();

        return view('frontend.home.single_campaign_product_list', compact('product','campaignProduct','related_products','reviews','shareButtons'));
    }
}
