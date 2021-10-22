<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    //dahsboard
    public function dashboard(){
        return view('seller.index');
    }
}
