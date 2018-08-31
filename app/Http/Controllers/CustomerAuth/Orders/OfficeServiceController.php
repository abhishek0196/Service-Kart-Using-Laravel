<?php

namespace App\Http\Controllers\CustomerAuth\Orders;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class OfficeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('product_product_category')->where('product_category_id', 1)->pluck('product_id');
        $query = DB::table('products')->whereIn('id',$user)->get();
        
        return view('customer.order.Office.index')->with('products',$query);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        DB::table('orders')->insert(
            ['customer-id' => Auth::guard('customer')->user()->id, 'serviceprovider-id' => $request->input('psid'),'service-id' => $request->input('pid') ]
        );
        return redirect('/customer/home');//->with('success', 'Post Removed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('customer.order.Office.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
