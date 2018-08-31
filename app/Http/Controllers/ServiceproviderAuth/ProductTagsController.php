<?php


namespace App\Http\Controllers\ServiceproviderAuth;

use App\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductTagsRequest;
use App\Http\Requests\Admin\UpdateProductTagsRequest;

class ProductTagsController extends Controller
{
    /**
     * Display a listing of ProductTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_tags = ProductTag::all();

        return view('serviceprovider.products.product_tags.index', compact('product_tags'));
    }

    /**
     * Show the form for creating new ProductTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('serviceprovider.products.product_tags.create');
    }

    /**
     * Store a newly created ProductTag in storage.
     *
     * @param  \App\Http\Requests\StoreProductTagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTagsRequest $request)
    {
       
        $product_tag = ProductTag::create($request->all());



        return redirect()->route('product_tags.index');
    }    /**
     * Show the form for editing ProductTag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product_tag = ProductTag::findOrFail($id);

        return view('serviceprovider.products.product_tags.edit', compact('product_tag'));
    }

    /**
     * Update ProductTag in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTagsRequest $request, $id)
    {
       
        $product_tag = ProductTag::findOrFail($id);
        $product_tag->update($request->all());



        return redirect()->route('product_tags.index');
    }


    /**
     * Display ProductTag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $products = \App\Product::whereHas('tag',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $product_tag = ProductTag::findOrFail($id);

        return view('serviceprovider.products.product_tags.show', compact('product_tag', 'products'));
    }


    /**
     * Remove ProductTag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $product_tag = ProductTag::findOrFail($id);
        $product_tag->delete();

        return redirect()->route('product_tags.index');
    }

    /**
     * Delete all selected ProductTag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
 
        if ($request->input('ids')) {
            $entries = ProductTag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
