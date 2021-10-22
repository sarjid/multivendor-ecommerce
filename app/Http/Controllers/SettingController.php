<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function create(){
        $setting = Setting::first();
        return view('backend.settings.create',compact('setting'));
    }

    //update
    public function update(Request $request){
        $data = $request->all();
        $setting = Setting::first();
        $status = $setting->update($data);
        if ($status) {
            return redirect()->back()->with('success','Successfully Updated');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }
}
