@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-md-12 d-flex flex-wrap justify-content-between">
        @foreach ($orders as $order)
        <div class="card mr-2" style="width: 18rem;">
            <div class="card-header">
                <h5 class="card-title">{{ $order->id }}</h5>

            </div>
            <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted">{{ $order->name }}</h5>
                <h5 class="card-text font-weight-bold">Products</h5>
                @foreach (json_decode( $order->products) as $product)
                <p class="card-text">{{ $product }}</p>
                @endforeach
                <h5 class="card-text font-weight-bold">Quantity</h5>

                @foreach ( json_decode($order->quantity) as $quantity)
                <p class="card-text">{{ $quantity }}</p>
                @endforeach
                <h5 class="card-text font-weight-bold">Unit Price</h5>

                @foreach (json_decode( $order->unitprice) as $unitprice)
                <p class="card-text">{{ $unitprice }}</p>
                @endforeach
                <h5 class="card-text font-weight-bold">Discount</h5>

                @foreach (json_decode( $order->discount) as $discount)
                <p class="card-text">{{ $discount }}</p>
                @endforeach
                <h5 class="card-text font-weight-bold">Total</h5>

                @foreach (json_decode( $order->total_cost) as $total)
                <p class="card-text">{{ $total }}</p>
                @endforeach

                {{
                    $t = array_sum(json_decode($order->total_cost))
                }}


                <div class="mt-4">
                    {!! QrCode::size(50)->generate($order->id ." Total: ".$t ) !!}
                </div>
            </div>
            <div class="card-footer">
                <a class=" card-link" href="{{ route('order.receipt', $order->id) }}"><i class="fa fa-print m-r-5"></i>Print</a>

            </div>
          </div>
        @endforeach

    </div>
</div>
@endsection

