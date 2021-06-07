<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //store cart
    public function cartStore(Request $request){
        if (session()->has('coupon')) {
           session()->forget('coupon');
        }
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;
        //get getProductByCart comes from model
        $product = Product::getProductByCart($product_id);
        if ($product[0]['offer_price'] == 0) {
           $price = $product[0]['price'];
        }else {
            $price = $product[0]['offer_price'];
        }

        $result = Cart::instance('shopping')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
        if ($result) {
            $response['status'] = true;
            // $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item Was Added To Your Cart";
        }
        //for header mini cart
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }

        return json_encode($response);
    }


    //mini cart delete
    public function cartDelete(Request $request){
        if (session()->has('coupon')) {
            session()->forget('coupon');
         }
        $rowId = $request->input('cart_id');
        $result = Cart::instance('shopping')->remove($rowId);
        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Item Was Delete From Your Cart";
        //for header mini cart
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $cartList = view('frontend.layouts._cart-lists')->render();
            $response['cart_list'] = $cartList;
            $response['header'] = $header;

        }

        return $response;
    }


    //////////// cart Page /////////////////
    public function cart(){
        return view('frontend.pages.cart.index');
    }

    //cart update
    public function cartUpdate(Request $request){
        $request->validate([
            'product_qty' => 'required|min:1|numeric'
        ]);

        if (session()->has('coupon')) {
            session()->forget('coupon');
         }

        $rowId = $request->input('rowId');
        $requestproduct_qty = $request->input('product_qty');
        $product_stock = $request->input('product_stock');
        //check stock
        if ($request->product_qty > $product_stock) {
            $message = "we currently don not have enough items in stock";
            $response['status'] = false;
        }elseif ($request->product_qty == 0) {
            $message = "you cant not add less than 1 quantity";
            $response['status'] = false;
        }else {

            Cart::instance('shopping')->update($rowId,$requestproduct_qty);
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $message = "Quantity Update Success";
            $response['status'] = true;

            // if (Session::has('coupon')) {
            //     $code = Session::get('coupon')['code'];
            //     $coupon = Coupon::where('code',$code)->first();
            //     $total_price = Cart::instance('shopping')->subtotal();
            //     $price = str_replace(',','',$total_price);
            //     Session::put('coupon',[
            //         'id' => $coupon->id,
            //         'code' => $coupon->code,
            //         'value' => $coupon->discount($price), // here discount equal from coupon modal
            //     ]);
            // }
        }

         //for header mini cart
         if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $cartList = view('frontend.layouts._cart-lists')->render();
            $response['header'] = $header;
            $response['cart_list'] = $cartList;
            $response['message'] = $message;
        }

        return $response;
    }
    //coupon add
    public function couponAdd(Request $request){
       $coupon = Coupon::where('code',$request->code)->where('status','active')->first();
       if ($coupon) {
            $total_price = Cart::instance('shopping')->subtotal();
            $price = str_replace(',','',$total_price);
            Session::put('coupon',[
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($price), // here discount equal from coupon modal
            ]);
            return redirect()->back()->with('success','Coupon Applied Success');

       }else {
            return redirect()->back()->with('error','Invalid coupon code, Please enter valid coupon ');
       }
    }
}
