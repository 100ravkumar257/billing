@extends('/frontend/retailer/layout.app')

@section('content')
<div class="container" style="min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="text-success"><i class="fas fa-check-circle"></i> Order submitted for approval.</h1>
                    <p class="lead">Your order ID is: <strong>{{ $order_id }}</strong></p>
                
                    <a href="javascript:void(0);" class="btn" style="background:#FF7518;" id="newOrderBtn1">Start New Order</a>

                    
                    <a href="{{ route('retailer.order.approve', ['id' => $order_id]) }}" class="btn btn-success mt-3 mt-md-0" style="background:#;">Approve Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#newOrderBtn1").click(function () {
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pathname = window.location.pathname;
        const searchParams = window.location.search;

        // Check if the URL matches either of the two patterns
        if (/^\/retailer-shop\/retailer-order-approve\/\d+$/.test(pathname) || /^\/retailer-shop\/order\/success\?order_id=\d+$/.test(pathname + searchParams)) {
            document.querySelector('.category-section').classList.add('d-none');
        }
    });
</script>


@include('frontend.retailer.common.homefooter')
@endsection
