@extends('/frontend/retailer/layout.app')

@section('content')

<div class="container mt-3">
    <div class="row g-3">
   
        @if(!$products)
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark">No product found</h5>
                        <p class="text-dark">
                            The product you are looking for is not available.
                            You can go back to the shop and check other products.
                        </p>
                        <a href="{{ route('retailer.shop') }}" class="btn btn-primary">Go Back to Shop</a>
                    </div>
                </div>
            </div>
        @else
             <div class="col-12">
                <h5 class="fw-bold" id="offcanvasBottomLabel" style="color:#FF7518;">Search Product - {{ $products->name }} </h5>
             </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="custom-product-card">
                    <div class="custom-product-img-container">
                        <!-- <img src="{{ asset('frontend/retailer/images/sk-main1.jpg') }}" alt="{{ $products->name }}"> -->
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img" style="width: 60px !important; margin: 0 auto; max-width: 50% !important;">
                    </div>

                    <h6 class="mt-2">{{ $products->name }}</h6>

                    <div class="custom-product-info">
                        <!-- @php
                            $sizes = $products->variants->pluck('size')->filter();
                        @endphp -->

                        <!-- @if($sizes->isNotEmpty())
                            <p><i class="fas fa-tint" style="color:#FF7518;"></i>
                            Volume: {{ $sizes->map(fn($size) => $size  )->implode(' / ') }}
                            </p>
                        @else
                            <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: Not Available</p>
                        @endif -->
                    </div>

                    <div class="custom-add-btn-container">
                        <button onclick="showVarients({{ $products->id }})">ADD</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
