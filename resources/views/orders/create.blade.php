<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TechMart - POS</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <style>
        a {
            /* color: #fff !important; */
            text-decoration: none !important;
        }

        a::after,
        a::before {
            color: #fff !important;
        }

        a.btn i:active,
        a.btn i::after {
            color: #fff !important;
        }

        .card-header {
            background-color: #343957 !important;
            color: #fff !important;
        }

        label i {

            font-weight: 700;
        }
        button[type=submit] {
            background-color: #5757d3;
            color: #eee;
        }
        button[type=submit]:hover {
            background-color: #000;
            color: #ddd;
        }
        .navbar{
            background-color: #343957f3;
            color: #eee;
        }
        .navbar-brand{
            color: #eee;
        }
        .navbar-brand:hover{
            color: #000;
        }
        .navbar ul li a{
            color: #eee;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand nav-link" href="/">{{ config('app.name', 'TechMart') }}</a>
          </div>
          <ul class="nav">
            <li class="active nav-item"><a href="/" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{route('product.index')}}" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Reports</a></li>
          </ul>
          <ul class="nav navbar-right">
            <li class="nav-item">
                @if (Auth::user()->name)
                <p><span class="fa fa-user mr-1"></span>{{ Auth::user()->name }}</p>

                @else
                    {{ route('login') }}
                @endif

            </li>

            {{-- <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
           </li> --}}
          </ul>
        </div>
      </nav>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-bold -mb-2 font-weight-bold card-title text-white">
                            ORDER PRODUCTS
                        </h3>
                    </div>

                    <form action="{{ route('order.store') }}" method="post">
                        @csrf
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount(%)</th>
                                        <th scope="col">Total</th>
                                        <th><a href="#" class="btn btn-sm btn-success add"><i
                                                    class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>

                                <tbody id="addMore" class="addMore">
                                    <!-- -- Future feature
                                                        this product information should be picked from scanning the product barcode  -->
                                    <tr>
                                        <td>1</td>
                                        <td>

                                            <select class="form-control-sm product_id" name="product_id[]" id="product_id">
                                                <option>Select Product</option>
                                                @foreach ($products as $product)
                                                    <option data-price="{{ $product->price }}" value="{{ $product->product_name }}">
                                                        {{ $product->product_name }}</option>
                                                @endforeach

                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="qty[]" id="qty" class="form-control qty" />
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" id="price" class="form-control price">
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount"
                                                class="form-control discount" value="0" />
                                        </td>
                                        <td>
                                            <input type="number" name="total_amount[]" id="totalamount"
                                                class="form-control totalamount">
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger delete disabled"><i
                                                    class="fa fa-times"></i></a>

                                        </td>
                                    </tr>
                                </tbody>
                                <input type="text" name="theTotal" id="theTotal" hidden>

                                <input type="text" name="user" id="user" value="{{ Auth::user()->name }}" hidden>

                                <input type="hidden" name="orderid" value="">

                                {{-- <button type="submit" class="btn mb-2">Save</button> --}}
                            </table>
                        </div>

                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="font-weight-bold">Total <b class="total" id="total">0.00</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            {{-- <button type="button" class="btn btn-secondary">Print <i class=" fa fa-print"></i></button> --}}
                            <a href="{{ route('order.receipt', $last->id) }}" type="button" class="btn btn-dark">Receipt <i class="fa fa-print"></i></a>
                            <button type="button" class="btn btn-secondary" id="modal_view_right" data-toggle="modal" data-target="#orderhistory_modal">History <i class=" fa fa-history"></i></button>
                            <button type="button" class="btn btn-secondary">Report <i class=" fa fa-line-chart"></i></button>
                        </div>

                        <div class="panel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_name" class="font-weight-bold">Customer</label>
                                        <input type="text" name="customer_name" id="customer_name" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="notes" class="font-weight-bold">Notes</label>
                                        <input type="text" name="notes" id="" class="form-control">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="panel">
                            <h5 class=" font-weight-bold">Payment Method</h5>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="cash"
                                            checked="checked" value="Cash" name="payment_method[]">
                                        <label class="custom-control-label" for="cash"> <i
                                                class="fa fa-money text-success"></i> Cash</label>
                                    </div>
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="mobileMoney"
                                            value="Mobile money" name="payment_method[]">
                                        <label class="custom-control-label" for="mobileMoney"> <i
                                                class="fa fa-mobile-phone text-red"></i> Mobile money</label>
                                    </div>
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="creditCard"
                                            value="Credit Card" name="payment_method[]">
                                        <label class="custom-control-label" for="creditCard"> <i
                                                class="fa fa-credit-card text-indigo-600"></i> Credit Card</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">


                                    <div class="form-group">
                                        <label for="payment" class="font-weight-bold">Payment</label>
                                        <input type="text" name="payment" id="paid_amount" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="change" class="font-weight-bold">Change</label>
                                        <input type="text" name="change" id="change" class="form-control"
                                            readonly>
                                    </div>
                                    <hr>

                                    <button type="submit" class="btn btn-block mt-2">Save</button>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <!-- Modals -->

        <div class="modal modal_outer right_modal fade" id="orderhistory_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
              </div>

              <div class="modal-footer"></div>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('/js/select2.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>


        //adding a row
        $('.add').on('click', function() {

            var product = $('.product_id').html();
            var noOfRows = ($('#addMore tr').length - 0) + 1;

            var tr = '<tr>' +
                '<td class="no">' + noOfRows + '</td>' +
                '<td><select class="form-control-sm product_id" name="product_id[]" >' + product + ' </td> </select>' +
                '<td><input type="text" name="qty[]" class="form-control qty" /></td>' +
                '<td><input type="text" name="price[]" class="form-control price" /></td>' +
                '<td><input type="text" name="discount[]" class="form-control discount" value="0" /></td>' +
                '<td><input type="text" name="total_amount[]" class="form-control totalamount" /></td>' +
                '<td><a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i></a></td>' +
                '</tr>'

            $('#addMore').append(tr);
        })


        function totalAmount() {
            var sum = 0;

            $('.totalamount').each(function() {
                var amount = $(this).val() - 0;
                sum += amount;

            })

            $('.total').html(sum);

            //populating the value of the hidden input field
            var total = $('.total').html();
            $('#theTotal').val(total);
        }

        //deleting a row
        $('#addMore').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
            totalAmount();
        })


        $('#addMore').delegate('.product_id', 'change', function() {
            var tr = $(this).parent().parent();
            var p = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(p);

            var quantity = tr.find('.qty').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;

            var total_amount = (quantity * price) - ((quantity * price * discount) / 100);
            tr.find('.totalamount').val(total_amount);

            totalAmount();

        })

        $('#addMore').delegate('.qty, .discount', 'keyup', function() {
            var tr = $(this).parent().parent();

            var qty = tr.find('.qty').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;

            var total_amount = (qty * price) - ((qty * price * discount) / 100);
            tr.find('.totalamount').val(total_amount);

            totalAmount();
        })


        $('#paid_amount').on('keyup', function() {
            // alternative.... var payment = $(this).val()
            var payment = $('#paid_amount').val() - 0;
            var total = $('.total').html();
            var change = (payment - total);


            if (payment == total || payment < total) {

                $('#change').val(0);


            } else {

                $('#change').val(change);
            }
        })



        $("#cash").attr("checked") ? $('#customer_name').val('Cash customer') : $('#customer_name').val('');

        $('#cash').click(function() {
            $("#customer_name").toggle(this.checked).val('Cash customer');
        });
        $('#mobileMoney').click(function() {
            $("#customer_name").toggle(this.checked).val('MobileMoney customer');

        });
        $('#creditCard').click(function() {
            $("#customer_name").toggle(this.checked).val('CreditCard customer');

        });
    </script>
</body>
</html>








