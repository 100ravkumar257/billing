@extends('/frontend/retailer/layout.app')

@section('content')


<section class="py-3 py-md-5">
  <div class="container" style="min-height: 100vh;">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
        <div class="row gy-3 mb-3 d-none">
          <div class="col-6">
            <h2 class="text-uppercase text-endx m-0">Invoice</h2>
          </div>
          <div class="col-6">
            <a class="d-block text-end" href="#!">
              <img src="./assets/img/bsb-logo.svg" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44">
            </a>
          </div>
          <div class="col-12">
            <h4>From</h4>
            <address>
              <strong>BootstrapBrain</strong><br>
              875 N Coast Hwybr<br>
              Laguna Beach, California, 92651<br>
              United States<br> 
              Phone: (949) 494-7695<br>
              Email: email@domain.com
            </address>
          </div>
        </div>
        <div class="row mb-3"> 
          <div class="col-12 col-sm-6 col-md-8">
            <h4>Retailer</h4>
            <address>
              <strong>{{ $retailer->name }}</strong><br> 
              Mobile: {{ $retailer->mobile }}<br>
              Email: {{  $retailer->email }}
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
                  <th scope="col" class="text-uppercase ">Pack Qty</th>
                    <th scope="col" class="text-uppercase">Qty</th>
                    <!-- <th scope="col" class="text-uppercase text-end">Unit Price</th> -->
                    <!-- <th scope="col" class="text-uppercase text-end">Amount</th> -->
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  
                @foreach ($items as  $index => $item)
                <?php
              // dd($items);
              ?>
                  <tr>
                    <th scope="row" class="text-center">{{ $index + 1 }}</th>
                    <td>{{$item->category_name}} {{$item->name}}-{{$item->size}}</td>
                    <td>{{$item->pcs_per_pack}}x{{$item->layers_per_pack}}</td>
                    <!-- category->name -->
                    <td class="text-center">{{$item->quantity}}</td>
                   
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <h5 class="text-end">
               Total Packing Weight: <span id="total-packing-weight">{{ session('total_packing_weight', 0) }}</span> kg
              </h5>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-end">
          <!-- <a href="{{ url('retailer-shop/approve-order/' . Crypt::encryptString($order->id) . '/' . Crypt::encryptString($retailer->id)) }}" class="btn btn-success mb-3">Approve</a>
         <a href="{{ url('retailer-shop/reject-order/' . Crypt::encryptString($order->id) . '/' . Crypt::encryptString($retailer->id)) }}" class="btn btn-danger mb-3" style="">Reject</a> -->
         <a href="{{ url('retailer-shop/approve-order/' . Crypt::encryptString($order->id) . '/' . Crypt::encryptString($retailer->id)) }}" class="btn btn-success mb-3" style="background-color: green; color: white;">Approve</a>
         <a href="{{ url('retailer-shop/reject-order/' . Crypt::encryptString($order->id) . '/' . Crypt::encryptString($retailer->id)) }}" class="btn btn-danger mb-3" style="background-color: red; color: white;">Reject</a>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('frontend.retailer.common.homefooter')
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pathname = window.location.pathname;
        if (/^\/retailer-shop\/retailer-order-approve\/\d+$/.test(pathname)) {
            document.querySelector('.category-section').classList.add('d-none');
        }
    });
</script>
