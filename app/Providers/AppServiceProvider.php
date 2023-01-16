<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            $view->with('setting', Setting::first());
            $view->with('brands', Brand::inRandomOrder()->limit(24)->get());
            $view->with('categories', Category::with('subCategory','subCategory.childCategory')->orderBy('id','desc')->get());
        });
    }
}
