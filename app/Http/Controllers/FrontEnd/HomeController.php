<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get();
        // dd($categories);
        return view('frontend.home.index',compact('categories'));
    }
}
