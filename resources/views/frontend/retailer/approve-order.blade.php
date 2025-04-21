@extends('/frontend/retailer/layout.app')

@section('content')
<div class="container" style="min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                   
                    <p class="lead">{{ $message}}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.retailer.common.homefooter')
@endsection 
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pathname = window.location.pathname;

        if (/^\/retailer-shop\/(approve-order|reject-order)\/[\w-]+\/[\w-]+$/.test(pathname)) {
            document.querySelector('.category-section').classList.add('d-none');
        }
    });
</script>
