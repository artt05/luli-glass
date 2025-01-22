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

document.addEventListener("DOMContentLoaded", () => {
  const checkoutButton = document.querySelector(".btn-primary");

  if (!checkoutButton) {
    console.error(
      "Checkout button not found! Ensure it has the correct class or ID."
    );
    return; // Stop execution if the button is not found
  }

  checkoutButton.addEventListener("click", (event) => {
    event.preventDefault(); // Prevent the default navigation to the payment page

    // Simulate checking if the user is logged in
    const isLoggedIn = false; // Replace with actual login check logic (e.g., session or cookie check)

    console.log("Checkout button clicked. Is user logged in?", isLoggedIn);

    if (!isLoggedIn) {
      Swal.fire({
        title: "You must be logged in to proceed with the payment",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Login",
        cancelButtonText: "Register",
        reverseButtons: true,
      }).then((result) => {
        console.log("SweetAlert response:", result);

        if (result.isConfirmed) {
          // Redirect to login page
          console.log("Redirecting to login page...");
          window.location.href = "/luli-glass/auth/login.php";
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          // Redirect to registration page
          console.log("Redirecting to registration page...");
          window.location.href = "../auth/register.php";
        }
      });
    } else {
      // If logged in, allow navigation to payment page
      console.log("User is logged in. Redirecting to payment page...");
      window.location.href = "payment.php";
    }
  });
});
