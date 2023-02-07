<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorHTML;
use RealRashid\SweetAlert\Facades\Alert;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $barcodes = Barcode::all();

        return view('product.barcode', compact('barcodes', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $products = Product::all();
       $barcodes = Barcode::all();

       return view('product.barcode', compact('products', 'barcodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $productid = $request->product;

       $p = Product::where('id',  $productid)->firstOrFail();
       $name = $p->product_name;
       $brand = $p->brand;
        $price = $p->price;

        // $products = DB::select('select product_name, price from products where id = ?', [$productid]);


         $generator = new BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode( $productid, $generator::TYPE_CODE_128);


        // $generator = new BarcodeGeneratorPNG();
        // $generator->useGd();
        // $img = imagecreate(150, 150);
        // $barcodes = $img . base64_encode($generator->getBarcode($request->product, $generator::TYPE_CODE_128)) . '">';

            // $generator = new BarcodeGeneratorJPG();
            // $generator->useImagick();
            // file_put_contents('products/barcodes/'. $productid.'.jpg',
            // $generator->getBarcode( $name, $generator::TYPE_CODE_128, 3, 30));

            $code = new Barcode();
            $code->product_id =  $productid;
            // $code->barcode =  $productid.'.jpg';
            $code->barcode = $barcodes;

            $code->save();
            Alert::toast('Barcode created successfully', 'success');
            return redirect(route('product.index'));







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
        $generator = new BarcodeGeneratorHTML();

        $barcodes = $generator->getBarcode($request->product, $generator::TYPE_CODE_128);

        $c = Barcode::findOrFail($id);
        $c->product_id = $request->product;
        $c->barcode = $barcodes;
        $c->update();
        Alert::toast('Barcode updated successfully', 'success');


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
