<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyLoadController extends Controller
{
    //load
    public function currencyLoad(Request $request){
        session()->put('currency_code',$request->currency_code);
        $currency = Currency::where('code',$request->currency_code)->first();
        session()->put('currency_symbol',$currency->symbol);
        session()->put('currency_exchange_rate',$currency->exchange_rate);
        $response['status'] = true;
        return $response;
    }
}
