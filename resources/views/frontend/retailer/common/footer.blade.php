<!-- cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" style="padding-left:4rem!important ;" id="cartModalLabel">Shopping Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="thank-you-message">
                    Thank You for Shopping with Us!
                </div>
                <p>Your items have been successfully added to the cart. You can now continue shopping or proceed to checkout.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn" data-bs-dismiss="modal">Continue Shopping</button> -->
                <a href="/checkout.html" class="btn">Go to Checkout</a>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas card Bottom -->
<button class="close-btn" id="closebtn" onclick="closeOffcanvas()">&times;</button>
 
<div class="custom-bottom-offcanvas" id="productOffcanvas">

<h5 id="offcanvasTitle" style="color:#fd7e14"></h5>

   
    <!-- <p style="color:#006400">Select unit</p> -->
    <div id="variantContainer"></div>

    <!-- New line with total, kg and arrow -->
    <div class="offcanvas-footer" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-top: 1px solid #ccc;">
        <div class="offcanvas-total" style="font-weight: bold; font-size: 16px;">
            Total Weight: <span id="totalAmount"> 0 kg</span>
        </div>
        
        <div class="offcanvas-arrow" style="margin-left: auto;">
            <a href="{{ route('retailer.cart.details') }}" class="btn btn-link" style="text-decoration: none; color: black; font-size: 24px;">
                <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>
</div>
