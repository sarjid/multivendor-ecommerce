<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id','DESC')->get();
        return view('backend.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'condition' => 'required|in:banner,promo'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();
        if ($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        $status = Banner::create($data);
        // $status = Banner::create([
        //     'title' => $request->title,
        //     'slug' => $slug,
        //     'description' => $request->description,
        //     'photo' => $request->photo,
        //     'status' => $request->status,
        //     'condition' => $request->condition
        // ]);
        if ($status) {
            return redirect()->route('banner.index')->with('success','Successfully Added');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }


    //banner status
    public function status(Request $request){
        if ($request->status == 'true') {
            Banner::where('id',$request->id)->update(['status' => 'active']);
        }else {
           Banner::where('id',$request->id)->update(['status' => 'inactive']);
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
        $banner = Banner::find($id);
        if ($banner) {
            return view('backend.banner.edit',compact('banner'));
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
        $banner = Banner::find($id);
        if ($banner) {
            $data = $request->all();
            $status = $banner->fill($data)->save();
            // $status = Banner::create([
            //     'title' => $request->title,
            //     'description' => $request->description,
            //     'photo' => $request->photo,
            //     'status' => $request->status,
            //     'condition' => $request->condition
            // ]);
            if ($status) {
                return redirect()->route('banner.index')->with('success','Successfully Updated');
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
        $banner = Banner::find($id);
        if($banner){
            $status = $banner->delete();
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
