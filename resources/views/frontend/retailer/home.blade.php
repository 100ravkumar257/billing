@extends('/frontend/retailer/layout.app')

@section('content')
<!-- Mobile Search Bar -->

    <!-- <div class="container mt-0  search-container" style="background-color:#ff7518; border:none;"> -->
            <!-- <div class="search-box position-relative">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search for products..." style="border:0.5px solid black;" >
                <i class="bi bi-search search-icon"></i>
                <div id="search-results" class="list-group position-absolute w-100 " style=""></div>
            </div> -->
            <!-- <div class="middle-info d-none d-lg-block">
                <i class="bi bi-lightning-charge-fill"></i> 10-minute delivery | 100% original items
            </div> -->
        <!-- </div> -->
 
<!-- Category Section (Immediately Below Navbar) -->


<!-- Mobile View: Slider -->

      
   
    <!-- free delivery section -->
     <!-- Free Delivery Section -->
<!-- <section class="free-delivery-section text-center" >
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8">
                <div class="delivery-content">
                    <i class="fas fa-truck-moving fa-bounce"></i>
                    <h2>Free Delivery on Your First Order!</h2>
                    <p>Enjoy fast & free delivery on your first purchase.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

  
<!-- @if($products->count() > 0)
    <div class="default-category-products">
        <h3>{{ $categories->first()->name }} Products</h3>
        <div class="row">
            @foreach($products as $product)
                <div class="col-4">
                    <div class="product-item">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img" height="200px">
                        <p>{{ $product->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif -->
</div>
<!-- main section offcanvas  -->
<!-- Offcanvas Trigger (Images) -->
<!-- <div class="container-fluid bg-light">
<div class="container text-center mt-3 bg-light durgesh">
    <div class="row">
        <h5 class="fw-bold text-start ps-4" style="font-size: 1.17rem; color:green;">Bestsellers..</h5>
        <div class="col-4 pe-4">
            <img src="{{ asset('frontend/retailer/images/Picture8.png') }}" class="img-thumbnail offcanvas-trigger " data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" />
           
            <p class=" fw-bold " style="color:#FF7518;"> Stainer</p>
        </div>
        <div class="col-4 ">
            <img src="{{ asset('frontend/retailer/images/Picture1.png') }}" class="img-thumbnail offcanvas-trigger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" />
            <p class=" fw-bold " style="color:#FF7518;">Europha</p>
        </div>
        <div class="col-4 " >
            <img src="{{ asset('frontend/retailer/images/Picture2.png') }}" class="img-thumbnail offcanvas-trigger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" />
            <p class=" fw-bold " style="color:#FF7518;">Primer</p>
        </div>
        </div>
        <div class="row py-2">
        <div class="col-4 d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('frontend/retailer/images/Picture3.png') }}" class="img-thumbnail offcanvas-trigger me-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" />
            <p class=" fw-bold  " style="color:#FF7518;">Primo Coat</p>
        </div>
        <div class="col-4">
            <img src="{{ asset('frontend/retailer/images/Picture5.png') }}" class="img-thumbnail offcanvas-trigger " data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" />
            <p class=" fw-bold  "style="color:#FF7518;">Charm Gold</p>
        </div>
        <div class="col-4">
            <img src="{{ asset('frontend/retailer/images/Picture4.png') }}" class="img-thumbnail offcanvas-trigger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" />
            <p class=" fw-bold " style="color:#FF7518;">Magna</p>
        </div>
    </div>
    </div>
</div> -->
<!-- </div> -->

<!-- Offcanvas -->

<div class="offcanvas offcanvas-bottom custom-offcanvas" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <!-- Close Button (Outside Offcanvas) -->
    <button type="button" class="btn-close custom-close-btn btn bg-success btn-light " data-bs-dismiss="offcanvas" aria-label="Close"></button>

    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="offcanvasBottomLabel" style="color:#FF7518;">Sakarni BestSellers..</h5>
    </div>

    <div class="offcanvas-body">
        <div class="d-flex">
           
            
            <!-- Main Section - Products -->
            <div class="col-12 right-section" >
                <div class="product-container" id="milk">
                    <div class="row d-flex justify-content-around">
                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture8.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">Stainer</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm" onclick="toggleCartItem(this)">ADD</button>
                            <!-- <button class="add-btn text-center btn btn-success" onclick="toggleCartItem(this)">ADD</button> -->
                        </div>
                        
                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture1.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">Europha</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                        </div>
                     

                    </div>
                    <div class="row d-flex justify-content-around">
                       


                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture2.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">primer</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                            
                        </div>
                     


                          
                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture3.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">primer Coat</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                            
                        </div>
                     



                  </div>
                        <div class="row d-flex justify-content-around">
                         
                                  
                                       
                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture5.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">Charm Gold</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                            
                        </div>
                     


                          

                                             
                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture6.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">Emulsion paint</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                            
                        </div>
                     


                    </div>


                    <div class="row d-flex justify-content-around ">
                       

                                               
                        <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture3.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">sakarni Mahaglow</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                            
                        </div>

                      <div class="col-5 product-card">
                            <img src="{{ asset('frontend/retailer/images/Picture3.png') }}" class="img-fluid" alt="Milk">
                            <h6 class="product-name mt-2">sakarni Mahaglow</h6>
                            <div class="custom-product-info">
                                <p><i class="fas fa-tint" style="color:#FF7518;"></i> Volume: 50L / 100L / 200L</p>
                                </div>
                                <div class="custom-star-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <p class="custom-price">₹xyz</p>
                            <button class="btn btn-success btn-sm"  onclick="toggleCartItem(this)">ADD</button>
                            
                        </div>
                        
                       
                </div>
               </div>
          

              
            </div>
        </div>
    </div>
</div>


 

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

<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        const firstCategoryItem = document.querySelector('.carousel-item.active .category-item');
    
        if (firstCategoryItem) {
            firstCategoryItem.querySelector('a').click();
        }
    }, 500); 
}); -->

<!-- </script> -->
@endsection