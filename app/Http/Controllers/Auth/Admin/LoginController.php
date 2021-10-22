<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.admin.login');
    }

    //login admin
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       if(Auth::guard('admin')->attempt(['email'=> $request->email,'password' => $request->password])){
            return redirect()->intended(route('admin'))->with('success','login success');
       }else {
         return back()->withInput($request->only('email'))->with('error','Opps..! Email Or Password Invalid');
       }
    }
}
