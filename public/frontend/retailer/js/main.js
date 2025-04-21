// function showVarients(productId) {
//     const productOffcanvas = document.getElementById("productOffcanvas");
//     const offcanvasTitle = document.getElementById("offcanvasTitle");
//     const variantContainer = document.getElementById("variantContainer");

//     offcanvasTitle.innerText = "Loading...";
//     variantContainer.innerHTML = "<p>Loading variants...</p>";

//     fetch(`/retailer-shop/retailer-product-variants/${productId}`)
//         .then(response => response.json())
//         .then(data => {
//             if (data.error) {
//                 offcanvasTitle.innerText = "Product not found";
//                 variantContainer.innerHTML = "<p>No variants available</p>";
//                 return;
//             }

//             fetch('/retailer-shop/cart')
//                 .then(response => response.json())
//                 .then(cartData => { 
//                     // Update title
//                     offcanvasTitle.innerText = data.name;
//                     variantContainer.innerHTML = "";

//                     // Check if there are variants
//                     if (data.variants.length === 0) {
//                         variantContainer.innerHTML = "<p><b>No variants available for this product.</b></p>";
//                     } else {
                       
//                         data.variants.forEach(variant => {
//                             let cartKey = `${productId}-${variant.variant_id}`;
//                             let cartQty = cartData.cart[cartKey] ? cartData.cart[cartKey].quantity : 0;

//                             let variantHtml = `
//                                 <div class="product-option">
//                                     <img src="http://192.168.1.3:8000/frontend/retailer/images/Picture1.png" alt="Variant">
//                                     <div class="product-details">
//                                         <p><i class="fas fa-tint" style="color:#FF7518;"></i>
//                                             Volume: ${variant.size}<br>
//                                             ${variant.per_pack} x ${variant.layer_pack} 
//                                         </p>
//                                     </div>
//                                     ${
//                                         cartQty > 0
//                                             ? `<div class="custom-cart-controls" style="display: flex;">
//                                                 <button onclick="decreaseQty(this, ${productId}, ${variant.variant_id})">-</button>
//                                                 <input type="text" class="custom-quantity">${cartQty}</input>
//                                                 <button onclick="increaseQty(this, ${productId}, ${variant.variant_id})">+</button>
//                                             </div>`
//                                             : `<button class="add-btn" onclick="toggleCartItem(this, ${productId}, ${variant.variant_id})">ADD</button>`
//                                     }
//                                 </div>
//                             `;

//                             variantContainer.innerHTML += variantHtml;
//                         });
//                     }
//                 })
//                 .catch(error => console.error("Error fetching cart data:", error));
//         })
//         .catch(error => {
//             console.error("Error fetching product data:", error);
//             offcanvasTitle.innerText = "Error loading product";
//             variantContainer.innerHTML = "<p>Failed to load variants</p>";
//         });

//     // Show the offcanvas
//     productOffcanvas.style.display = "block";
//     setTimeout(() => {
//         productOffcanvas.style.transition = "transform 0.3s ease-in-out";
//         closebtn.style.display = "block";
//         productOffcanvas.style.transform = "translateX(0)";
//     }, 10);
// }

//     function closeOffcanvas() {
//         const productOffcanvas = document.getElementById("productOffcanvas");
//         productOffcanvas.style.transition = "transform 0.3s ease-in-out";
//         productOffcanvas.style.transform = "translateY(100%)"; 
//         setTimeout(() => {
//             productOffcanvas.style.display = "none";
//             closebtn.style.display = "none";
//         }, 300); 
//     }

//     window.onload = function () {
//         closeOffcanvas(); 
//     };

//     function toggleCartItem(button, productId, variantId) {
        
//         button.style.display = "none";
    
//         let controls = document.createElement("div");
//         controls.classList.add("custom-cart-controls");
//         controls.style.display = "flex";
//         controls.innerHTML = `
//             <button onclick="decreaseQty(this, ${productId}, ${variantId})">-</button>
//             <span class="custom-quantity">1</span>
//             <button onclick="increaseQty(this, ${productId}, ${variantId})">+</button>
//         `;
    
//         let parentDiv = button.parentNode;
//         parentDiv.appendChild(controls);
    
//         // Call backend to update session
//         updateCart(productId, variantId, 1);
//     }
    
    
    

//     function increaseQty(button, productId, variantId) {
//         let quantitySpan = button.previousElementSibling;
//         let quantity = parseInt(quantitySpan.textContent) + 1;
        
//         quantitySpan.textContent = quantity;
        
//         // Update session in backend
//         updateCart(productId, variantId, quantity);
//     }
    
