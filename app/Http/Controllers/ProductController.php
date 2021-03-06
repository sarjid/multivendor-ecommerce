<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->get();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Seller::orderBy('username','ASC')->get();
        $categories = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        $brands = Brand::orderBy('title','ASC')->get();
        return view('backend.product.create',compact('vendors','categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string',
            'photo' => 'required|string',
            'conditions' => 'required|string|in:new,popular,winter',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug',$slug)->count();
        if ($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
       $data['added_by'] = 'admin';
       $data['user_id'] = auth('admin')->user()->id;

        $data['offer_price'] = (round($request->price - (($request->price * $request->discount)/100)));
        $status = Product::create($data);
        if ($status) {
            return redirect()->route('product.index')->with('success','Successfully Added');
        }else {
            return redirect()->back()->with('error','Something Wrong');

        }
    }

    //banner status
    public function status(Request $request){
        if ($request->status == 'true') {
            Product::where('id',$request->id)->update(['status' => 'active']);
        }else {
           Product::where('id',$request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg'=>'Successfully Data Updated','status' => true]);
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productAttributes = ProductAttribute::where('product_id',$id)->orderBy('size','ASC')->get();
        $product = Product::find($id);
        if($product){
            return view('backend.product.product-attribute',compact('product','productAttributes'));
        }else{
            return redirect()->back()->with('error','Something Wrong');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            $vendors = Seller::orderBy('username','ASC')->get();
            $categories = Category::where('is_parent',1)->orderBy('title','ASC')->get();
            $brands = Brand::orderBy('title','ASC')->get();
            $multiPhoto = explode(',',$product->photo);
            $sizeGuide = explode(',',$product->size_guide);
           return view('backend.product.edit',compact('product','vendors','categories','brands','multiPhoto','sizeGuide'));
        }else {
            return redirect()->back()->with('error','Something Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string',
            'photo' => 'required|string',
            'conditions' => 'required|string|in:new,popular,winter',
            'status' => 'required|string|in:active,inactive',
        ]);

        $product = Product::find($id);
        if ($product) {
            $data = $request->all();
            $slug = Str::slug($request->input('title'));
            $slug_count = Product::where('slug',$slug)->count();
            if ($slug_count > 0) {
                $slug = time().'-'.$slug;
            }
            $data['slug'] = $slug;
            $data['offer_price'] = (round($request->price - (($request->price * $request->discount)/100)));
            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('product.index')->with('success','Successfully Data Updated');
            }else {
                return redirect()->back()->with('error','Something Wrong');
            }
        }else {
            return redirect()->back()->with('error','Not Found');

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $status = $product->delete();
            if ($status) {
                return redirect()->back()->with('success','Successfully Deleted');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
        }
    }


    //store product attribute
    public function attributeStore(Request $request,$pID){

        $request->validate([
            'original_price' => 'required',
            'size' => 'required'
        ]);

        $data = $request->all();
        foreach ($data['original_price'] as $key => $value) {
           if (!empty($value)) {
                $att = new ProductAttribute();
                $att['product_id'] = $pID;
                $att['original_price'] = $value;
                $att['offer_price'] = $data['offer_price'][$key];
                $att['size'] = $data['size'][$key];
                $att['stock'] = $data['stock'][$key];
                $att->save();
           }
        }

        return redirect()->back()->with('success','Added Success');
    }

    //delete product attribute
    public function attributeDelete($id){
        $product = ProductAttribute::find($id);
        if($product){
            $status = $product->delete();
            if ($status) {
                return redirect()->back()->with('success','Successfully Deleted');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
        }
    }

}
