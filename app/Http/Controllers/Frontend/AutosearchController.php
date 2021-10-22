<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AutosearchController extends Controller
{
    //autosearch
    public function autosearch(Request $request){
        $query = $request->get('term','');
        $products = Product::where('title','like','%'.$query.'%')->get();

        $data = array();
        foreach ($products as $product) {
            $data[] = array('value'=>$product->title,'id'=>$product->id);
        }

        if (count($data)) {
           return $data;
        }else{
            return ['value' => 'No Result Found','id'=>''];
        }
    }

    //search
    public function search(Request $request){
        $query = $request->input('query');
        $products = Product::where('title','LIKE','%'.$query.'%')->orderBy('id','DESC')->paginate(12);
        $cats = Category::with('products')->where(['status' => 'active','is_parent'=>1])->orderBy('title','ASC')->get();
        $brands = Brand::with('products')->where('status','active')->orderBy('title','ASC')->get();
        return view('frontend.pages.product.shop',compact('products','cats','brands'));

    }
}
