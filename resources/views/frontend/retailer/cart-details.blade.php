@extends('/frontend/retailer/layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <h5 style="padding-top: 10px;">Create Order for - {{ ucfirst(session('retailer_name')) }}</h5>
            </div>
        </div>
    </div>
    <div class="container py-2" style="min-height: 100vh;">

        <div class="cart-container">
            <h4 class="mb-3 text-success fs-3">View Order</h4>

            <div class="table-responsive">
                @if(count($cartDetails) > 0)

                @foreach ($cartDetails as $item)
                    <table class="table item_cart_loop">
                        <tbody id="cart-items">
                            
                                <?php //dd($cartDetails) ?>
                                <tr class="cart-item-row" data-cart-key="{{ $item['cart_key'] }}" data-weight="">
                                    <td class="product-info" style=" text-align:left; padding-left: 14px; padding-right: 14px;">
                                        <div class="product-details ">
                                            <span class="product-category"
                                                style="font-weight:600">{{ $item['category_name'] }}</span>
                                            <span class="product-category" style="font-weight:600">{{ $item['product_name'] }} -
                                                {{ $item['size'] }}</span>
                                        </div>
                                        <p>Pack Qty - <span style="color:#FF7518;"> {{ $item['pcs_per_pack'] }} x {{ $item['layers_per_pack'] }}</span></p>
                                        <div class="d-flex justify-content-between mt-4">

                                            <div class="product-controls">
                                                <button class="decrease-btn"
                                                    style="background-color: green; color: white; padding: 2px 13px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;"
                                                    onclick="updateQuantity('{{ $item['cart_key'] }}', -1)">-</button>

                                                <input type="text" class="custom-quantity" value="{{ $item['quantity'] }}"
                                                    style="width: 40px; padding: 5px; font-size: 16px; text-align: center; border: 1px solid #ccc; border-radius: 4px; background-color: #f5f5f5; transition: border-color 0.3s ease;">

                                                <button class="increase-btn"
                                                    style="background-color: green; color: white; padding: 2px 12px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;"
                                                    onclick="updateQuantity('{{ $item['cart_key'] }}', 1)">+</button>

                                            </div>

                                            <div>
                                                <button class="btn-remove" onclick="removeCartItem('{{ $item['cart_key'] }}')"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                   
                                    
                                </tr>
                                 
                          
                        </tbody>
                        <input type="hidden" class="item_calculated_weight" value="{{ $item['total_packing_weight'] }}">
                    </table>
                    
                    <!-- <h6 class="text-end">Calculated Weight = {{ $item['total_packing_weight'] }}</h6> -->
                    <!-- <h6 class=" total-packing-weight">Calculated Weight = {{ $item['total_packing_weight'] }}</h6> -->

                    @endforeach
                    
                    <h5 class="text-end">Total Packing Weight: <span id="total-packing-weight">{{ $totalPackingWeight }}</span> kg</h5>
                    <!-- <div class="order-summary mt-4">
                        <a href="{{ url('/retailer-shop/save-cart-item')}}" class="btn btn-checkout mt-3">Confirm Order</a>
                    </div> -->
                   
                    <div class="mt-4">
                      
                        <a href="{{ url('/retailer-shop/save-cart-item') }}" class="btn btn-checkout mt-3 w-100" >Confirm Order</a>
                    </div>

                @else
                    <div class="text-center p-4">
                        <h4>Your cart is empty 🛒</h4>
                        <a href="{{ url('/retailer-shop') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('frontend.retailer.common.homefooter')
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (window.location.pathname === "/retailer-shop/cart-details") {
            document.querySelector('.category-section').classList.add('d-none');
        }
    });
</script>
<script>

document.addEventListener("DOMContentLoaded", function () {
    let totalPackingWeight = 0;


    document.querySelectorAll('.cart-item-row').forEach(row => {
        const cartKey = row.getAttribute('data-cart-key');
        const quantity = parseInt(row.querySelector('.custom-quantity').value) || 0;
        const packingWeight = parseFloat(row.querySelector('.total-packing-weight').textContent) || 0;

        totalPackingWeight += packingWeight * quantity;
    });

    document.querySelector('#total-packing-weight').textContent = totalPackingWeight.toFixed(2);

    document.querySelectorAll('.custom-quantity').forEach(input => {
        input.addEventListener('change', function () {
            const cartKey = input.closest('.cart-item-row').getAttribute('data-cart-key');
            const quantity = parseInt(input.value) || 0;


            updateCartData(cartKey, quantity);
        });
    });

    function updateTotalPackingWeight() {
        let newTotalPackingWeight = 0;

        document.querySelectorAll('.cart-item-row').forEach(row => {
            const quantity = parseInt(row.querySelector('.custom-quantity').value) || 0;
            const itemTotalPackingWeight = parseFloat(row.querySelector('.total-packing-weight').textContent) || 0;

            newTotalPackingWeight += itemTotalPackingWeight * quantity;
        });

        document.querySelector('#total-packing-weight').textContent = newTotalPackingWeight.toFixed(2);
    }

    function updateCartData(cartKey, quantity) {
        fetch(`/update-cart/${cartKey}`, {
            method: 'POST',
            body: JSON.stringify({ quantity: quantity }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            updateTotalPackingWeight();
        })
        .catch(error => {
            console.error("Error updating cart data:", error);
        });
    }
});


</script>

<!-- <script>


    function updateQuantity(cartKey, change) {
        let quantityInput = document.querySelector(`[data-cart-key='${cartKey}'] .custom-quantity`);
        let currentQuantity = parseInt(quantityInput.value) || 0;
        let newQuantity = currentQuantity + change;

        if (newQuantity > 0) {
            quantityInput.value = newQuantity;
            updateCartData(cartKey, newQuantity);
        }
    }

    function updateCartData(cartKey, quantity) {
        fetch(`/update-cart/${cartKey}`, {
            method: 'POST',
            body: JSON.stringify({ quantity: quantity }),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.json())
            .then(data => {

            });
    }

</script> -->