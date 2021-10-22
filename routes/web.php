<?php

use App\Http\Controllers\Frontend\CurrencyLoadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------d-----------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ .'/frontend.php';

require __DIR__ .'/seller.php';

require __DIR__ .'/backend.php';


Auth::routes(['register'=> false,'login'=>false]);

//currency load
Route::post('currency-load',[CurrencyLoadController::class,'currencyLoad'])->name('currency.load');
