<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BrandController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->get();
        return view('backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'photo' => 'required|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if ($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        $status = Brand::create($data);
        if ($status) {
            return redirect()->route('brand.index')->with('success','Successfully Added');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }


    //banner status
    public function status(Request $request){
        if ($request->status == 'true') {
            Brand::where('id',$request->id)->update(['status' => 'active']);
        }else {
           Brand::where('id',$request->id)->update(['status' => 'inactive']);
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
        $brand = Brand::find($id);
        if ($brand) {
            return view('backend.brand.edit',compact('brand'));
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
        $brand = Brand::find($id);
        if ($brand) {
            $data = $request->all();
            $status = $brand->fill($data)->save();
            if ($status) {
                return redirect()->route('brand.index')->with('success','Successfully Updated');
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
        $brand = Brand::find($id);
        if($brand){
            $status = $brand->delete();
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
