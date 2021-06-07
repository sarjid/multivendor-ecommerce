<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{



    public function index(){
        $banners = Banner::where(['status'=>'active','condition' =>'banner'])->orderBy('id','DESC')->limit('5')->get();
        $categories = Category::where(['status' => 'active','is_parent' => 1])->limit('3')->orderBy('id','DESC')->get();
        $allCategories = Category::where(['status' => 'active','is_parent' => 1])->orderBy('title','ASC')->get();
        $newProducts = Product::where(['status' => 'active', 'conditions' => 'new'])->orderBy('id','DESC')->get();
        return view('frontend.index',compact([
            'banners','categories','allCategories','newProducts'
            ]));
    }


    //produc category
    public function productCategory(Request $request,$slug){
        $categories = Category::with('products')->where('slug',$slug)->first();
        // short by product
        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }

        if ($categories == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {

                $products = Product::where(['status' => 'active','cat_id'=> $categories->id])->orderBy('offer_price','ASC')->paginate(12);

            }elseif ($sort == 'priceDesc') {

                $products = Product::where(['status' => 'active','cat_id'=> $categories->id])->orderBy('offer_price','DESC')->paginate(12);

            }elseif ($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active','cat_id'=> $categories->id])->orderBy('title','ASC')->paginate(12);

            }elseif ($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active','cat_id'=> $categories->id])->orderBy('title','DESC')->paginate(12);

            }elseif ($sort == 'disAsc') {
                $products = Product::where(['status' => 'active','cat_id'=> $categories->id])->orderBy('title','DESC')->paginate(12);

            }elseif ($sort == 'disDesc') {
               $products = Product::where(['status' => 'active','cat_id'=> $categories->id])->orderBy('title','DESC')->paginate(12);
            }else {
                $products = Product::where(['status' => 'active','cat_id' => $categories->id])->paginate(12);
            }
        }
        $route = 'product-category';
        // short by product END

        //ajax load more data
        if ($request->ajax()) {
            $view = view('frontend.layouts.single-product',compact('products'))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.pages.product.product-category',compact(['categories','route','products','sort']));
    }

    //product details
    public function productDetail($slug){
        $product = Product::with('rel_prods')->where('slug',$slug)->first();
        if ($product) {
            $photos = explode(',',$product->photo);
            return view('frontend.pages.product.product-detail',compact(['product','photos']));
        }else {
            return redirect()->back();
        }
    }


    //////////////////////////////// User AUthentication system ============================
    public function userAuth(){
        Session::put('urinl.tended',URL::previous());
        return view('frontend.auth.auth');
    }


    //user login
    public function loginSubmit(Request $request){
        $this->validate($request,[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>'active'])) {
            Session::put('user',$request->email);
            if (Session::get('url.intended')) {
               return Redirect::to(Session::get('url.intended'));
            }else {
                return redirect()->route('home')->with('success','Login Success');
            }
        }else {
           return redirect()->with('error','Invalid Email Or Password');
        }
    }


    //use registration
    public function registerSubmit(Request $request){
        $this->validate($request,[
            'username' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed'
        ]);

        $data = $request->all();
        $check = $this->create($data);
        Session::put('user',$request->email);
        Auth::login($check);

        if ($check) {
            return redirect()->route('home')->with('success','Registration Complete');
        }else {
            return redirect()->back()->with('error','Check Your Credentials');
        }
    }

    private function create(array $data){
           return User::create([
                    'full_name' => $data['full_name'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                 ]);
    }

    ////// end user registration


    //user logout
    public function userLogout(){
        Session::forget('user');
        Auth::logout();
       return redirect()->route('home')->with('success','Logout Success');
    }


    // ============================= User Dashboard =================
    public function userDashboard(){
        $user = Auth::user();
        return view('frontend.user.dashboard',compact('user'));
    }

    //user order
    public function userOrder(){
        $user = Auth::user();
        return view('frontend.user.order',compact('user'));
    }

     //user address
     public function userAddress(){
        $user = Auth::user();
        return view('frontend.user.address',compact('user'));
    }

    //user account details
    public function userAccount(){
        $user = Auth::user();
        return view('frontend.user.account-detail',compact('user'));
    }


    //user account update
    public function updateAccount(Request $request,$id){
        $request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'phone' => 'required',
        ]);

        $user = User::where('id',$id)->update([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'phone' => $request->phone,
        ]);

        if ($user) {
            return redirect()->back()->with('success','Successfully Updated');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }

    //user billing address
    public function billingAddress(Request $request,$id){
       $user = User::where('id',$id)->update([
           'country' => $request->country,
           'city' => $request->city,
           'address' => $request->address,
           'postcode' => $request->postcode,
           'state' => $request->state,
       ]);
       if ($user) {
            return redirect()->back()->with('success','Successfully Updated');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }

        //user Shipping address
        public function shippingAddress(Request $request,$id){
            $user = User::where('id',$id)->update([
                'scountry' => $request->scountry,
                'scity' => $request->scity,
                'saddress' => $request->saddress,
                'spostcode' => $request->spostcode,
                'sstate' => $request->sstate,
            ]);
            if ($user) {
                 return redirect()->back()->with('success','Shipping Address Updated');
             }else {
                 return back()->with('error','Something Went Wrong');
             }
         }

         /// user password
         public function userPassword(){
             $user = Auth::user();
             return view('frontend.user.password',compact('user'));
         }

        // user password update
        public function updatePassword(Request $request,$id){
            $request->validate([
                'oldpassword' => 'required',
                'password' => 'required|min:4|confirmed'
            ]);
            $hashPassword = Auth::user()->password;
            if (Hash::check($request->oldpassword, $hashPassword)) {
                if (Hash::check($request->password, $hashPassword)) {
                    User::where('id',$id)->update(['password' => Hash::make($request->password)]);
                    Auth::logout();
                    return redirect()->route('user.auth')->with('success','Password Change Success');
                }else {
                    return back()->with('oldpassError','Opps..! new password can not be same with old password');
                }
            }else {
                return back()->with('oldpassError','Opps..! old password not match');
            }
        }
}
