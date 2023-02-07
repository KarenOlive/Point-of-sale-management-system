@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped mb-0 table-bordered">
                        <thead>
                            <th>Cashier</th>
                            <th>CustomerOrder</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Amount Paid</th>
                            <th>Method</th>
                        </thead>
                        <tbody>

                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->name }}</td>
                                    <td>{{ $transaction->order_id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($transaction->updated_at)) }}</td>
                                    <td>{{ $transaction->totalamount }}</td>
                                    <td>{{$transaction->amount_paid}}</td>
                                    <td>{{ implode(" ", json_decode( $transaction->payment_method))  }}</td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
