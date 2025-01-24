document.addEventListener("DOMContentLoaded", function () {
  // Retrieve user data from localStorage
  const user = JSON.parse(localStorage.getItem("user"));

  // Check if the user data is present in localStorage
  if (user) {
    // Set the input values for first name, last name, and email
    document.getElementById("firstName").value = user.first_name || "";
    document.getElementById("lastName").value = user.last_name || "";
    document.getElementById("email").value = user.email || "";

    const userDropdown = document.getElementById("userDropdown");

    // Replace the icon with the user's full name and add a logout option
    userDropdown.innerHTML = `
      <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button" aria-haspopup="true" style="text-decoration: none; color: black;">
    ${user.first_name} ${user.last_name}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" id="logoutBtn">Logout</a></li>
    </ul>
    `;
  }

  // Handle click on the logout button
  document.getElementById("logoutBtn")?.addEventListener("click", function () {
    // Remove the user data from localStorage
    localStorage.removeItem("user");

    // Redirect to the login page after logging out
    window.location.href = "login.php";
  });
});

// Payment form validation
document
  .getElementById("paymentForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Clear previous error messages
    document.querySelectorAll(".error-message").forEach((error) => {
      error.textContent = "";
    });

    // Retrieve the form values
    const cardName = document.getElementById("cardName").value.trim();
    const cardNum = document.getElementById("cardNum").value.trim();
    const expMonth = document.getElementById("expMonth").value.trim();
    const expYear = document.getElementById("expYear").value.trim();
    const cvv = document.getElementById("cvv").value.trim();

    let isValid = true;

    // Perform validation for each field
    if (!cardName) {
      document.getElementById("cardNameError").textContent =
        "The name on the card is required.";
      isValid = false;
    }

    if (!cardNum) {
      document.getElementById("cardNumError").textContent =
        "The card number is required.";
      isValid = false;
    } else if (!/^\d{4}-\d{4}-\d{4}-\d{4}$/.test(cardNum)) {
      document.getElementById("cardNumError").textContent =
        "The card number format is invalid.";
      isValid = false;
    }

    if (!expMonth) {
      document.getElementById("expMonthError").textContent =
        "The expiration month is required.";
      isValid = false;
    }

    if (!expYear) {
      document.getElementById("expYearError").textContent =
        "The expiration year is required.";
      isValid = false;
    }

    if (!cvv) {
      document.getElementById("cvvError").textContent = "The CVV is required.";
      isValid = false;
    } else if (cvv.length !== 3) {
      document.getElementById("cvvError").textContent =
        "The CVV must be 3 digits.";
      isValid = false;
    }

    // If the form is valid, show the modal
    if (isValid) {
      var paymentModal = new bootstrap.Modal(
        document.getElementById("paymentModal")
      );
      paymentModal.show();
    }
  });

fetch("backend/resetCart.php", { method: "POST" })
  .then((response) => response.json())
  .then((data) => {
    if (data.success) {
      clearCartUI(); // Clear the UI
    } else {
      console.error("Failed to reset the cart");
    }
  })
  .catch((error) => console.error("Error resetting cart:", error));
function clearCartUI() {
  document.querySelector(".cart-list").innerHTML =
    '<p class="empty-cart">Your cart is empty.</p>';
  document.getElementById("total-quantity").textContent = "Total Quantity: 0";
  document.getElementById("total-price").textContent = "Total Price: $0.00";
}
