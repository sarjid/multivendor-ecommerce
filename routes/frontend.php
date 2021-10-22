<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AutosearchController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProductReviewController;

Route::get('/',[IndexController::class,'index'])->name('home');


Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');
Route::get('prdouct-detail/{slug}',[IndexController::class,'productDetail'])->name('product.detail');

// ---- cart section----
Route::post('cart-store',[CartController::class,'cartStore'])->name('cart.store');
Route::post('cart-delete',[CartController::class,'cartDelete'])->name('cart.delete');
Route::get('cart',[CartController::class,'cart'])->name('cart');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');
//coupon section
Route::post('coupon/add',[CartController::class,'couponAdd'])->name('coupon.add');
Route::get('coupon/remove/{coupon}',[CartController::class,'couponRemove'])->name('coupon.remove');
//wishlist section
Route::get('wishlist',[WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist-store',[WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist-move',[WishlistController::class,'wishlistMove'])->name('wishlist.move');
//checkout section
Route::get('checkout1',[CheckoutController::class,'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-first',[CheckoutController::class,'checkout1Store'])->name('checkout1.store')->middleware('user');
Route::post('checkout-second',[CheckoutController::class,'checkout2Store'])->name('checkout2.store')->middleware('user');
Route::post('checkout-third',[CheckoutController::class,'checkout3Store'])->name('checkout3.store')->middleware('user');
Route::post('checkout-last',[CheckoutController::class,'checkoutLastStore'])->name('checkoutlast.store')->middleware('user');
Route::get('order-complete/{order}',[CheckoutController::class,'orderComplete'])->name('complete')->middleware('user');

//shop section
Route::get('shop',[ShopController::class,'shop'])->name('shop');
Route::post('shop-filter',[ShopController::class,'shopFilter'])->name('shop.filter');

//search product & Autosearch
Route::get('autosarch',[AutosearchController::class,'autosearch'])->name('autosearch');
Route::get('search',[AutosearchController::class,'search'])->name('search');
//review
Route::resource('productreview', ProductReviewController::class);

// user auth
Route::group(['middleware' => ['user.beforeauth']], function () {
    Route::get('user/auth',[IndexController::class,'userAuth'])->name('user.auth');
    Route::post('user/login', [IndexController::class,'loginSubmit'])->name('login.submit');
    Route::post('user/register', [IndexController::class,'registerSubmit'])->name('register.submit');
});
//User routes
Route::group(['prefix' => 'user','middleware' => ['user']], function () {
    Route::get('user/logout', [IndexController::class,'userLogout'])->name('user.logout');
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
