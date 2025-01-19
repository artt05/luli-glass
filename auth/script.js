// function validateLoginForm(event) {
//   event.preventDefault(); // Prevent form submission and page reload
//   const email = document.getElementById("email").value;
//   const password = document.getElementById("password").value;

//   // Validate input fields for empty values
//   if (!email || !password) {
//     Swal.fire({
//       icon: "error",
//       title: "Missing Fields",
//       text: "Please fill out all fields.",
//       showConfirmButton: true,
//     });
//     return false;
//   }

//   // Make an AJAX request to the backend
//   fetch("validate_login.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json",
//     },
//     body: JSON.stringify({ email, password }),
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       console.log("Response from server:", data); // Log the response for debugging

//       if (data.status === "error") {
//         Swal.fire({
//           icon: "error",
//           title: data.title,
//           text: data.message,
//           showConfirmButton: true,
//         });
//       } else if (data.status === "success") {
//         Swal.fire({
//           icon: "success",
//           title: "Login Successful",
//           text: "You have successfully logged in!",
//           showConfirmButton: true,
//         }).then(() => {
//           window.location.href = "../index.php"; // Redirect on successful login
//         });
//       }
//     })
//     .catch((error) => {
//       console.error("Error:", error);
//       Swal.fire({
//         icon: "error",
//         title: "Server Error",
//         text: "Something went wrong. Please try again later.",
//         showConfirmButton: true,
//       });
//     });

//   return true;
// }

function validateLoginForm(event) {
  event.preventDefault(); // Prevent form submission and page reload

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (!email || !password) {
    Swal.fire({
      icon: "error",
      title: "Missing Fields",
      text: "Please fill out all fields.",
      showConfirmButton: true,
    });
    return false;
  }

  fetch("validate_login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ email, password }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Server response:", data); // Log the response for debugging

      if (data.status === "error") {
        Swal.fire({
          icon: "error",
          title: "Login Failed",
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
          console.log("Redirecting to:", data.redirect); // Log the redirect URL
          window.location.href = data.redirect; // Redirect using the backend-provided URL
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
}

// function validateLoginForm(event) {
//   event.preventDefault(); // Prevent form submission and page reload
//   const email = document.getElementById("email").value;
//   const password = document.getElementById("password").value;

//   // Validate input fields for empty values
//   if (!email || !password) {
//     Swal.fire({
//       icon: "error",
//       title: "Missing Fields",
//       text: "Please fill out all fields.",
//       showConfirmButton: true,
//     });
//     return false;
//   }

//   // Make an AJAX request to the backend
//   fetch("validate_login.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json",
//     },
//     body: JSON.stringify({ email, password }),
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       console.log("Response from server:", data); // Log the response for debugging

//       if (data.status === "error") {
//         Swal.fire({
//           icon: "error",
//           title: data.title,
//           text: data.message,
//           showConfirmButton: true,
//         });
//       } else if (data.status === "success") {
//         Swal.fire({
//           icon: "success",
//           title: "Login Successful",
//           text: "You have successfully logged in!",
//           showConfirmButton: true,
//         }).then(() => {
//           // Redirect based on the user's role
//           if (data.role === "admin") {
//             window.location.href = "../admin/index.php"; // Redirect admin to the admin dashboard
//           } else {
//             window.location.href = "../index.php"; // Redirect regular users to the homepage
//           }
//         });
//       }
//     })
//     .catch((error) => {
//       console.error("Error:", error);
//       Swal.fire({
//         icon: "error",
//         title: "Server Error",
//         text: "Something went wrong. Please try again later.",
//         showConfirmButton: true,
//       });
//     });

//   return true;
// }

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

  // Collect form data
  const first_name = document.getElementById("name").value.trim();
  const last_name = document.getElementById("last-name").value.trim();
  const username = document.getElementById("number").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  // Input validation
  if (!first_name || !last_name || !username || !email || !password) {
    Swal.fire({
      icon: "error",
      title: "Missing Fields",
      text: "Please fill out all fields.",
      showConfirmButton: true,
    });
    return;
  }

  // Make a fetch request to validate_register.php
  fetch("validate_register.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ first_name, last_name, username, email, password }),
  })
    .then((response) => response.json())
    .then((data) => {
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
          title: data.title,
          text: data.message,
          showConfirmButton: true,
        }).then(() => {
          window.location.href = "login.php"; // Redirect to login
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
}
