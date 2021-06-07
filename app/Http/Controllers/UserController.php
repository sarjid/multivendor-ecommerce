<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
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
            'username' => 'required|string',
            'full_name' => 'required|string',
            'phone' => 'required|unique:users,phone',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'photo' => 'required|string',
            'role' => 'required|in:admin,customer,vendor',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $status = User::create($data);
        if ($status) {
           return redirect()->route('user.index')->with('success','User Successfully Added');
        }else {
            return redirect()->back()->with('error','Opps..! Something Went Wrong');

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
        $user = User::find($id);
        if ($user) {
           return view('backend.user.edit',compact('user'));
        }else {
            return redirect()->back()->with('error','Opps..! Not found');
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
            'username' => 'required|string',
            'full_name' => 'required|string',
            'phone' => 'required|exists:users,phone',
            'address' => 'nullable|string',
            'email' => 'required|email|exists:users,email',
            'photo' => 'required|string',
            'role' => 'required|in:admin,customer,vendor',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::find($id);
        if ($user) {
            $data = $request->all();
            $status = $user->fill($data)->save();
            if ($status) {
                return redirect()->route('user.index')->with('success','User Successfully Updated');
            }else {
                return redirect()->back('error','Not Insert');
            }
        }else{
            return redirect()->back('error','Not Found');
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
        $user = User::find($id);
        if($user){
            $status = $user->delete();
            if ($status) {
                return redirect()->back()->with('success','Successfully Deleted');
            }else {
                return back()->with('error','Something Went Wrong');
            }
        }else{
            return redirect()->back('error','Data Not Found');
        }
    }


     //User status
     public function status(Request $request){
        if ($request->status == 'true') {
            User::where('id',$request->id)->update(['status' => 'active']);
        }else {
           User::where('id',$request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg'=>'Successfully Data Updated','status' => true]);
   }
}
