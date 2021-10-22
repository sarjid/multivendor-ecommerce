<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class CheckoutController extends Controller
{
    //checkout page
    public function checkout1(){
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout1',compact('user'));
    }

    //store
    public function checkout1Store(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'country' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'required|numeric',
            'note' => 'required|string',
            'sfirst_name' => 'required|string',
            'slast_name' => 'required|string',
            'sphone' => 'required|string',
            'scountry' => 'required|string',
            'saddress' => 'required|string',
            'scity' => 'required|string',
            'sstate' => 'required|string',
            'spostcode' => 'required|numeric',
        ]);

        Session::put('checkout',[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'note' => $request->note,
            'sfirst_name' => $request->sfirst_name,
            'slast_name' => $request->slast_name,
            'sphone' => $request->sphone,
            'semail' => $request->semail,
            'scountry' => $request->scountry,
            'saddress' => $request->saddress,
            'scity' => $request->scity,
            'sstate' => $request->sstate,
            'spostcode' => $request->spostcode,
        ]);

        $shippings = Shipping::where('status','active')->orderBy('shipping_address','ASC')->get();
        return view('frontend.pages.checkout.checkout2',compact('shippings'));
    }

    //checkout2
    public function checkout2Store(Request $request){

        $request->validate([
            'delivery_charge' => 'required'
        ]);

        if (empty(Session::get('checkout')[0]['delivery_charge'])) {
            Session::push('checkout',[
                'delivery_charge' => $request->delivery_charge
            ]);
        }
        return view('frontend.pages.checkout.checkout3');
    }


    //chekckout 3
    public function checkout3Store(Request $request){
       $request->validate([
           'payment_method' => 'required|string',
       ]);

       if (empty(Session::get('checkout')[1]['payment_method']) && empty(Session::get('checkout')[1]['payment_status'])) {
           Session::push('checkout',[
               'payment_method' => $request->payment_method,
               'payment_status' =>'unpaid',
           ]);
       }

        return view('frontend.pages.checkout.checkout4');
    }

    //checkout last store
    public function checkoutLastStore(Request $request){
        $order = new Order();
        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD-'.Str::random(6));
        if (Session::has('coupon')) {
            $order['coupon'] = str_replace(',','',Session::get('coupon')['value']);
        }else{
            $order['coupon'] =  0;
        }
        $order['quantity'] = Cart::instance('shopping')->count();
        $order['sub_total'] =  str_replace(',','',Cart::instance('shopping')->subtotal());
        $order['total_amount'] = str_replace(',','',Cart::instance('shopping')->subtotal()) + Session::get('checkout')[0]['delivery_charge'] - $order['coupon'];
        $order['payment_method'] = Session::get('checkout')['1']['payment_method'];
        $order['payment_status'] = 'unpaid';
        $order['delivery_charge'] = Session::get('checkout')['0']['delivery_charge'];
        $order['condition'] = "pending";
        $order['first_name'] = Session::get('checkout')['first_name'];
        $order['last_name'] = Session::get('checkout')['last_name'];
        $order['email'] = Session::get('checkout')['email'];
        $order['phone'] = Session::get('checkout')['phone'];
        $order['country'] = Session::get('checkout')['country'];
        $order['city'] = Session::get('checkout')['city'];
        $order['state'] = Session::get('checkout')['state'];
        $order['address'] = Session::get('checkout')['address'];
        $order['postcode'] = Session::get('checkout')['postcode'];
        $order['note'] = Session::get('checkout')['note'];

        $order['sfirst_name'] = Session::get('checkout')['sfirst_name'];
        $order['slast_name'] = Session::get('checkout')['slast_name'];
        $order['semail'] = Session::get('checkout')['semail'];
        $order['sphone'] = Session::get('checkout')['sphone'];
        $order['scountry'] = Session::get('checkout')['scountry'];
        $order['scity'] = Session::get('checkout')['scity'];
        $order['sstate'] = Session::get('checkout')['sstate'];
        $order['saddress'] = Session::get('checkout')['saddress'];
        $order['spostcode'] = Session::get('checkout')['spostcode'];
        $status = $order->save();

        //products item save
        foreach (Cart::instance('shopping')->content() as $item) {
            $product_id[] = $item->id;
            $product = Product::find($item->id);
            $quantity  = $item->qty;
            $order->products()->attach($product,['quantity' => $quantity]);
        }
       if ($status) {
        Mail::to($order['email'])->bcc($order['semail'])->cc('habil@gmail.com')->send(new OrderMail($order));
           if (Session::has('coupon')) {
               Session::forget('coupon');
           }
           Session::forget('checkout');
           Cart::instance('shopping')->destroy();

           return redirect()->route('complete',$order['order_number']);
       }else {
            return redirect()->route('checkout1')->with('error','plase try again');
       }
    }

    // ------------- Complete Order ------------------
    public function orderComplete($order){
        $order = Order::where('order_number',$order)->value('order_number');
        if ($order) {
            return view('frontend.pages.checkout.complete',compact('order'));
        }else {
            return view('errors.404');
        }
    }

}
