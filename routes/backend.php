<?php

use App\Http\Controllers\BackEnd\BrandController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\ChildCategoryController;
use App\Http\Controllers\BackEnd\CouponController;
use App\Http\Controllers\BackEnd\CampaignController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\PageController;
use App\Http\Controllers\BackEnd\PickupController;
use App\Http\Controllers\BackEnd\ProductController;
use App\Http\Controllers\BackEnd\SettingController;
use App\Http\Controllers\BackEnd\SubCategoryController;
use App\Http\Controllers\BackEnd\WarehouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware'=>['auth','is_admin']],function(){
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home',[DashboardController::class,'index'])->name('home');
    // Route::resource('categories',CategoryController::class)->except('create','edit','show');
    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::resource('childcategory',ChildCategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('warehouse', WarehouseController::class);
    Route::resource('coupon', CouponController::class);
    Route::resource('campaign', CampaignController::class);
    Route::resource('pickup', PickupController::class);

    Route::resource('product', ProductController::class);
    Route::get('not-featured/{id}', [ProductController::class,'notFeatured']);
    Route::get('active-featured/{id}', [ProductController::class,'activeFeatured']);

    Route::get('not-toadydeal/{id}', [ProductController::class,'notToadydeal']);
    Route::get('active-toadydeal/{id}', [ProductController::class,'activeToadydeal']);

    Route::get('not-status/{id}', [ProductController::class,'notStatus']);
    Route::get('active-status/{id}', [ProductController::class,'activeStatus']);

    /* ~~~~~~~~~~~~GLOBAL ROUTE~~~~~~~~~~~~~~~ */
    Route::get('get-child-category/{id}',[CategoryController::class,'getChildCategory']);

    /* ~~~~~~~~~~~~SETTING~~~~~~~~~~~~~~~ */
    Route::group(['prefix' => 'setting'], function(){
        Route::get('seo',[SettingController::class,'seoIndex'])->name('setting.seo');
        Route::put('seo/{id}/update',[SettingController::class,'seoUpdate'])->name('setting.seo.update');
        Route::get('smtp',[SettingController::class,'smtpIndex'])->name('setting.smtp');
        Route::put('smtp/{id}/update',[SettingController::class,'smtpUpdate'])->name('setting.smtp.update');
        Route::get('website',[SettingController::class,'websiteIndex'])->name('setting.website');
        Route::put('website/{id}/update',[SettingController::class,'websiteUpdate'])->name('setting.website.update');
        Route::resource('page', PageController::class);
    });

});
