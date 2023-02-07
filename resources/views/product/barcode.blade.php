@extends('layouts.layout')

@section('content')
<form method="POST" action="{{ route('barcode.store')}}">
    @csrf
    <div class="mb-3">
      <label for="productcode" class="form-label">Product Code</label>
      <select class="form-select" name="product">
        <option>Open this select menu</option>
        @foreach ($products as $product)
        <option value="{{$product->id}}"> {{$product->id}} - {{ $product->product_name }}</option>
        @endforeach

      </select>
    </div>
    <button type="submit" class="btn btn-dark">Submit</button>


</form>
<br>
<br>
  <div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Product Barcodes</h4>
                    </div>
                    <div class="card-body bg-gray-100">
                        <div id="print">
                            <div class="row">
                                @foreach ($barcodes as $barcode)
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body text-center w-100">
                                            {{-- <img src="{{ asset('products/barcodes/'. $barcode->barcode) }}" alt="barcode" > --}}
                                            {!! $barcode->barcode !!}
                                            <h4 class="text-center" style=" margin-top: 1em;">{{$barcode->product_id}}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


@endsection
