<?php

namespace App\Http\Controllers\CustomerAuth\Orders;
use App\Product;

use App\Serviceprovider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Mail;

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
        $google_code = $request->input('google_code');
       
        DB::table('orders')->insert(
            ['customer-id' => Auth::guard('customer')->user()->id, 'serviceprovider-id' => $request->input('psid'),'service-id' => $request->input('pid'),'google_code' => $google_code ]
        );

        $data = array('name'=>Auth::guard('customer')->user()->name,'pname'=>$request->input('pname'),'pDesc'=>$request->input('pdesc'));
        Mail::send('mail.mail', $data, function($message) {
           $message->to(Auth::guard('customer')->user()->email, Auth::guard('customer')->user()->name)->subject
              ('Service Kart');
           
        });
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
        
        $query = Serviceprovider::find($product->serviceprovider_id);
        
     
        return view('customer.order.Office.show')->with('product',$product)->with('serviceprovider',$query);
    }
    public function categoryView()
    {
        $query = DB::select('select * from product_tags where pcid = ?', [1]);

        return view('customer.order.Office.category')->with('data' ,$query);
    }

    public function  productView($id)
    {
        $query = DB::select('select * from products  where id in (select product_id from product_product_tag where product_tag_id = ? )',[$id]);
        return view('customer.order.Office.index')->with('cproducts',$query);;
        
        
        
    }
}
