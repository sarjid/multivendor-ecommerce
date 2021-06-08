<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[IndexController::class,'index'])->name('home');
// user auth
Route::get('user/auth',[IndexController::class,'userAuth'])->name('user.auth');
Route::post('user/login', [IndexController::class,'loginSubmit'])->name('login.submit');
Route::post('user/register', [IndexController::class,'registerSubmit'])->name('register.submit');
Route::get('user/logout', [IndexController::class,'userLogout'])->name('user.logout');

Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');
Route::get('prdouct-detail/{slug}',[IndexController::class,'productDetail'])->name('product.detail');

// ---- cart section----
Route::post('cart-store',[CartController::class,'cartStore'])->name('cart.store');
Route::post('cart-delete',[CartController::class,'cartDelete'])->name('cart.delete');
Route::get('cart',[CartController::class,'cart'])->name('cart');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');
//coupon section
Route::post('coupon/add',[CartController::class,'couponAdd'])->name('coupon.add');
//wishlist section
Route::get('wishlist',[WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist-store',[WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist-move',[WishlistController::class,'wishlistMove'])->name('wishlist.move');
//checkout section
Route::get('checkout1',[CheckoutController::class,'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout1-store',[CheckoutController::class,'checkout1Store'])->name('checkout1.store')->middleware('user');


Auth::routes(['register'=> false]);

//admin route
Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function () {
    Route::get('/',[AdminController::class,'admin'])->name('admin');
    //banner
    Route::resource('/banner', BannerController::class);
    Route::post('/banner-status', [BannerController::class,'status'])->name('banner.status');
   //banner
   Route::resource('/category', CategoryController::class);
   Route::post('/category-status', [CategoryController::class,'status'])->name('category.status');
   //use for add product times
   Route::post('/category/{id}/child', [CategoryController::class,'getChildByParentId']);
    //brrand
    Route::resource('/brand', BrandController::class);
    Route::post('/brand-status', [BrandController::class,'status'])->name('brand.status');
     //products
    Route::resource('/product', ProductController::class);
    Route::post('/product-status', [ProductController::class,'status'])->name('product.status');
      //users
    Route::resource('/user', UserController::class);
    Route::post('/user-status', [UserController::class,'status'])->name('user.status');
    //coupon
    Route::resource('/coupon', CouponController::class);
    Route::post('/coupon-status', [CouponController::class,'status'])->name('coupon.status');
     //shipping
     Route::resource('/shipping', ShippingController::class);
     Route::post('/shipping-status', [ShippingController::class,'status'])->name('shipping.status');
});


//seller routes
Route::group(['prefix' => 'seller','middleware' => ['auth','seller']], function () {
    Route::get('/',[AdminController::class,'seller'])->name('seller');
});

//User routes
Route::group(['prefix' => 'user','middleware' => ['auth','user']], function () {
    Route::get('/dashboard',[IndexController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order',[IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address',[IndexController::class,'userAddress'])->name('user.address');
    Route::get('/account-detail',[IndexController::class,'userAccount'])->name('user.account');
    Route::post('/update-account/{id}',[IndexController::class,'updateAccount'])->name('update.account');
    Route::post('/billing-address/{id}',[IndexController::class,'billingAddress'])->name('billing.address');
    Route::post('/shipping-address/{id}',[IndexController::class,'shippingAddress'])->name('shipping.address');
    Route::get('/password',[IndexController::class,'userPassword'])->name('user.password');
    Route::post('/update-password/{id}',[IndexController::class,'updatePassword'])->name('update.password');
});





