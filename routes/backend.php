<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;


//admin routes
//admin auth
Route::group(['prefix'=>'admin','middleware'=>['admin.beforeauth']],function () {
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login.form');
    Route::post('/login',[LoginController::class,'login'])->name('admin.login');
});

//admn panel
Route::group(['prefix' => 'admin','middleware' => ['admin']], function () {
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
    Route::post('/product-attribute/{pId}', [ProductController::class,'attributeStore'])->name('product.attribute.store');
    Route::delete('/product-attribute-delete/{pId}', [ProductController::class,'attributeDelete'])->name('product.attribute.destroy');

      //users
    Route::resource('/user', UserController::class);
    Route::post('/user-status', [UserController::class,'status'])->name('user.status');
    //coupon
    Route::resource('/coupon', CouponController::class);
    Route::post('/coupon-status', [CouponController::class,'status'])->name('coupon.status');
     //shipping
     Route::resource('/shipping', ShippingController::class);
     Route::post('/shipping-status', [ShippingController::class,'status'])->name('shipping.status');

     //orders
     Route::resource('/order', OrderController::class);
     Route::post('/order-status', [OrderController::class,'status'])->name('order.status');

      //currency
      Route::resource('/currency', CurrencyController::class);
      Route::post('/currency-status', [CurrencyController::class,'status'])->name('currency.status');

      //setting
      Route::get('settings',[SettingController::class,'create'])->name('setting.create');
      Route::put('settings-update',[SettingController::class,'update'])->name('setting.update');

      //seller managemne
      Route::resource('/seller', SellerController::class);
      Route::post('/seller-status', [SellerController::class,'status'])->name('seller.status');
      Route::post('/seller-verified', [SellerController::class,'sellerVerified'])->name('seller.verified');

});


//for laravel filemanager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
