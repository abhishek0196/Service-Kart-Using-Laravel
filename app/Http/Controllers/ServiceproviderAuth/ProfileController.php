<?php

namespace App\Http\Controllers\ServiceproviderAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Serviceprovider;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serviceprovider.Profile.index');
    }


  
    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
            
        ]);
        $id = Auth::guard('serviceprovider')->user()->id;
        $updateProfile = Serviceprovider::find($id);
        $updateProfile->name = $request->input('name');
        $updateProfile->email = $request->input('email');
        $updateProfile->phone_no = $request->input('phone_no');
        $updateProfile->save();
        return view('serviceprovider.Profile.index')->with('success','updated');
    }

}