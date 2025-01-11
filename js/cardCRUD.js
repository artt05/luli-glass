// Add to cart function

function addToCart(productId, productName, productImage, productQuantity) {
  console.log(
    `Adding product to cart: ${productId}, ${productName}, Quantity: ${productQuantity}`
  );

  // Check if the quantity is valid
  if (!productQuantity || productQuantity <= 0) {
    alert("Please enter a valid quantity.");
    return;
  }

  // Access the cart menu
  const cartList = document.querySelector(".cart-list");

  if (!cartList) {
    console.error("Cart list not found in the product menu.");
    return;
  }

  // Check if the product is already in the cart
  const existingCartItem = document.querySelector(
    `.cart-item[data-id="${productId}"]`
  );
  if (existingCartItem) {
    // Update the quantity of the existing item
    const quantityElement = existingCartItem.querySelector(".quantity");
    const newQuantity =
      parseInt(quantityElement.innerText) + parseInt(productQuantity);
    quantityElement.innerText = newQuantity;
    console.log(`Updated quantity for product ${productId}: ${newQuantity}`);
    return;
  }

  // Create a new cart item
  const cartItem = document.createElement("div");
  cartItem.classList.add("cart-item");
  cartItem.setAttribute("data-id", productId);

  // Add the product details to the cart item
  cartItem.innerHTML = `
          <img src="${productImage}" alt="${productName}" class="product-image">
          <div class="product-details">
              <h3 class="product-name">${productName}</h3>
              <p class="product-price">Price: $0.00</p>
              <p>Quantity: <span class="quantity">${productQuantity}</span></p>
          </div>
          <button class="remove-item" onclick="removeCartItem(${productId})">Remove</button>
      `;

  // Append the new cart item to the cart list
  cartList.appendChild(cartItem);

  console.log(
    "Product added to cart:",
    productId,
    productName,
    productQuantity
  );
}

function removeCartItem(productId) {
  console.log(`Removing product from cart: ${productId}`);

  const cartItem = document.querySelector(`.cart-item[data-id="${productId}"]`);

  if (cartItem) {
    cartItem.remove();
    console.log(`Product removed from cart: ${productId}`);

    // Update cart summary after removing the item
    updateCartSummary();
  } else {
    console.error(`Cart item with ID ${productId} not found.`);
  }
}
