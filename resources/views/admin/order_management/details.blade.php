@extends('admin.layouts.master')

@section('page_title')
    {{ __('Order Details') }}
@endsection

@push('css')
    <style>
        .table tr td {
            vertical-align: middle;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printableInvoice, #printableInvoice * {
                visibility: visible;
            }

            #printableInvoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
                font-family: 'Courier New', Courier, monospace;
                font-size: 14px;
            }

            .invoice-table th, .invoice-table td {
                border: 1px solid #000;
                padding: 4px;
            }

            .no-border {
                border: none !important;
            }

            .text-right {
                text-align: right;
            }

            .text-center {
                text-align: center;
            }
        }

        #printableInvoice {
            display: none;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class=" ">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{ __('Order Details') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active-breadcrumb"><a href="{{ route('Order_Management.index') }}">{{ __('Order Management') }}</a></li>
                        <li class="breadcrumb-item active-breadcrumb">{{ __('Order Details') }}</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="create-btn pull-right">
                        <a href="{{ route('Order_Management.index') }}" class="btn custom-create-btn">{{ __('Back to Order List') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Order Detail -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="#" onclick="printInvoice()" class="btn btn-primary mb-3 ">
                            <i class="fa fa-print"></i> {{ __('Print Invoice') }}
                        </a>
                    </div>

                    <h4><strong>{{ __('Order Code:') }}</strong> {{ $order->order_code }}</h4>
                    <h5><strong>{{ __('Retailer:') }}</strong> {{ $order->retailer_id }}</h5>
                    <h5><strong>{{ __('Order Date:') }}</strong> {{ $order->order_date->format('jS M Y') }}</h5>
                    <h5><strong>{{ __('Status:') }}</strong> {{ $order->status ? 'Checked' : 'Pending' }}</h5>

                    <h4 class="mt-4">{{ __('Order Details') }}</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Indate</th>
                                <th>Confirm Date</th>
                               {{-- <th>Status</th>  --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->product ? $detail->product->name : 'N/A' }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->indate ? $detail->indate->format('jS M Y') : 'N/A' }}</td>
                                    <td>{{ $detail->confirm_date ? $detail->confirm_date->format('jS M Y') : 'N/A' }}</td>
                                    {{--<td>
                                        @switch($detail->status)
                                            @case(1) {{ 'Confirmed' }} @break
                                            @case(2) {{ 'Rejected' }} @break
                                            @case(3) {{ 'Ready for dispatch' }} @break
                                            @case(4) {{ 'Shipped' }} @break
                                            @case(5) {{ 'Delivered' }} @break
                                            @case(6) {{ 'Returned' }} @break
                                            @case(7) {{ 'Disputed' }} @break
                                            @case(8) {{ 'Cancelled' }} @break
                                            @default {{ 'Pending' }}
                                        @endswitch
                                    </td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Printable Invoice Styled Like Medicine Bill -->
                    <div id="printableInvoice">
                        <div class="text-center mb-2">
                            <h4 style="margin-bottom: 0;">XYZ Medical Store</h4>
                            <small>123 Main Street, City, Country<br>Phone: +123-456-7890</small>
                            <hr>
                        </div>

                        <div class="mb-2">
                            <p><strong>Invoice #:</strong> {{ $order->order_code }}</p>
                            <p><strong>Retailer:</strong> {{ $order->retailer_id }}</p>
                            <p><strong>Date:</strong> {{ $order->order_date->format('d-m-Y') }}</p>
                        </div>

                        <table width="100%" class="invoice-table" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderDetails as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->product ? $detail->product->name : 'N/A' }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>
                                            @switch($detail->status)
                                                @case(1) {{ 'Confirmed' }} @break
                                                @case(2) {{ 'Rejected' }} @break
                                                @case(3) {{ 'Ready' }} @break
                                                @case(4) {{ 'Shipped' }} @break
                                                @case(5) {{ 'Delivered' }} @break
                                                @case(6) {{ 'Returned' }} @break
                                                @case(7) {{ 'Disputed' }} @break
                                                @case(8) {{ 'Cancelled' }} @break
                                                @default {{ 'Pending' }}
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p class="text-center mt-4">Thank you for your order!</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function printInvoice() {
        var printContents = document.getElementById('printableInvoice').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endpush