//     function decreaseQty(button, productId, variantId) {
//         let quantitySpan = button.nextElementSibling;
//         let quantity = parseInt(quantitySpan.textContent);
    
//         if (quantity > 1) {
//             quantity -= 1;
//             quantitySpan.textContent = quantity;
//             updateCart(productId, variantId, quantity);
//         } else {
//             // Remove item from cart when quantity reaches 0
//             button.parentNode.previousElementSibling.style.display = "block";
//             button.parentNode.remove();
//             updateCart(productId, variantId, 0);
//         }
//     }
    

//     function updateCart(productId, variantId, quantity = 1) {

//         console.log(`Sending updateCart: Product ID = ${productId}, Variant ID = ${variantId}, Quantity = ${quantity}`);
        
//         fetch('/retailer-shop/cart/update', {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//             },
//             body: JSON.stringify({
//                 product_id: productId,
//                 variant_id: variantId,
//                 quantity: quantity,
//             }),
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log("Cart Updated:", data);
//             updateCartCount(); // Refresh cart count in header
//         })
//         .catch(error => console.error("Error updating cart:", error));
//     }
    

//     function updateCartCount() {

//         fetch('/retailer-shop/cart')
//             .then(response => response.json())
//             .then(cartData => {
             
    
//                 console.log("Raw cart data:", cartData); 

//                 let cartItems = cartData.cart || {};
//                 console.log("Raw cartItems:", cartItems); 
    
//                 if (Object.keys(cartItems).length === 0) {
//                     document.getElementById("cartCount").textContent = 0;
//                     return;
//                 }
    
//                 document.getElementById("cartCount").textContent = cartData.total_count;
//             })
//             .catch(error => {
//                 console.error("Error fetching cart count:", error);
//                 document.getElementById("cartCount").textContent = 0;
//             });
//     }

//     // cart details page //

//     function updateQuantity(cartKey, change) {
//         let row = document.querySelector(`[data-cart-key="${cartKey}"]`);
//         let quantitySpan = row.querySelector(".qty");
//         let newQuantity = parseInt(quantitySpan.textContent) + change;
    
//         if (newQuantity < 1) return;
    
//         fetch('/retailer-shop/cart/update', {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//             },
//             body: JSON.stringify({ cart_key: cartKey, quantity: newQuantity }),
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 quantitySpan.textContent = newQuantity;
//                 updateCartCount(); 
//             }
//         })
//         .catch(error => console.error("Error updating cart:", error));
//     }
    
//     function removeCartItem(cartKey) {
//         fetch('/retailer-shop/cart/remove', {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//             },
//             body: JSON.stringify({ cart_key: cartKey }),
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 document.querySelector(`[data-cart-key="${cartKey}"]`).remove();
//                 updateCartCount();  
//             }
//         })
//         .catch(error => console.error("Error removing cart item:", error));
//     }
//     // cart details page //
    
    
//     document.addEventListener("DOMContentLoaded", updateCartCount);




//     document.addEventListener("DOMContentLoaded", function () {

//         const searchInput = document.getElementById("search");
//         const resultsContainer = document.getElementById("search-results");

//         searchInput.addEventListener("keyup", function () {
//             let query = searchInput.value.trim();
            
//             if (query.length > 1) {
//                 fetch(`/retailer-shop/search?query=${query}`)
//                     .then(response => response.json())
//                     .then(data => {
//                         resultsContainer.innerHTML = "";
//                         if (data.length > 0) {
//                             data.forEach(product => {
//                                 let resultItem = document.createElement("a");
//                                 resultItem.href = `/retailer-shop/product/${product.slug}`;
//                                 resultItem.classList.add("list-group-item", "list-group-item-action");
//                                 resultItem.textContent = product.name;
//                                 resultsContainer.appendChild(resultItem);
//                             });
//                         } else {
//                             resultsContainer.innerHTML = '<p class="list-group-item">No products found</p>';
//                         }
//                     })
//                     .catch(error => console.error("Error fetching search results:", error));
//             } else {
//                 resultsContainer.innerHTML = "";
//             }
//         });
//     });

let grandTotalWeight = 0;  

