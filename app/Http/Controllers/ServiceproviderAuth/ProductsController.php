<?php

namespace App\Http\Controllers\ServiceproviderAuth;


use App\Product;
use App\Serviceprovider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ProductsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $service_provider_id = Auth::guard('serviceprovider')->user()->id;
        
        $serviceprovider = Serviceprovider::find($service_provider_id);
         //return $serviceprovider->products;
 return view('serviceprovider.products.products.index')->with('products',$serviceprovider->products);
    }

    /**
     * Show the form for creating new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $categories = \App\ProductCategory::get()->pluck('name', 'id');

        $tags = \App\ProductTag::get()->pluck('name', 'id');


        return view('serviceprovider.products.products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  \App\Http\Requests\StoreProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
       
        $request = $this->saveFiles($request);
        $product = Product::create($request->all());
        $product->category()->sync(array_filter((array)$request->input('category')));
        $product->tag()->sync(array_filter((array)$request->input('tag')));
        return redirect()->route('products.index');
    }


    /**
     * Show the form for editing Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        
        $categories = \App\ProductCategory::get()->pluck('name', 'id');

        $tags = \App\ProductTag::get()->pluck('name', 'id');

        

        $product = Product::findOrFail($id);

        return view('serviceprovider.products.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update Product in storage.
     *
     * @param  \App\Http\Requests\UpdateProductsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $id)
    {
     
        $request = $this->saveFiles($request);
        $product = Product::findOrFail($id);
        $product->update($request->all());
        $product->category()->sync(array_filter((array)$request->input('category')));
        $product->tag()->sync(array_filter((array)$request->input('tag')));



        return redirect()->route('products.index');
    }


    /**
     * Display Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $product = Product::findOrFail($id);

        return view('serviceprovider.products.products.show', compact('product'));
    }


    /**
     * Remove Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
  
        
            $entries = Product::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        
    }

}
