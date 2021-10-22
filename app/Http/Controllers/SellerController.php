<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellerController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::orderBy('id','DESC')->get();
        return view('backend.seller.index',compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.seller.create');
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
            'title' => 'string|nullable',
            'description' => 'required|string',
            'photo' => 'required|string',
            'status' => 'required|string|in:active,inactive',
            'condition' => 'required|in:seller,promo'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Seller::where('slug',$slug)->count();
        if ($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        $status = seller::create($data);
        // $status = seller::create([
        //     'title' => $request->title,
        //     'slug' => $slug,
        //     'description' => $request->description,
        //     'photo' => $request->photo,
        //     'status' => $request->status,
        //     'condition' => $request->condition
        // ]);
        if ($status) {
            return redirect()->route('seller.index')->with('success','Successfully Added');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = Seller::find($id);
        if ($seller) {
            return view('backend.seller.edit',compact('seller'));
        }else{
            return redirect()->back('error','Data Not Found');
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
        $seller = Seller::find($id);
        if ($seller) {
            $data = $request->all();
            $status = $seller->fill($data)->save();

            if ($status) {
                return redirect()->route('seller.index')->with('success','Successfully Updated');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
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
        $seller = seller::find($id);
        if($seller){
            $status = $seller->delete();
            if ($status) {
                return redirect()->back()->with('success','Successfully Deleted');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
        }
    }


    //seller status
    public function status(Request $request){
        if ($request->status == 'true') {
            Seller::where('id',$request->id)->update(['status' => 'active']);
        }else {
           Seller::where('id',$request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg'=>'Successfully Data Updated','status' => true]);
   }

    //seller verify
    public function sellerVerified(Request $request){
        if ($request->mode == 'true') {
            Seller::where('id',$request->id)->update(['is_verified' => '1']);
            return response()->json(['msg'=>'Seller Verified Done','status' => true]);
        }else {
            Seller::where('id',$request->id)->update(['is_verified' => '0']);
            return response()->json(['msg'=>'Seller Unverified','status' => true]);
        }


    }


}