function showVarients(productId) {
    const productOffcanvas = document.getElementById("productOffcanvas");
    const offcanvasTitle = document.getElementById("offcanvasTitle");
    const variantContainer = document.getElementById("variantContainer");

    offcanvasTitle.innerText = "Loading...";
    variantContainer.innerHTML = "<p>Loading variants...</p>";

    fetch(`/retailer-shop/retailer-product-variants/${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                offcanvasTitle.innerText = "Product not found";
                variantContainer.innerHTML = "<p>No variants available</p>";
                return;
            }

            fetch('/retailer-shop/cart')
                .then(response => response.json())
                .then(cartData => {
                   console.log(data);
                   console.log(data.category_name,data.name);
                    offcanvasTitle.innerText =data.category_name+" "+ data.name;
                    variantContainer.innerHTML = "";

                    if (data.variants.length === 0) {
                        variantContainer.innerHTML = "<p><b>No variants available for this product.</b></p>";
                    } else {
                        grandTotalWeight = 0; 

                        data.variants.forEach(variant => {
                            let cartKey = `${productId}-${variant.variant_id}`;
                            let cartQty = cartData.cart[cartKey] ? cartData.cart[cartKey].quantity : 0;
                            const calculatedWeight = variant.packing_weight * cartQty;

                            grandTotalWeight += calculatedWeight;
                            // ${variant.per_pack} x ${variant.layer_pack}


                            let variantHtml = `
                                <div class="product-option" data-weight="${variant.packing_weight}">
                                    <div class="product-details">
                                      <p>
                                         ${variant.size}<br>
                                         <p>Pack Qty-<span style="color:#FF7518;"> ${variant.per_pack} x ${variant.layer_pack}</span></p>
                                        </p>
                                    </div>
                                    ${
                                        cartQty > 0
                                            ? `<div class="" style="display: flex; align-items: center; justify-content: center; margin-top: 10px; gap: 10px;">
                                                <button class="decrease-btn" style="background-color: green; color: white; padding: 8px 15px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;" onclick="decreaseQty(this, ${productId}, ${variant.variant_id})">-</button>
                                                <input type="text" class="custom-quantity" value="${cartQty}" style="width: 50px; padding: 10px ; font-size: 16px; text-align: center; border: 1px solid #ccc; border-radius: 4px; background-color: #f5f5f5; transition: border-color 0.3s ease;">
                                                <button class="increase-btn" style="background-color: green; color: white; padding: 8px 15px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;" onclick="increaseQty(this, ${productId}, ${variant.variant_id})">+</button>
                                            </div>`
                                            : `<button class="add-btn" style="background-color: green !important; color: white; padding: 10px 20px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;" onclick="toggleCartItem(this, ${productId}, ${variant.variant_id})">ADD</button>`
                                    }
                                </div>
                            `;
                        
                            variantContainer.innerHTML += variantHtml;
                        });

                        updateGrandTotalWeight();
                    }
                })
                .catch(error => console.error("Error fetching cart data:", error));
        })
        .catch(error => {
            console.error("Error fetching product data:", error);
            offcanvasTitle.innerText = "Error loading product";
            variantContainer.innerHTML = "<p>Failed to load variants</p>";
        });

    productOffcanvas.style.display = "block";
    setTimeout(() => {
        productOffcanvas.style.transition = "transform 0.3s ease-in-out";
        closebtn.style.display = "block";
        productOffcanvas.style.transform = "translateX(0)";
    }, 0);
}

function closeOffcanvas() {
    const productOffcanvas = document.getElementById("productOffcanvas");
    productOffcanvas.style.transition = "transform 0.3s ease-in-out";
    productOffcanvas.style.transform = "translateY(100%)"; 
    setTimeout(() => {
        productOffcanvas.style.display = "none";
        closebtn.style.display = "none";
    }, 0); 
}

window.onload = function () {
    closeOffcanvas(); 
};

function toggleCartItem(button, productId, variantId) {
    button.style.display = "none";  

    let controls = document.createElement("div");
    controls.classList.add("custom-cart-controls");
    controls.style.display = "flex";
    controls.style.alignItems = "center";
    controls.style.justifyContent = "center";
    controls.style.marginTop = "10px";
    controls.style.gap = "10px";
    controls.innerHTML = `
        <button class="decrease-btn" style="background-color: green; color: white; padding: 8px 15px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;" onclick="decreaseQty(this, ${productId}, ${variantId})">-</button>
        <input type="text" class="custom-quantity" value="1" style="width: 50px; padding: 10px; font-size: 16px; text-align: center; border: 1px solid #ccc; border-radius: 4px; background-color: #f5f5f5; transition: border-color 0.3s ease;">
        <button class="increase-btn" style="background-color: green; color: white; padding: 8px 15px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;" onclick="increaseQty(this, ${productId}, ${variantId})">+</button>
    `;

    let parentDiv = button.parentNode;
    parentDiv.appendChild(controls);

    let quantityInput = controls.querySelector(".custom-quantity");

    quantityInput.addEventListener("keyup", function () {
        let newQuantity = parseInt(quantityInput.value);

        // If quantity is valid and greater than 0
        if (!isNaN(newQuantity) && newQuantity > 0) {
            updateCart(productId, variantId, newQuantity);
            updateWeightDisplay(parentDiv, newQuantity, variantId);
            updateGrandTotalWeight();
        } else {
            quantityInput.value = 1;
            updateCart(productId, variantId, 1);
            updateWeightDisplay(parentDiv, 1, variantId);
            updateGrandTotalWeight();
        }
    });

    updateCart(productId, variantId, 1);
    updateWeightDisplay(parentDiv, 1, variantId);

    if (parseInt(quantityInput.value) < 1) {
        quantityInput.style.display = "none";
    
        parentDiv.querySelector(".decrease-btn").style.display = "none";
        parentDiv.querySelector(".increase-btn").style.display = "none";

        let addButton = document.createElement("button");
        addButton.classList.add("add-btn");
        addButton.style.backgroundColor = "#FF7518";
        addButton.style.color = "white";
        addButton.style.padding = "10px 20px";
        addButton.style.fontSize = "14px";
        addButton.style.border = "none";
        addButton.style.borderRadius = "4px";
        addButton.style.cursor = "pointer";
        addButton.textContent = "ADD";
        addButton.onclick = function () {
            toggleCartItem(this, productId, variantId);
        };

        parentDiv.appendChild(addButton);
    }
}

function decreaseQty(button, productId, variantId) {
    let quantitySpan = button.nextElementSibling;
    let quantity = parseInt(quantitySpan.value);

    if (quantity > 1) {
        quantity -= 1;
        quantitySpan.value = quantity;
        updateCart(productId, variantId, quantity);
        updateWeightDisplay(button.parentNode, quantity, variantId);
        updateGrandTotalWeight();
    } else {
        button.parentNode.querySelector(".decrease-btn").style.display = "none";
        button.parentNode.querySelector(".increase-btn").style.display = "none";
        button.parentNode.querySelector(".custom-quantity").style.display = "none";

        let addButton = document.createElement("button");
        addButton.classList.add("add-btn");
        addButton.style.backgroundColor = "#FF7518";
        addButton.style.color = "white";
        addButton.style.padding = "10px 20px";
        addButton.style.fontSize = "14px";
        addButton.style.border = "none";
        addButton.style.borderRadius = "4px";
        addButton.style.cursor = "pointer";
        addButton.textContent = "ADD";
        addButton.onclick = function () {
            toggleCartItem(this, productId, variantId);
        };

        button.parentNode.appendChild(addButton);
    }
}

function increaseQty(button, productId, variantId) {
    let quantitySpan = button.previousElementSibling;
    let quantity = parseInt(quantitySpan.value) + 1;

    quantitySpan.value = quantity;
    updateCart(productId, variantId, quantity);
    updateWeightDisplay(button.parentNode, quantity, variantId);
    updateGrandTotalWeight();
}

function updateCart(productId, variantId, quantity = 1) {
    fetch('/retailer-shop/cart/update', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
            product_id: productId,
            variant_id: variantId,
            quantity: quantity,
        }),
    })
    .then(response => response.json())
    .then(data => {
        updateCartCount(); 
    })
    .catch(error => console.error("Error updating cart:", error));
}

function updateCartCount() {
    fetch('/retailer-shop/cart')
        .then(response => response.json())
        .then(cartData => {
            let cartItems = cartData.cart || {};
            if (Object.keys(cartItems).length === 0) {
                document.getElementById("cartCount").textContent = 0;
                return;
            }

            document.getElementById("cartCount").textContent = cartData.total_count;
        })
        .catch(error => {
            console.error("Error fetching cart count:", error);
            document.getElementById("cartCount").textContent = 0;
        });
}
// function updateCartCount() {
//     fetch('/retailer-shop/cart')
//         .then(response => response.json())
//         .then(cartData => {
//             let cartItems = cartData.cart || {};
//             if (Object.keys(cartItems).length === 0) {
//                 let cartCountElements = document.getElementsByClassName("cartCount");
//                 if (cartCountElements.length > 0) {
//                     cartCountElements[0].textContent = 0;
//                 }
//                 return;
//             }
//             let cartCountElements = document.getElementsByClassName("cartCount");
//             if (cartCountElements.length > 0) {
//                 cartCountElements[0].textContent = cartData.total_count;
//             }
//         })
//         .catch(error => {
//             console.error("Error fetching cart count:", error);
//             let cartCountElements = document.getElementsByClassName("cartCount");
//             if (cartCountElements.length > 0) {
//                 cartCountElements[0].textContent = 0;
//             }
//         });
// }


function updateWeightDisplay(parentDiv, quantity, variantId) {
    let variantData = parentDiv.closest('.product-option'); 

    if (!variantData) {
        console.error("Variant data not found for variant ID: " + variantId);
        return;
    }

    let variantWeight = parseFloat(variantData.getAttribute("data-weight") || 0); 

    if (variantWeight) {
        let totalWeight = variantWeight * quantity; 
        let weightSpan = variantData.querySelector(".total-weight");
        
        if (weightSpan) {
            weightSpan.textContent = totalWeight.toFixed(2);  
        }
    } else {
        console.warn("Variant weight not found for variant ID: " + variantId);
    }
}

function updateGrandTotalWeight() {
    grandTotalWeight = 0;  

    document.querySelectorAll('.product-option').forEach(option => {
        let weight = parseFloat(option.getAttribute("data-weight"));
        let quantity = parseInt(option.querySelector('.custom-quantity')?.value || 0);
        grandTotalWeight += weight * quantity;
    });

    document.getElementById("totalAmount").textContent = `${grandTotalWeight.toFixed(2)} kg`;
}
// sk changes
function removeCartItem(cartKey) {
    fetch('/retailer-shop/cart/remove', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ cart_key: cartKey }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`[data-cart-key="${cartKey}"]`).remove();
            updateCartCount();  
        }
    })
    .catch(error => console.error("Error removing cart item:", error));
}
// function updateQuantity(cartKey, change) {
//             let row = document.querySelector(`[data-cart-key="${cartKey}"].custom-quantity``);
//             let quantitySpan = row.querySelector(".qty");
//             let newQuantity = parseInt(quantitySpan.textContent) + change;
        
//             if (newQuantity < 1) return;
        
//             fetch('/retailer-shop/cart/update', {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//                 },
//                 body: JSON.stringify({ cart_key: cartKey, quantity: newQuantity }),
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     quantitySpan.textContent = newQuantity;
//                     updateCartCount(); 
//                 }
//             })
//             .catch(error => console.error("Error updating cart:", error));
//         }
        
function updateQuantity(cartKey, change) {

    let quantityInput = document.querySelector(`[data-cart-key='${cartKey}'] .custom-quantity`);
    let cartItemRow = document.querySelector(`[data-cart-key='${cartKey}']`);

    if (!quantityInput || !cartItemRow) {
        console.error(`Element with cartKey ${cartKey} not found.`);
        return;  // If element not found, stop the function
    }

    let currentQuantity = parseInt(quantityInput.value) || 0;
    let newQuantity = currentQuantity + change;
console.log("gg",cartKey, change,currentQuantity,newQuantity);

    if (newQuantity > 0) {
        quantityInput.value = newQuantity;
        updateCartData(cartKey, newQuantity);
    }

    updateTotalPackingWeight()
}

function updateTotalPackingWeight() {

    let newTotalPackingWeight = 0;

$('.item_cart_loop').each(function() {
    const quantity = parseInt($(this).find('.custom-quantity').val(), 10);

    const itemTotalPackingWeight = parseFloat($(this).find('.item_calculated_weight').val());
    console.log('Item Total Packing Weight:', itemTotalPackingWeight, 'Quantity:', quantity);
    if (!isNaN(itemTotalPackingWeight) && !isNaN(quantity)) {
        newTotalPackingWeight += itemTotalPackingWeight * quantity;
    }
});


$('#total-packing-weight').text(newTotalPackingWeight.toFixed(2)); 

    // document.querySelector('#total-packing-weight').textContent = newTotalPackingWeight.toFixed(2);
    // let newTotalPackingWeight = 0;

    // document.querySelectorAll('.cart-item-row').forEach(row => {
    //     const quantity = parseInt(row.querySelector('.custom-quantity').value) || 0;
    //     const itemTotalPackingWeight = parseFloat(row.querySelector('.total-packing-weight').textContent) || 0;

    //     newTotalPackingWeight += itemTotalPackingWeight * quantity;
    // });

    // document.querySelector('#total-packing-weight').textContent = newTotalPackingWeight.toFixed(2);
}
function updateCartData(cartKey, quantity) {
    fetch('/retailer-shop/cart/update', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ cart_key: cartKey, quantity: quantity }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Cart updated successfully. Packing Weight: ", data.packing_weight);
        } else {
            console.log("Error: ", data.error);
        }
    })
    .catch(error => {
        console.error("Error updating cart data:", error);
    });
}

document.addEventListener("DOMContentLoaded", updateCartCount); 
