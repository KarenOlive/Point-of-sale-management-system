<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {



        $products = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('barcodes', 'barcodes.product_id', '=', 'products.id')
        ->select('products.*', 'categories.category_name', 'barcodes.barcode' )
        ->get();

        //dd($products);
        $c = Category::all();

        return view('product.products', compact('products', 'c'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {



        $product = new Product();

        $product->product_name = $request->productname;
        $product->brand = $request->brand;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->metric_units = $request->metricunits;
        $product->alert_stock = $request->alertstock;



        $product->save();


        Alert::toast('Product added successfully', 'success');

       return redirect('/product')->with(['Success'=>'Product added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'status' => 200,
            'product' => $product,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
         Product::where('id', $request->productid)->update([
            'product_name' => $request->productname,
            'brand' => $request->brand,
            'category_id' => $request->category,
            'price' => $request->price,
            'metric_units' =>  $request->metricunits,
            'alert_stock' => $request->alertstock


        ]);

        Alert::toast('Product Updated', 'success');


         return redirect(route('product.index'))->with('message', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product  $product)
    {

    }

    public function delete($id){

        $product = Product::findOrFail($id);
        $product->delete();
       Alert::toast('Product Deleted', 'success');

      return redirect(route('product.index'));

    }

    public function all(){
        $products = Product::all();
        return view ('product.add-product', compact('products'));
    }
}
