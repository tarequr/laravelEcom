<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\BlogController;
use App\Http\Controllers\BackEnd\PageController;
use App\Http\Controllers\BackEnd\BrandController;
use App\Http\Controllers\BackEnd\LoginController;
use App\Http\Controllers\BackEnd\OrderController;
use App\Http\Controllers\BackEnd\CouponController;
use App\Http\Controllers\BackEnd\PickupController;
use App\Http\Controllers\BackEnd\ReportController;
use App\Http\Controllers\BackEnd\TicketController;
use App\Http\Controllers\BackEnd\ProductController;
use App\Http\Controllers\BackEnd\SettingController;
use App\Http\Controllers\BackEnd\CampaignController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\WarehouseController;
use App\Http\Controllers\BackEnd\SubCategoryController;
use App\Http\Controllers\BackEnd\BlogCategoryController;
use App\Http\Controllers\BackEnd\ChildCategoryController;
use App\Http\Controllers\BackEnd\PaymentGatewayController;

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

Route::get('login/{provider}', [LoginController::class,'redirectToProvider'])->name('login.provider');
Route::get('login/{provider}/callback', [LoginController::class,'handleProviderCallback'])->name('login.callback');

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
    Route::resource('ticket', TicketController::class);
    Route::resource('order', OrderController::class);
    Route::get('campaign/{campaign_id}/product', [CampaignController::class, 'campaignProduct'])->name('campaign.product');
    Route::get('add/campaign/{id}/{campaign_id}/product', [CampaignController::class, 'addCampaignProduct'])->name('add.campaign.product');
    Route::get('campaign/product/{campaign_id}/list', [CampaignController::class, 'campaignProductList'])->name('campaign.product.list');
    Route::delete('campaign/product/{id}/destroy', [CampaignController::class, 'campaignProductDestroy'])->name('campaign.product.destroy');
    Route::get('order/{id}/details', [OrderController::class, 'orderDetails'])->name('order.details');
    Route::post('ticket/reply', [TicketController::class, 'ticketReply'])->name('ticket.reply');
    Route::get('ticket/{id}/close', [TicketController::class, 'ticketClose'])->name('ticket.close');

    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('product', ProductController::class);
    Route::get('not-featured/{id}', [ProductController::class,'notFeatured']);
    Route::get('active-featured/{id}', [ProductController::class,'activeFeatured']);

    Route::get('not-toadydeal/{id}', [ProductController::class,'notToadydeal']);
    Route::get('active-toadydeal/{id}', [ProductController::class,'activeToadydeal']);

    Route::get('not-status/{id}', [ProductController::class,'notStatus']);
    Route::get('active-status/{id}', [ProductController::class,'activeStatus']);

    /* ~~~~~~~~~~~~REPORT ROUTE~~~~~~~~~~~~~~~ */
    Route::get('order-report', [ReportController::class, 'orderReport'])->name('order.report');
    Route::get('order/report/print', [ReportController::class, 'orderReportPrint'])->name('order.report.print');

    /* ~~~~~~~~~~~~GLOBAL ROUTE~~~~~~~~~~~~~~~ */
    Route::get('get-child-category/{id}',[CategoryController::class,'getChildCategory']);

    /* ~~~~~~~~~~~~PAYMENT GATEWAY~~~~~~~~~~~~~~~ */
    Route::get('payment-gateway', [PaymentGatewayController::class,'paymentGateway'])->name('payment.gateway');
    Route::put('aamarpay/update', [PaymentGatewayController::class,'aamarpayUpdate'])->name('aamarpay.update');
    Route::put('shurjopay/update', [PaymentGatewayController::class,'shurjopayUpdate'])->name('shurjopay.update');
    Route::put('sslcommerz/update', [PaymentGatewayController::class,'sslcommerzUpdate'])->name('sslcommerz.update');

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
