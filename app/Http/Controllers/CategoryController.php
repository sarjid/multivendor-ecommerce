<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCat = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.category.create',compact('parentCat'));
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
            'summary' => 'string|nullable',
            'photo' => 'required|string',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if ($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent',0);
        $status = Category::create($data);
        if ($status) {
            return redirect()->route('category.index')->with('success','Successfully Added');
        }else {
            return back()->with('error','Something Went Wrong');
        }
    }

        //Category status
        public function status(Request $request){
            if ($request->status == 'true') {
                Category::where('id',$request->id)->update(['status' => 'active']);
            }else {
               Category::where('id',$request->id)->update(['status' => 'inactive']);
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
        $category = Category::find($id);
        if ($category) {
            $parentCat = Category::where('is_parent',1)->orderBy('title','ASC')->get();
            return view('backend.category.edit',compact('category','parentCat'));
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
        $category = Category::find($id);
        if ($category) {
            $data = $request->all();

            if ($request->is_parent) {
                $data['parent_id'] = null;
            }
            $data['is_parent'] = $request->input('is_parent',0);
            $status = $category->fill($data)->save();
            if ($status) {
                return redirect()->route('category.index')->with('success','Successfully Updated');
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
        $category = Category::find($id);
        $child_cat_id = Category::where('parent_id',$id)->pluck('id');
        if($category){
            $status = $category->delete();
            if ($status) {
                if (count($child_cat_id) > 0) {
                   Category::shiftChild($child_cat_id);
                }
                return redirect()->back()->with('success','Successfully Deleted');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
        }
    }



    //get child by parent id
    public function getChildByParentId(Request $request){
        $category = Category::find($request->id);
        if ($category) {
            $child_id = Category::getChildByParentID($request->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false,'data'=> null,'msg'=>'data not found']);
            }else {
                return response()->json(['status' => true,'data'=> $child_id,'msg'=>'']);
            }
        }else {
            return response()->json(['status' => false,'data'=> null,'msg'=>'data not found']);
        }
    }
}
