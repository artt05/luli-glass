function validateLoginForm(event) {
  event.preventDefault(); // Prevent form submission and page reload
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Validate input fields for empty values
  if (!email || !password) {
    Swal.fire({
      icon: "error",
      title: "Missing Fields",
      text: "Please fill out all fields.",
      showConfirmButton: true,
    });
    return false;
  }

  // Make an AJAX request to the backend
  fetch("validate_login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ email, password }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Response from server:", data); // Log the response for debugging

      if (data.status === "error") {
        Swal.fire({
          icon: "error",
          title: data.title,
          text: data.message,
          showConfirmButton: true,
        });
      } else if (data.status === "success") {
        Swal.fire({
          icon: "success",
          title: "Login Successful",
          text: "You have successfully logged in!",
          showConfirmButton: true,
        }).then(() => {
          window.location.href = "../index.php"; // Redirect on successful login
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      Swal.fire({
        icon: "error",
        title: "Server Error",
        text: "Something went wrong. Please try again later.",
        showConfirmButton: true,
      });
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

  Swal.fire({
    title: "Success!",
    text: "Your registration was successful!",
    icon: "success",
    confirmButtonText: "OK",
  }).then((result) => {
    if (result.isConfirmed) {
      // Optionally redirect or process further
      window.location.href = "login.php";
    }
  });
  // swal
  //   .fire({
  //     icon: "success",
  //     title: "Registration Successful",
  //     text: "You have successfully registered!",
  //     showConfirmButton: true,
  //     timer: 5000,
  //     timerProgressBar: true,
  //     backdrop: false,
  //   })
  //   .then(() => {
  //     // Redirect to homepage or dashboard
  //     window.location.href = "../index.php";
  //   });

  // Reset the form after submission
  document.getElementById("registrationForm").reset();
  return true;
}
