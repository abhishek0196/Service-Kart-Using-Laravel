<?php

namespace App\Http\Controllers\ServiceproviderAuth\orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;
use Auth;


class AllOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        //select c.email,p.name from orders o,customers c,products p where c.id = `customer-id` and o.status = 'pending' and `serviceprovider-id`=1 and `service-id`=p.id;



        $sid = Auth::guard('serviceprovider')->user()->id;
        $ret = collect(DB::select("select o.id,o.`serviceprovider-id` as sid ,c.email,c.phone_no,o.google_code as gcode ,p.description,p.price,p.name,o.status from orders o,customers c,products p where c.id = `customer-id`  and `serviceprovider-id`=$sid and `service-id`=p.id;"))->sortByDesc('id');

          
        
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($ret);
     
 
        // Define how many items we want to be visible in each page
        $perPage = 4;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath(route('pending_orders.index'));
        //$user = DB::table('orders AS o','customers as c','products as p')->where('o.status', 'pending')->where('serviceprovider-id',$sid)->where('c.id','customer-id')->where('service-id','p.id')->get();
       //dd($user);
        
        return view('serviceprovider.orders.allorders.index')->with('data',$paginatedItems);
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
