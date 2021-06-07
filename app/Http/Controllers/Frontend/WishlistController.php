<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    //index
    public function wishlist(){
        return view('frontend.pages.wishlist.index');
    }

    //store
    public function wishlistStore(Request $request){

        $product_id = $request->product_id;
        $product_qty = $request->product_qty;
        $product = Product::getProductByCart($product_id);
        if ($product[0]['offer_price'] == 0) {
           $price = $product[0]['price'];
        }else {
            $price = $product[0]['offer_price'];
        }

         $wishlist_Array = [];
        foreach (Cart::instance('wishlist')->content() as $item) {
            $wishlist_Array[] = $item->id;
        }

        if (in_array($product_id,$wishlist_Array)) {
            $response['message_error'] = "Opps..! Already In Wishlist";
        }else {
            $result = Cart::instance('wishlist')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
            if ($result) {
                $response['status'] = true;
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
                $response['message'] = "Item Added To Your Wishlist";
            }
        }
        return json_encode($response);

    }

    // move to wishlist from cart
    public function wishlistMove(Request $request){
        $item = Cart::instance('wishlist')->get($request->input('rowId'));
        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result = Cart::instance('shopping')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if ($result) {
            $response['status'] = true;
            $response['wishlist_count'] = Cart::instance('wishlist')->count();
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
            $response['message'] = "Item Move To Cart Success";

        }
        if ($request->ajax()) {
            $wishlist_page = view('frontend.layouts._wishlist')->render();
            $response['wishlist_page'] = $wishlist_page;
        }

        return json_encode($response);


    }
}
