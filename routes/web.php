<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\ReviewController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\FrontEnd\CustomerController;
use App\Http\Controllers\FrontEnd\AddToCartController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('single-product/{slug}',[ProductController::class,'singleProduct'])->name('single.product');
Route::get('product-quick-view/{id}',[ProductController::class,'productQuickview']);

Route::get('customer/login', [CustomerController::class,'customerLogin'])->name('customer.login');
Route::get('customer/dashboard', function () {
    return 'hello';
})->name('customer.dashboard');

Route::post('review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('add/{id}/wishlist', [ReviewController::class, 'wishlist'])->name('add.wishlist');
Route::post('add-to-cart-quickview', [AddToCartController::class, 'addToCartQuickView'])->name('add.to.cart.quickview');
Route::get('all-cart', [AddToCartController::class, 'allCart'])->name('all.cart');
Route::get('my-cart', [AddToCartController::class, 'myCart'])->name('my.cart');

Route::get('cart-destroy', function (){
    Cart::destroy();
});
