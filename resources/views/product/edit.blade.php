@extends('layouts.layout');
@section('content')
@foreach ($product as $p)

<div class="container">
    <form action="{{ route('product.update', $p->id) }}" method="POST" enctype="multipart/form-data">
        @endforeach
        @csrf
        @method('PATCH')
        <div class="modal-body">

            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <label class="focus-label">Product Name</label>
                        <input type="text" class="form-control floating" name="productname">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <label class="focus-label">Brand Name</label>
                        <input type="text" class="form-control floating" name="brand">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <label class="focus-label">Category</label>
                        <select class="select floating" name="category">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }} -
                                    {{ $category->id }}</option>
                            @endforeach


                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <label class="focus-label">Price</label>
                        <input type="text" class="form-control floating" name="price">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <label class="focus-label">Metric units</label>
                        <input type="text" class="form-control floating" name="metricunits">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <label class="focus-label">Alert Stock</label>
                        <input type="text" class="form-control floating" name="alertstock">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary bg-violet-500 text-white"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark">Update Product</button>


        </div>
    </form>
</div>


@endsection
