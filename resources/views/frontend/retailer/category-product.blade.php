@extends('/frontend/retailer/layout.app')

@section('content')


@if(!$products->isEmpty()) 
    <div class="container mt-0" style="">
        <div class="row g-3">
            <div class="col-12 col-md-12 col-lg-12">
                <h5 style="padding-top: 10px;">Create Order for - {{ ucfirst(session('retailer_name')) }}</h5>
            </div>   

            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="custom-product-card">
                        <div class="custom-product-img-container">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                        </div>

                        <h6 class="mt-2">{{ $product->name }}</h6>

                        <div class="custom-product-info pb-2">
                            @php
                                $sizes = $product->variants->pluck('size')->filter(); 
                            @endphp

                            @if($sizes->isNotEmpty())
                                <p>{{ $sizes->map(function($size) {
                                    return $size; 
                                })->implode(' / ') }}</p>
                            @else
                                <p><i style="color:#FF7518;"></i> Not Available</p>
                            @endif
                        </div>

                        <div class="custom-add-btn-container">
                            <button onclick="showVarients({{$product->id}})">ADD</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <!-- Display message if no products are found -->
    <div class="container" style="min-height: 100vh;">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark">Category - {{ $category_name }}</h5>
                        <h5 class="fw-bold text-dark">No products found in this category.</h5>
                        <p class="text-dark">It seems we don’t have any products in this category right now. You can go back to the shop and check other products.</p>
                        <a href="{{ route('retailer.shop') }}" class="btn btn-primary">Go Back to Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="view-cart-btn">
        <div class="cart-content">
            <!-- Left Section (View Cart & Items) -->
            <div class="cart-section">
                <span class="cart-title">View Cart</span>
                <a href="{{ route('retailer.cart.details') }}" class="">
                <span class="cart-subtext ps-4" id="cartCount"></span>
            </a>
            </div>
            <!-- Right Section (Total Weight & 100KG) -->
           
            <div class="cart-section text-end">
                <span class="cart-weight-title offcanvas-total">Total Weight</span>
                <span class="cart-weight" id="totalAmount"></span>
            </div>
        </div>
        <!-- Icon -->
        <a href="{{ route('retailer.cart.details') }}" class="btn btn-link" style="text-decoration: none; color: white; font-size: 24px;">
        <i class="bi bi-arrow-right-circle cart-icon"></i>
            </a>
        
        
    </div>
  
<script>
    let brandId = getCookie("brandId");

    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
        return null;
    }

    console.log(brandId); 
</script>
@include('frontend.retailer.common.homefooter')
@endsection

