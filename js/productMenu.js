document.addEventListener("DOMContentLoaded", () => {
  const productMenuContainer = document.getElementById("productMenu");
  const closeButton = document.querySelector(".close-button");

  // Function to open the menu
  function openMenuWithSlide() {
    productMenuContainer.classList.add("open");
    console.log("Menu is now visible and sliding in.");
  }

  // Function to close the menu
  function closeMenuWithSlide() {
    productMenuContainer.classList.remove("open");
    console.log("Menu is sliding out.");
  }

  // Function to toggle the menu
  function toggleCartMenu() {
    if (!productMenuContainer) {
      console.error("Error: Product menu container not found.");
      return;
    }

    if (productMenuContainer.classList.contains("open")) {
      closeMenuWithSlide();
    } else {
      openMenuWithSlide();
    }
  }

  // Attach event listener to close button
  if (closeButton) {
    closeButton.addEventListener("click", (event) => {
      event.stopPropagation(); // Prevent the click from propagating to the document
      closeMenuWithSlide();
    });
  }

  // Attach event listener to the cart icon
  const cartIcon = document.getElementById("cartIcon");
  if (cartIcon) {
    cartIcon.addEventListener("click", (event) => {
      event.stopPropagation();
      toggleCartMenu();

      // Add or remove outside click listener
      if (productMenuContainer.classList.contains("open")) {
        document.addEventListener("click", closeMenuOnOutsideClick);
      } else {
        document.removeEventListener("click", closeMenuOnOutsideClick);
      }
    });
  }

  // Function to close the menu when clicking outside
  function closeMenuOnOutsideClick(event) {
    if (
      !productMenuContainer.contains(event.target) &&
      event.target.id !== "cartIcon"
    ) {
      console.log("Click detected outside the menu. Closing the menu.");
      closeMenuWithSlide();
      document.removeEventListener("click", closeMenuOnOutsideClick);
    }
  }
});

function redirectToCheckout() {
  window.location.href = "checkout.php";
}
