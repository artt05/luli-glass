function updateCartVisibility() {
  const cartList = document.querySelector(".cart-list");
  const emptyCartMessage = document.querySelector(".empty-cart");

  // Check if there are any cart items
  if (cartList.querySelectorAll(".cart-item").length > 0) {
    emptyCartMessage.style.display = "none";
  } else {
    emptyCartMessage.style.display = "block";
  }
}

function addToCart(
  productId,
  productName,
  productImage,
  productQuantity,
  productPrice
) {
  // Validate inputs
  productPrice = parseFloat(productPrice) || 0;
  productQuantity = parseInt(productQuantity) || 0;

  if (productQuantity <= 0 || productPrice <= 0) {
    alert("Please enter valid inputs for quantity and price.");
    return;
  }

  // Send the product data to the backend via fetch
  fetch("backend/addToCart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      id: productId,
      name: productName,
      quantity: productQuantity,
      price: productPrice,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Update the cart badge in real-time
        document.getElementById("itemCount").innerText = data.totalItems;

        // Update the cart UI in the DOM
        const cartList = document.querySelector(".cart-list");
        if (!cartList) {
          console.error("Cart list not found in the product menu.");
          return;
        }

        // Check if the product already exists in the cart
        const existingCartItem = cartList.querySelector(
          `.cart-item[data-id="${productId}"]`
        );

        if (existingCartItem) {
          // Update the quantity and price of the existing item
          const quantityElement = existingCartItem.querySelector(".quantity");
          const priceElement = existingCartItem.querySelector(".product-price");

          const currentQuantity = parseInt(quantityElement.innerText) || 0;
          const currentPrice =
            parseFloat(priceElement.innerText.replace("Price: $", "")) || 0;

          const newQuantity = currentQuantity + productQuantity;
          const addedPrice = productPrice * productQuantity;
          const updatedPrice = currentPrice + addedPrice;

          // Update quantity and price
          quantityElement.innerText = newQuantity;
          priceElement.innerText = `Price: $${updatedPrice.toFixed(2)}`;

          console.log(
            `Updated Item - ID: ${productId}, Quantity: ${newQuantity}, Price: $${updatedPrice.toFixed(
              2
            )}`
          );
        } else {
          // Add a new product to the cart
          const cartItem = document.createElement("div");
          cartItem.classList.add("cart-item");
          cartItem.setAttribute("data-id", productId);
          cartItem.innerHTML = `
                        <img src="${productImage}" alt="${productName}" class="product-image">
                        <div class="product-details">
                            <h3 class="product-name">${productName}</h3>
                            <p class="product-price">Price: $${productPrice.toFixed(
                              2
                            )}</p>
                            <p>Quantity: <span class="quantity">${productQuantity}</span></p>
                        </div>
                        <button class="remove-item" onclick="removeCartItem(${productId})">Remove</button>
                    `;
          cartList.appendChild(cartItem);
        }

        // Reset the input fields
        resetInputFields();
        console.log(data.message);
      } else {
        console.error("Failed to add product to cart:", data.message);
      }
    })
    .catch((error) => console.error("Error in fetch:", error));
}

function removeCartItem(productId) {
  fetch("backend/removeFromCart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      id: productId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Update UI after successful removal
        document.querySelector(`.cart-item[data-id="${productId}"]`).remove();
        document.getElementById("itemCount").innerText = data.totalItems;
      } else {
        console.error("Failed to remove item:", data.message);
      }
    })
    .catch((error) => console.error("Error in removing item:", error));
}

function updateCartSummary() {
  const cartItems = document.querySelectorAll(".cart-item");
  let totalQuantity = 0;
  let totalPrice = 0;

  cartItems.forEach((item) => {
    const quantity = parseInt(item.querySelector(".quantity").innerText);
    const price = parseFloat(
      item.querySelector(".product-price").innerText.replace("$", "")
    );

    totalQuantity += quantity;
    totalPrice += quantity * price;
  });

  // Update the total quantity in the cart summary
  const totalQuantityElement = document.getElementById("total-quantity");
  if (totalQuantityElement) {
    totalQuantityElement.innerText = `Total Quantity: ${totalQuantity}`;
  }

  // Update the total price in the cart summary
  const totalPriceElement = document.getElementById("total-price");
  if (totalPriceElement) {
    totalPriceElement.innerText = `Total Price: $${totalPrice.toFixed(2)}`;
  }
}

//update the badge

function updateItemCount() {
  const cartItems = document.querySelectorAll(".cart-item");
  let totalQuantity = 0;

  cartItems.forEach((item) => {
    const quantity = parseInt(item.querySelector(".quantity").innerText) || 0;
    totalQuantity += quantity;
  });

  // Update the item count badge
  const itemCountBadge = document.getElementById("itemCount");
  itemCountBadge.innerText = totalQuantity;

  // Hide the badge if the cart is empty
  if (totalQuantity === 0) {
    itemCountBadge.style.display = "none";
  } else {
    itemCountBadge.style.display = "inline-block";
  }
}

function resetInputFields() {
  // Select all input fields and reset their values
  document.querySelectorAll('input[type="number"]').forEach((input) => {
    input.value = ""; // Clear number inputs
  });

  document.querySelector('textarea[name="additional_details"]').value = ""; // Clear textarea
}
