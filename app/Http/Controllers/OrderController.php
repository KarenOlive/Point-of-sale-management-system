<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdateOrderRequest;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();

        return view('orders.index', compact('products', 'orders'));

        // Last Order History
        // $products = Product::all();
        // $o = Order::all()->where('id', $order_id);

        // return view ('orders.show', [
        //     'products' => $products,
        //     'customer_orders' => $o
        // ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $orders = Order::all();



        $last = DB::table('orders')->orderBy('id', 'DESC')->first();
      //  dd($last);

        return view('orders.create', compact('products', 'orders', 'last'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {


        //Order Model

           

        DB::transaction(function () use ($request) {


            $order = Order::create([
                'name' => json_encode($request->customer_name),
                'products' => json_encode($request->product_id),
                'quantity' => json_encode($request->qty),
                'unitprice' => json_encode($request->price) ,
                'total_cost' => json_encode($request->total_amount),
                'discount' => json_encode($request->discount),
                'p_id' => intval($request->pid),
            ]);

            $order_id = $order->id;

            if (!$order) {
                throw new \Exception('Order not created.');
            }

            //  //Transaction model
            if (!$order_id) {
                throw new \Exception('Order_id not found.');
            }


            $pay = $request->payment_method;
            $paymentmethod = json_encode($pay);

            $transactions = Transaction::create([

                'order_id' => $order_id,
                'totalamount' => $request->theTotal,
                'amount_paid' => $request->payment,
                'change' => $request->change,
                'payment_method' => $paymentmethod,
                'user_id' => Auth::user()->id,
            ]);




            if (!$transactions) {
                throw new \Exception('Transaction failed.');
            }

            // //Payments model

            // $transaction_id = $transactions->id;

            // if (!$transaction_id) {
            //     throw new \Exception('Transaction_id not found.');
            // }

            // $payments = Payment::create([
            //     'transaction_id' => $transaction_id,
            // ]);

            // if (!$payments) {
            //     throw new \Exception('Payment not created.');
            // }



        });

        Alert::toast('Order added successfully', 'success');
        return redirect('/order');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order = Order::findOrFail($order->id);
        $order->delete();

        return redirect('/order');
    }
}
