<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $product = new Product([
          'name'        => $request->get('name'),
          'sku'         => $request->get('sku'),
          'price'       => $request->get('price'),
          'description' => $request->get('description'),
          'is_downloadable' => $request->get('is_downloadable')
        ]);

        $product->save();

        // Process the uploaded image
        $imageName = $product->sku. '.' . $request->file('image')->getClientOriginalExtension();
        
        $request->file('image')->move(base_path() . '/public/imgs/products/', $imageName);

        // Process the electronic download
         
        if ($request->file('download')) {

            $downloadName = $product->sku. '.' . $request->file('download')->getClientOriginalExtension();
            
            $request->file('download')->move(storage_path() . '/downloads/', $downloadName);
        
            $product->download = $downloadName;
            $product->save();

        }

        return \Redirect::route('admin.products.edit', 
            [$product->id])->with('message', 'The product has been added!');   
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
        $product = Product::findOrFail($id);
        $slug = Str::slug($product->name);
        return view('admin.products.edit', compact('product', 'slug'));
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
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->get('name'), 
            'sku' => $request->get('sku'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'is_downloadable' => $request->get('is_downloadable')
        ]);

        return \Redirect::route('admin.products.edit', 
            [$product->id])->with('message', 'The product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        File::delete(base_path() . '/public/imgs/products/', $id . ".png");

        return \Redirect::route('admin.products.index')
            ->with('message', 'Product deleted!');
    }
}
