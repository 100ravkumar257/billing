<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container d-flex align-items-center">
        <!-- Logo (Left Side) -->
        <!-- <img src="{{ asset('frontend/retailer/images/png-file.png') }}" alt="Product" class="main-logo" height="50px"> -->
            <a href="{{ route('retailer.shop') }}" class="logo">
                <img src="{{ asset('frontend/retailer/images/png-file.png') }}" alt="Product" class="main-logo" height="50px">
            </a>
        <!-- Right Side Buttons -->


        <div class="d-flex align-items-center ms-auto">

        <a href="javascript:void(0);" class="btn btn-outline-light me-2 " id="newOrderBtn">New Order</a>


            @if(Auth::guard('salesperson')->check())
                <a class="btn btn-outline-light me-2 d-lg-none">{{ ucfirst(session('salesperson_name')) }}</a>
                <form action="{{ route('retailer.shop.logout') }}" method="POST" class="d-lg-none">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn">
                        <i class="fs-3 bi bi-box-arrow-right"></i>
                    </button>
                </form>
            @else
                <a class="btn btn-outline-light me-2 d-lg-none" href="{{ route('retailer.shop.login') }}">Login</a>
            @endif
           
            <div class="d-none d-lg-block">
                @if(Auth::guard('salesperson')->check())
                    <a class="btn btn-outline-light me-2">{{ ucfirst(session('salesperson_name')) }}</a>
                    <form action="{{ route('retailer.shop.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn">
                            <i class="fs-3 bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @else
                    <a class="btn btn-outline-light me-2" href="{{ route('retailer.shop.login') }}">Login</a>
                @endif
            </div>

            <a href="{{ route('retailer.pending.order') }}" class="btn btn d-none">
                <i class="bi bi-bag-x fs-3"></i>
            </a>

            <!-- <a href="{{ route('retailer.cart.details') }}" class="btn cart-btn">
                <i class="bi bi-cart"></i>
                <span class="badge bg-warning cartCount" id="cartCount1" ></span>
            </a> -->
        </div>
    </div>
</nav>

<div class="category-section py-0" style="background-color:#FF7518;">
    <div class="container">
        <!-- Desktop View: Categories in Row -->
        <div class="row d-none d-lg-flex justify-content-center">
            @if($categories->isEmpty())
                <div class="col-2 category-item">
                    <p>No active categories available.</p>
                </div>
            @else
           
                @foreach($categories as $category)
                    <div class="col-2 category-item">
                        <a href="{{ url('/retailer-shop/category/' . $category->slug) }}">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="product-img" height="50px">
                        </a>
                        <a class="text-decoration-none" href="{{ url('/retailer-shop/category/' . $category->slug) }}">
                            <p>{{ $category->name }}</p>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Mobile View: Slider -->
        <div id="categoryCarousel" class="carousel slide d-lg-none" data-bs-interval="false">
            <div class="carousel-inner px-0 ms-5 d-flex align-items-center justify-content-space-around">
                @foreach($categories->chunk(3) as $chunkIndex => $chunk)
                    <div class="carousel-item @if($chunkIndex === 0) active @endif">
                        <div class="row text-center ps-2">
                            @foreach($chunk as $category)
                                <div class="col-3 category-item">
                                    <a href="{{ url('/retailer-shop/category/' . $category->slug) }}" class="category-link">
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="product-img" height="50px">
                                    </a>
                                    <a class="text-decoration-none category-link" href="{{ url('/retailer-shop/category/' . $category->slug) }}">
                                        <p>{{ $category->name }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div> 
{{-- @if(request()->is('retailer-shop/category/*')) 
    <div class="category-section py-0" style="background-color:#FF7518;">
        <div class="container">
            <!-- Desktop View: Categories in Row -->
            <div class="row d-none d-lg-flex justify-content-center">
                @if($categories->isEmpty())
                    <div class="col-2 category-item">
                        <p>No active categories available.</p>
                    </div>
                @else
                    @foreach($categories as $category)
                        <div class="col-2 category-item">
                            <a href="{{ url('/retailer-shop/category/' . $category->slug) }}">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="product-img" height="50px">
                            </a>
                            <a class="text-decoration-none" href="{{ url('/retailer-shop/category/' . $category->slug) }}">
                                <p>{{ $category->name }}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Mobile View: Slider -->
            <div id="categoryCarousel" class="carousel slide d-lg-none" data-bs-interval="false">
                <div class="carousel-inner px-0 ms-5 d-flex align-items-center justify-content-space-around">
                    @foreach($categories->chunk(3) as $chunkIndex => $chunk)
                        <div class="carousel-item @if($chunkIndex === 0) active @endif">
                            <div class="row text-center ps-2">
                                @foreach($chunk as $category)
                                    <div class="col-3 category-item">
                                        <a href="{{ url('/retailer-shop/category/' . $category->slug) }}" class="category-link">
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="product-img" height="50px">
                                        </a>
                                        <a class="text-decoration-none category-link" href="{{ url('/retailer-shop/category/' . $category->slug) }}">
                                            <p>{{ $category->name }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endif --}}


<div id="products-section"></div>

<script src="{{ asset('js/auto-click.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#newOrderBtn").click(function () {
            $.ajax({
                url: "/clear-retailer-session",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function () {
                    window.location.href = "https://ordering.ezbizsoft.in/retailer";
                },
                error: function () {
                    alert("Something went wrong!");
                }
            });
        });
    });
</script>
