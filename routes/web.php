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

Route::get('brand-wise-product/{id}',[ProductController::class,'brandWiseProduct'])->name('brand.wise.product');
Route::get('category-wise-product/{id}',[ProductController::class,'categoryWiseProduct'])->name('category.wise.product');
Route::get('sub-category-wise-product/{id}',[ProductController::class,'subCategoryWiseProduct'])->name('sub.category.product');
Route::get('child-category-wise-product/{id}',[ProductController::class,'childCategoryWiseProduct'])->name('child.category.product');

Route::get('customer/login', [CustomerController::class,'customerLogin'])->name('customer.login');
Route::get('customer/dashboard', [CustomerController::class,'dashboard'])->name('customer.dashboard');
Route::get('customer/logout', [CustomerController::class,'logout'])->name('customer.logout');

Route::post('review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('write-review', [ReviewController::class, 'writeReview'])->name('write.review');

Route::get('add/{id}/wishlist', [ReviewController::class, 'wishlist'])->name('add.wishlist');
Route::post('add-to-cart-quickview', [AddToCartController::class, 'addToCartQuickView'])->name('add.to.cart.quickview');
Route::get('all-cart', [AddToCartController::class, 'allCart'])->name('all.cart');
Route::get('my-cart', [AddToCartController::class, 'myCart'])->name('my.cart');
Route::get('cart-empty', [AddToCartController::class, 'cartEmpty'])->name('cart.empty');
Route::get('product-cart/qtyupdate/{rowId}/{qty}', [AddToCartController::class, 'qtyUpdate']);
Route::get('product-cart/colorupdate/{rowId}/{color}', [AddToCartController::class, 'colorUpdate']);
Route::get('product-cart/sizeupdate/{rowId}/{size}', [AddToCartController::class, 'sizeUpdate']);
Route::get('product-cart/remove/{id}', [AddToCartController::class, 'cartRemove']);

Route::get('wish-list', [AddToCartController::class, 'wishList'])->name('my-wishlist');
Route::get('clear/wish-list', [AddToCartController::class, 'clearWishList'])->name('clear.wishlist');
Route::get('single/wishlist/{id}/delete', [AddToCartController::class, 'singleWishListDelete'])->name('single.wishlist.delete');

Route::get('cart-destroy', function (){
    Cart::destroy();
});
