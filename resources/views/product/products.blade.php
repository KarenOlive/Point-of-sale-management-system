@extends('layouts.layout');

@section('styles')
    <style>
        button[type=button] {
            background-color: #000;
        }

        button[type=submit] {
            background-color: #5757d3;
        }
    </style>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" rel="stylesheet"> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Product</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="" class="btn btn-dark float-right btn-rounded text-white" data-toggle="modal"
                data-target="#exampleModal"><i class="fa fa-plus"></i> Add Product</a>
        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table table-striped mb-0 table-bordered">
                    <thead>
                        <tr>
                            <th>ProductName</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Metric_units</th>
                            <th>AlertStock</th>
                            <th>Barcode</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                            <tr>

                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td> {{ $product->metric_units }}</td>
                                <td>{{ $product->alert_stock }}</td>
                                <td>
                                    {!! $product->barcode !!}
                                </td>

                                @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item edit" value="{{ $product->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</button>


                                            <form action="/delete/{{$product->id}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item btn btn-danger "
                                                    value="{{ $product->id }}" type="submit">
                                                    <i class="fa fa-trash-o m-r-5"></i>Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <!-- Add Product modal  -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Create Product</h4>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Product Name</label>
                                    <input type="text" class="form-control floating" name="productname">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Brand Name</label>
                                    <input type="text" class="form-control floating" name="brand">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-focus select-focus">
                                    <label class="focus-label">Category</label>
                                    <select class="select floating" name="category">
                                        <option>Select Category</option>
                                        @foreach ($c as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }} -
                                                {{ $category->id }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Price</label>
                                    <input type="text" class="form-control floating" name="price">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Metric units</label>
                                    <input type="text" class="form-control floating" name="metricunits">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Alert Stock</label>
                                    <input type="text" class="form-control floating" name="alertstock">
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bg-violet-500 text-white"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!-- Edit Product modal -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Create Product</h4>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>



                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="text" name="productid" id="productid" hidden>
                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="label">Product Name</label>
                                    <input type="text" class="form-control" id="productname" name="productname">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="focus-label">Brand Name</label>
                                    <input type="text" class="form-control" id="brand" name="brand">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group select-focus">
                                    <label class="focus-label">Category</label>
                                    <select class="select" id="category" name="category">
                                        <option>Select Category</option>
                                        @foreach ($c as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }} -
                                                {{ $category->id }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                               <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="focus-label">Price</label>
                                    <input type="text" class="form-control" id="price" name="price">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="focus-label">Metric units</label>
                                    <input type="text" class="form-control" id="metricunits" name="metricunits">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="focus-label">Alert Stock</label>
                                    <input type="text" class="form-control" id="alertstock" name="alertstock">
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
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.edit', function() {

                var productid = $(this).val();
                console.log(productid);

                $('#editModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: '/product/' + productid + '/edit',
                    success: function(response) {
                        console.log(response);
                        $('#productname').val(response.product.product_name);
                        $('#price').val(response.product.price);
                        $('#metricunits').val(response.product.metric_units);
                        $('#brand').val(response.product.brand);
                        $('#alertstock').val(response.product.alert_stock);
                        $('#category').val(response.product.category_id);
                        $('#productid').val(productid);

                    }

                })
            });

            $('.deleteBtn').on('click', function(e) {
                e.preventDefault();

                var id = $(this).val();
                console.log(id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: 'delete/' + id,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Operation Successful',
                                    icon: 'success'
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                            // axios.delete('/delete/' + id).then(() => {
                            //     Swal.fire({
                            //         title: 'Operation Successful',
                            //         icon: 'success'
                            //     });
                            // });






                        });

                    }
                    //else {
                    //     Swal.fire({
                    //         title: 'Operation Cancelled!',
                    //         icon: 'info'
                    //     });
                    // }
                })
            });






        });
        // Sweet alert modelfor delete confirmation
    </script>
@endsection
