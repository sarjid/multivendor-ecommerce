<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //shop page
    public function shop(Request $request){
        $products = Product::query();
        //category
        if (!empty($_GET['category'])) {
           $slugs = explode(',',$_GET['category']);
           $cat_ids = Category::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
           $products =$products->whereIn('cat_id',$cat_ids);
        }

        //sortby product
        if (!empty($_GET['sortBy'])) {
            $sort = $_GET['sortBy'];
            if ($sort == 'priceAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price','ASC')->paginate(12);

            }elseif ($sort == 'priceDesc') {

                $products = $products->where(['status' => 'active'])->orderBy('offer_price','DESC')->paginate(12);

            }elseif ($sort == 'titleAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title','ASC')->paginate(12);

            }elseif ($sort == 'titleDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('title','DESC')->paginate(12);

            }elseif ($sort == 'disAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title','DESC')->paginate(12);

            }elseif ($sort == 'disDesc') {
               $products = $products->where(['status' => 'active'])->orderBy('title','DESC')->paginate(12);
            }else {
                $products = $products->where(['status' => 'active'])->orderBy('id','DESC')->paginate(12);
            }
        }else{
            $products = $products->where('status','active')->orderBy('id','DESC')->paginate(12);
        }

        $cats = Category::with('products')->where(['status' => 'active','is_parent'=>1])->orderBy('title','ASC')->get();
        return view('frontend.pages.product.shop',compact('products','cats'));
    }

    //shop category filter
    public function shopFilter(Request $request){
        $data = $request->all();
        //category filter
        $catUrl = '';
        if (!empty($data['category'])) {
            foreach($data['category'] as $category){
                if (empty($catUrl)) {
                   $catUrl .= '&category='.$category;
                }else {
                    $catUrl .= ','.$category;
                }
            }
        }
        //end category filter

        //sortyBy Product
        $sortByUrl = '';
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy='.$data['sortBy'];
        }
        return redirect()->route('shop',$catUrl.$sortByUrl);
    }
}
