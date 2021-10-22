<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $currencies = Currency::orderBy('id','desc')->get();
       return view('backend.currency.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.currency.create');
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
            'code' => 'string',
            'name' => 'required',
            'symbol' => 'required',
            'exchange_rate' => 'required|numeric',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();
        $status = Currency::create($data);
        if ($status) {
            return redirect()->route('currency.index')->with('success','Successfully Added');
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
        $currency = Currency::find($id);
        if ($currency) {
            return view('backend.currency.edit',compact('currency'));
        }
        abort(404);
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
            'code' => 'string',
            'name' => 'required',
            'symbol' => 'required',
            'exchange_rate' => 'required|numeric',
            'status' => 'required|string|in:active,inactive',
        ]);

        $data = $request->all();
        $status = Currency::findOrFail($id)->update($data);
        if ($status) {
            return redirect()->route('currency.index')->with('success','Successfully Updated');
        }else {
            return back()->with('error','Something Went Wrong');
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
        $Currency = Currency::find($id);
        if($Currency){
            $status = $Currency->delete();
            if ($status) {
                return redirect()->back()->with('success','Successfully Deleted');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
        }
    }


     //currency status
     public function status(Request $request){
        if ($request->status == 'true') {
            Currency::where('id',$request->id)->update(['status' => 'active']);
        }else {
            Currency::where('id',$request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg'=>'Successfully Data Updated','status' => true]);
   }
}
