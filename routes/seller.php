<?php
//seller auth

use App\Http\Controllers\Auth\Seller\AuthController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'seller','middleware'=> ['seller.beforeauth']],function () {
    Route::get('/login',[AuthController::class,'showLoginForm'])->name('seller.login.form');
    Route::post('/login',[AuthController::class,'login'])->name('seller.login');
});

//seller dashboard
Route::group(['prefix' => 'seller','middleware' => ['seller']], function () {
    Route::get('/',[SellerController::class,'dashboard'])->name('seller');
    //product
    Route::resource('/seller-product',ProductController::class);
    Route::post('/seller-product-status', [ProductController::class,'status'])->name('seller-product.status');
});

//for laravel filemanager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
