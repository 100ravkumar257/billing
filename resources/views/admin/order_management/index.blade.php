@extends('admin.layouts.master')

@section('page_title')
    {{ __('Order Management') }}
@endsection

@push('css')
    <style>
        .table tr td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class=" ">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{ __('Order Management') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active-breadcrumb">
                            <a href="{{ route('Order_Management.index') }}">{{ __('Order Management') }}</a>
                        </li>
                    </ul>
                </div>
                {{-- @if (Gate::check('order-create'))
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <a href="{{ route('Order_Managements.create') }}" class="btn custom-create-btn">{{ __('Add Order') }}</a>
                        </div>                 
                    </div>
                @endif --}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Retailer') }}</th>
                                <th>{{ __('Order Code') }}</th>
                                <th>{{ __('Order Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('Order_Management.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'retailer_name', name: 'retailer_name' },
                    { data: 'order_code', name: 'order_code' },
                    { data: 'order_date', name: 'order_date' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
