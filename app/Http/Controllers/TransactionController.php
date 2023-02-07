<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Seller;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use Milon\Barcode\QRcode;
use Nette\Utils\ArrayList;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->join('orders', 'orders.id', '=', 'transactions.order_id')
            ->select('transactions.*', 'users.name' )
            ->get();
           // $d = date('d-m-Y', strtotime($transactions[0]->updated_at));
           // dd($transactions, $d);
            return view('admin.transactions.index', compact('transactions'));
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function createReceipt($orderid)
    {

        // QrCode::sizeof(300)->generate($orderid);


        $data = DB::table('orders')
        ->join('products','products.pid','orders.p_id')
        ->select('products.price', 'orders.*')
        ->where('orders.id',$orderid)
        ->first();


        $d = DB::table('transactions')
        ->join('orders','orders.id','transactions.order_id')
        ->join('users','users.id','transactions.user_id')
        ->select('users.name','transactions.*')
        ->where('orders.id',$orderid)
        ->first();


        $products = json_decode($data->products); //array
        $qtys = json_decode($data->quantity);
        $prices = json_decode($data->unitprice);
        $discounts = json_decode($data->discount);


        $total_cost = json_decode($data->total_cost);
        $paymentmethod = json_decode($d->payment_method); //array
        $pm = implode("", $paymentmethod);
        $total = $d->totalamount;
        $transactionid = $d->id;

        $customer = new Buyer([
            'name' => $data->name,
            'code' => $transactionid,
            'custom_fields' => [
                'Order number' => $orderid,
                'Payment type' => $pm
            ],
        ]);


        // $itemms = array();
        //  array_push($itemms, ["product"=>$products, "qty"=> $qtys, "price"=> $prices, "discount"=> $discounts]  );
        //dd($items[0]);

        // $keys = array_keys($items[0]);

        // for($i = 0; $i < count($items[0]); $i++){
        //     foreach ($items[0][$keys[$i]] as $key => $value) {
        //         foreach($products as $product){
        //         echo  $product;
        //         }
        //         //         ->pricePerUnit(floatval([1][$value]))
        //         //         ->quantity(floatval($value))
        //         //         ->discountByPercent(floatval($value))];
        //     }
        //      //dd($item);
        // }

        // foreach ($items as $item) {
        //     foreach ($item as $key => $value) {
        //     //    echo "$key  $value <br>";

        //        return $item = (new InvoiceItem())
        //         ->title($value)
        //         ->pricePerUnit($value)
        //         ->quantity($value)
        //         ->discountByPercent($value);
        //     }
        //     // echo '<br>';
        // }

   for ($i=0; $i < count($products); $i++) {
        $items = [
            (new InvoiceItem())

            ->title($products[0])
            ->pricePerUnit($prices[0])
            ->quantity($qtys[0])
            ->discountByPercent($discounts[0]),





        ];

   }








        $notes = [
            "You were served by: {$d->name}",
            'Please come Again',
            'Prices inclusive of VAT were applicable',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make()->template('orderReceipt')
                ->logo(public_path('favicon.ico'))
                ->buyer($customer)
                ->date(now())
                ->dateFormat('m/d/Y')
                ->series('RC')
                ->sequencePadding(3)
                ->sequence(10)
                ->delimiter('.')
                ->serialNumberFormat('{SERIES}{DELIMITER}{SEQUENCE}')
                ->name('Receipt')
                ->taxRate(15)
                ->currencySymbol('UGX')
                ->currencyCode('shillings')
                ->currencyThousandsSeparator(',')
                ->addItems($items)
                ->notes($notes)
                ->save('public');

                $link = $invoice->url();

                return $invoice->stream();




     }

}
