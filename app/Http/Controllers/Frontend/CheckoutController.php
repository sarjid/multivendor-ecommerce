<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //checkout page
    public function checkout1(){
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout1',compact('user'));
    }

    //store
    public function checkout1Store(Request $request){
        dd($request->all());
    }


    $productImage = Product::where('id',$id)->value('thambnail_image');
    return $productImage;

}
