<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('seller.auth.login');
    }

    //login admin
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       if(Auth::guard('seller')->attempt(['email'=> $request->email,'password' => $request->password,'status'=>'active'])){
            return redirect()->intended(route('seller'))->with('success','login success');
       }else {
         return back()->withInput($request->only('email'))->with('error','Opps..! Email Or Password Invalid');
       }
    }
}
