function validateLoginForm(event) {
  event.preventDefault(); // Prevent form submission and page reload
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const passwordPattern =
    /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

  // Validate email format
  if (!emailPattern.test(email)) {
    swal.fire({
      icon: "error",
      title: "Invalid Email",
      text: "Please enter a valid email address.",
      showConfirmButton: true,
      timer: 5000,
      timerProgressBar: true,
      backdrop: false,
    });
    return false;
  }

  // Validate password format
  if (!passwordPattern.test(password)) {
    swal.fire({
      icon: "error",
      title: "Invalid Password",
      text: "Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.",
      showConfirmButton: true,
      timer: 5000,
      timerProgressBar: true,
      backdrop: false,
    });
    return false;
  }

  // Show success pop-up for valid login
  Swal.fire({
    icon: "success",
    title: "Login Successful",
    text: "You have successfully logged in!",
    showConfirmButton: true,
    timer: 5000,
    timerProgressBar: true,
    backdrop: false,
  }).then(() => {
    // Redirect to homepage or dashboard
    window.location.href = "../index.php"; // Change the URL as needed
  });

  return true;
}
emailjs.init("PyH29-umGbaGbPpwR");
function resetPassword(event) {
  event.preventDefault(); // Prevent form submission and page reload

  const email = document.getElementById("email").value;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(email)) {
    Swal.fire({
      icon: "error",
      title: "Invalid Email",
      text: "Please enter a valid email address.",
      showConfirmButton: true,
      timer: 5000,
      timerProgressBar: true,
      backdrop: false,
    });
    return false; // Explicitly return false to stop form submission
  }
  emailjs.send("service_ld7b7zm", "template_5huj37a", { email: email }).then(
    (response) => {
      console.log("Email sent successfully:", response);
      Swal.fire({
        icon: "success",
        title: "Email Sent",
        text: "Password reset link sent to your email.",
        showConfirmButton: true,
        timer: 5000,
        timerProgressBar: true,
        backdrop: false,
      });
    },
    (error) => {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Failed to send email. Please try again later.",
        showConfirmButton: true,
        timer: 5000,
        timerProgressBar: true,
        backdrop: false,
      });
      console.error("Failed to send email:", error);
    }
  );

  // Ensure no form submission happens
}

function validateForgotPasswordForm(event) {
  event.preventDefault(); // Prevent form submission

  // Get email value
  const email = document.getElementById("email").value;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Check if the email is valid
  if (!emailPattern.test(email)) {
    swal.fire({
      icon: "error",
      title: "Invalid Email",
      text: "Please enter a valid email address.",
      showConfirmButton: true,
      timer: 5000,
      timerProgressBar: true,
      backdrop: false,
    });
    return false; // Stop submission
  }

  // If valid, show success pop-up
  swal.fire({
    icon: "success",
    title: "Email Sent",
    text: "Password reset link sent to your email.",
    showConfirmButton: true,
    timer: 5000,
    timerProgressBar: true,
    backdrop: false,
  });

  // You can optionally reset the form
  document.getElementById("registrationForm").reset();
}

function validateRegisterForm(event) {
  event.preventDefault(); // Prevent form submission

  // Get form values
  const name = document.getElementById("name").value.trim();
  const lastName = document.getElementById("last-name").value.trim();
  const number = document.getElementById("number").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  // Regular expressions for validation
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const phonePattern = /^\+?\d{9,}$/; // Allows optional '+' and at least 9 digits
  const passwordPattern =
    /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

  // Validation checks
  if (!name) {
    swal.fire({
      icon: "error",
      title: "Invalid Name",
      text: "Name cannot be empty.",
    });
    return false;
  }

  if (!lastName) {
    swal.fire({
      icon: "error",
      title: "Invalid Last Name",
      text: "Last name cannot be empty.",
    });
    return false;
  }

  if (!phonePattern.test(number)) {
    swal.fire({
      icon: "error",
      title: "Invalid Phone Number",
      text: "Phone number must be at least 9 digits long and may start with '+'.",
    });
    return false;
  }

  if (!emailPattern.test(email)) {
    swal.fire({
      icon: "error",
      title: "Invalid Email",
      text: "Please enter a valid email address.",
    });
    return false;
  }

  if (!passwordPattern.test(password)) {
    swal.fire({
      icon: "error",
      title: "Invalid Password",
      text: "Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.",
    });
    return false;
  }

  // If all fields are valid
  swal
    .fire({
      icon: "success",
      title: "Registration Successful",
      text: "You have successfully registered!",
      showConfirmButton: true,
      timer: 5000,
      timerProgressBar: true,
      backdrop: false,
    })
    .then(() => {
      // Redirect to homepage or dashboard
      window.location.href = "../index.php"; // Change the URL as needed
    });

  // Reset the form after submission
  document.getElementById("registrationForm").reset();
  return true;
}

//  calculating total dimensions in millimeters for width and height in product-details
function calculateDynamicPrice() {
  // Base Price
  let price = 0.0;

  // Height Inputs
  const heightMeters =
    parseInt(document.querySelector('input[name="height-meters"]').value || 0) *
    1000;
  const heightCentimeters =
    parseInt(
      document.querySelector('input[name="height-centimeters"]').value || 0
    ) * 10;
  const heightMillimeters = parseInt(
    document.querySelector('input[name="height-millimeters"]').value || 0
  );

  // Width Inputs
  const widthMeters =
    parseInt(document.querySelector('input[name="width-meters"]').value || 0) *
    1000;
  const widthCentimeters =
    parseInt(
      document.querySelector('input[name="width-centimeters"]').value || 0
    ) * 10;
  const widthMillimeters = parseInt(
    document.querySelector('input[name="width-millimeters"]').value || 0
  );

  // Thickness and Border Radius
  const thickness = parseInt(
    document.querySelector('input[name="thickness"]').value || 0
  );
  const borderRadius = parseInt(
    document.querySelector('input[name="border_radius"]').value || 0
  );

  // Calculate total dimensions
  const totalHeightInCm =
    (heightMeters + heightCentimeters + heightMillimeters) / 10;
  const totalWidthInCm =
    (widthMeters + widthCentimeters + widthMillimeters) / 10;

  // Pricing Logic
  price += totalHeightInCm * 0.2; // $0.20 per cm of height
  price += totalWidthInCm * 0.2; // $0.20 per cm of width
  price += thickness * 1.0; // $1.00 per mm of thickness
  price += borderRadius * 0.5; // $0.50 per mm of border radius

  // Update the display
  document.getElementById("price-display").innerText = `Price: $${price.toFixed(
    2
  )}`;
}

// Attach event listeners to all input fields
document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("input", calculateDynamicPrice);
});
