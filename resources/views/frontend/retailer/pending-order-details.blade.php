@extends('/frontend/retailer/layout.app')

@section('content')


<section class="py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
   
        <div class="row mb-3">
          <div class="col-12 col-sm-6 col-md-8">
            <h4>Retailer Details</h4>
            <address>
              <strong>{{ $order->rej_user }}</strong><br>
              Email: {{  $order->rej_email }}<br>
              Mobile: {{ $order->rej_mobile }}<br> 
            </address>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <h4 class="row">
              <span class="col-6">Invoice #</span>
              <span class="col-6 text-sm-end">{{ $order->order_code }}</span>
            </h4>
            <div class="row">
             
              <span class="col-6">Order Date</span>
              <span class="col-6 text-sm-end">{{ $order->order_date }}</span>
             
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                  <th scope="col" class="text-uppercase">#</th>  
                  <th scope="col" class="text-uppercase">Product</th>
                    <th scope="col" class="text-uppercase">SKU</th>
                    <th scope="col" class="text-uppercase">Qty</th>
                    <!-- <th scope="col" class="text-uppercase text-end">Unit Price</th> -->
                    <!-- <th scope="col" class="text-uppercase text-end">Amount</th> -->
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  
                @foreach ($items as  $index => $item)
                  <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{$item->name}}</td>
                    <td class="text-end">{{$item->sku}}</td>
                    <td class="text-end">{{$item->size}}</td>
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-12 text-end">
          <a href="{{ url('retailer-shop/pending-order-details/' . Crypt::encryptString($order->order_id)) }}" class="btn btn-primary mb-3">Back</a>
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection