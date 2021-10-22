<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
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
        //price range product
        if (!empty($_GET['price'])) {
            $price = explode('-',$_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('offer_price',$price)->where('status','active');
        }

         //brand
         if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            $products =$products->whereIn('brand_id',$brand_ids);
         }

         //size
         if (!empty($_GET['size'])) {
            $products =$products->where('size',$_GET['size']);
         }

        //sortby product
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price','ASC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'priceDesc') {

                $products = $products->where(['status' => 'active'])->orderBy('offer_price','DESC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title','ASC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('title','DESC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'disAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title','DESC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'disDesc') {
               $products = $products->where(['status' => 'active'])->orderBy('title','DESC')->paginate(12);
            }else {
                $products = $products->where(['status' => 'active'])->orderBy('id','DESC')->paginate(12);
            }


        }else{
            $products = $products->where('status','active')->orderBy('id','DESC')->paginate(12);
        }

        $cats = Category::with('products')->where(['status' => 'active','is_parent'=>1])->orderBy('title','ASC')->get();
        $brands = Brand::with('products')->where('status','active')->orderBy('title','ASC')->get();
        return view('frontend.pages.product.shop',compact('products','cats','brands'));
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

        //sortyBy filter
        $sortByUrl = '';
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy='.$data['sortBy'];
        }
        //price range filter
        $priceRangeUrl = "";
        if(!empty($data['price_range'])){
            $priceRangeUrl .= '&price='.$data['price_range'];
        }

        //brand filter
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach($data['brand'] as $brand){
                if (empty($brandUrl)) {
                   $brandUrl .= '&brand='.$brand;
                }else {
                    $brandUrl .= ','.$brand;
                }
            }
        }

        //size filter
        $sizeUrl = "";
        if (!empty($data['size'])) {
            $sizeUrl .= '&size='.$data['size'];
        }
        //  dd($priceRangeUrl);
        return redirect()->route('shop',$catUrl.$sortByUrl.$priceRangeUrl.$brandUrl.$sizeUrl);
    }
}
