<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $invoice->name }}</title>
    <style>
        body {

            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
        }

        .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

        .padding {

            padding: 2rem !important;
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2;
        }

        h3 {
            font-size: 20px;
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium';
        }

        .text-dark {
            color: #3d405c !important;
        }
        .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            .cool-gray {
                color: #6B7280;
            }
            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: collapse;
            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
            }

            .table.table-items td {
                border-top: 1px solid #3e3f40;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .mt-5 {
                margin-top: 3rem !important;
            }

            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }
            * {
                font-family: "DejaVu Sans";
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
    </style>

</head>

<body>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <center>
                    @if($invoice->logo)
                    <img src="{{ $invoice->getLogo() }}" alt="logo" height="50">
                @endif
                <div>
                    <h5 class="mb-0"> Receipt <strong>{{ $invoice->getSerialNumber() }}</strong></h5>
                    Date: <strong>{{ $invoice->getDate() }}</strong>
                </div>
                </center>

            </div>
            <div class="card-body">
                <center class="">
                    @if($invoice->seller->name)
                    <h3 class="mb-3">
                       <strong>{{ $invoice->seller->name }}</strong>

                    </h3>
                   @endif

                   <div>
                    @if($invoice->seller->address)
                    <p class="seller-address">
                        {{ __('invoices::invoice.address') }}: {{ $invoice->seller->address }}
                    </p>
                    @endif
                   </div>

                   <div>
                    @foreach($invoice->seller->custom_fields as $key => $value)
                    <p class="seller-custom-field">
                        {{ ucfirst($key) }}: {{ $value }}
                    </p>
                    @endforeach
                   </div>
                   <div>
                    @if($invoice->seller->phone)
                    <p class="seller-phone">
                        {{ __('invoices::invoice.phone') }}: {{ $invoice->seller->phone }}
                    </p>
                @endif
                   </div>
                </center>
                <div class="text-center">
                    @foreach($invoice->buyer->custom_fields as $key => $value)
                    <p class="buyer-custom-field">
                        {{ ucfirst($key) }}: {{ $value }}
                    </p>
                @endforeach
                </div>
                <div>
                    ************************************************************************************************************
                    </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                {{-- <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th> --}}

                                <th scope="col" class="border-0 pl-0">Product</th>

                                <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                                <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                                @if($invoice->hasItemDiscount)
                                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                                @endif
                                @if($invoice->hasItemTax)
                                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                                @endif
                                <th scope="col" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($invoice->items as $item)
                            <tr>
                                <td class="left strong pl-0">
                                    {{ $item->title }}


                                </td>

                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">
                                    {{ $invoice->formatCurrency($item->price_per_unit) }}
                                </td>
                                @if($invoice->hasItemDiscount)
                                    <td class="center text-right">
                                        {{ $invoice->formatCurrency($item->discount) }}
                                    </td>
                                @endif
                                @if($invoice->hasItemTax)
                                    <td class="text-right">
                                        {{ $invoice->formatCurrency($item->tax) }}
                                    </td>
                                @endif

                                <td class="text-right pr-0">
                                    {{ $invoice->formatCurrency($item->sub_total_price) }}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>


                            {{-- Summary --}}
                            @if($invoice->hasItemOrInvoiceDiscount())
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="left border-0"></td>
                                    <td class=" text-right pl-0"><strong class="text-dark">{{ __('invoices::invoice.total_discount') }}</strong></td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->total_discount) }}
                                    </td>
                                </tr>
                            @endif
                            @if($invoice->taxable_amount)
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0"><strong class="text-dark">{{ __('invoices::invoice.taxable_amount') }}<strong class="text-dark"></td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                                    </td>
                                </tr>
                            @endif
                            @if($invoice->tax_rate)
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0"<strong class="text-dark">{{ __('invoices::invoice.tax_rate') }}</strong></td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->tax_rate }}%
                                    </td>
                                </tr>
                            @endif
                            @if($invoice->hasItemOrInvoiceTax())
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class=" text-left border-0"></td>
                                    <td class="text-right pl-0"><strong class="text-dark">{{ __('invoices::invoice.total_taxes') }}</strong></td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->total_taxes) }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                <td class="text-right pl-0">{{ __('invoices::invoice.total_amount') }}</td>
                                <td class="text-right pr-0 total-amount">
                                    {{ $invoice->formatCurrency($invoice->total_amount) }}
                                </td>
                            </tr>



                             <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($invoice->seller->name.' '.$invoice->url(), 'QRCODE') }}" alt="qrcode">

                           </tbody>
                        </table>
                    </div>
                </div>
                @if($invoice->notes)
                <p>
                     {!! $invoice->notes !!}
                </p>
                @endif

                <p>
                    {{ trans('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }}
                </p>

            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">POS powered by TechMart</p>
            </div>
        </div>
    </div>
</body>
<script type="text/php">
    if (isset($pdf) && $PAGE_COUNT > 1) {
        $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
        $size = 10;
        $font = $fontMetrics->getFont("Verdana");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = ($pdf->get_width() - $width);
        $y = $pdf->get_height() - 35;
        $pdf->page_text($x, $y, $text, $font, $size);
    }
</script>
</html>















