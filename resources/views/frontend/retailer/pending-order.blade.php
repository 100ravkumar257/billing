@extends('/frontend/retailer/layout.app')

@section('content') 


<div class="container my-5 " >
    <div class="cart-container">
        <h4 class="mb-3 text-success fs-3">Pending Order</h4>

     
        <div class="table-responsive">
    @if(count($orders) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                <th class="text-center">#</th>    
                <th class="text-center">Order No</th>
                    <th class="text-center">Order Date</th>
                    <th class="text-center">Rejected  By</th>
                    <th class="text-center">Rejected Date</th>
                    <th class="text-center">View</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                @foreach ($orders as $index =>  $order)
                    <tr>
                        <td class="text-center"> {{ $index+1}}</td>
                        <td class="text-center">{{ $order->order_code}}  </td>
                        <td class="text-center">
                        {{ optional($order)->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td class="text-center">{{ $order->rej_user}}  </td>
                        <td class="text-center">
                        {{ optional($order)->rej_date ? \Carbon\Carbon::parse($order->rej_date)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td class="text-center">
                            <a class="text-decoration-none text-dark" href="{{ url('retailer-shop/pending-order-details/' . Crypt::encryptString($order->order_id)) }}">
                            <i class="bi bi-eye-fill fs-1"></i>
                            </a>
                        </td>
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    @else
        <div class="text-center p-4">
            <h4>Your Pending Order is empty </h4>
            <a href="{{ url('/retailer-shop') }}" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
    @endif
</div>


       
    </div>
</div>


@endsection