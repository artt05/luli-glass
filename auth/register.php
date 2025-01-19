<?php
// Database connection
require_once '../db_connection/db_conn.php'; // Include database connection
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data and sanitize inputs
  $first_name = $conn->real_escape_string($_POST['first_name']);
  $last_name = $conn->real_escape_string($_POST['last_name']);
  $email = $conn->real_escape_string($_POST['email']);
  $username = $conn->real_escape_string($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
  $created_at = date("Y-m-d H:i:s"); // Get current timestamp

  // SQL query to insert data into the users table
  $sql = "INSERT INTO users (first_name, last_name, email, username, password, created_at) 
            VALUES ('$first_name', '$last_name', '$email', '$username', '$password', '$created_at')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Registration successful!');
            window.location.href = 'login.php'; // Redirect to login page
            </script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet" />
  <!-- Import Bootstrap CSS for styling and responsiveness -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Import Swiper CSS for creating responsive sliders -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Link to custom stylesheet for additional styles -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Main container for the registration form and image slider -->
  <div class="register">
    <!-- Registration form with various input fields -->
    <form
      id="registrationForm"
      class="register-con"
      style="width: 50%"
      method="POST"
      action="register.php">
      <!-- Branding header with company name -->
      <div class="noble">
        <img src="../images/luli-glass.png" style="width: 150px; height: 150px" />
      </div>

      <!-- Section for sign-up title and navigation link to log in page -->
      <div class="signUp">
        <h1>Sign up</h1>
        <p>Already have an account? <a href="login.php">Sign in</a></p>
      </div>

      <div class="form-groups">
        <!-- Input field for the user's first name -->
        <div class="form-group">
          <input
            type="text"
            id="name"
            name="first_name"
            placeholder="Name*"
            required />
          <span id="nameError" class="error"></span>
        </div>

        <!-- Input field for the user's last name -->
        <div class="form-group">
          <input
            type="text"
            id="last-name"
            name="last_name"
            placeholder="Last name*"
            required />
          <span id="lastnameError" class="error"></span>
        </div>

        <!-- Input field for the user's phone number -->
        <div class="form-group">
          <input
            type="text"
            id="number"
            name="username"
            placeholder="Phone number*"
            required />
          <span id="numberError" class="error"></span>
        </div>

        <!-- Input field for the user's email address -->
        <div class="form-group">
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Email Address*"
            required />
          <span id="emailError" class="error"></span>
        </div>

        <!-- Input field for the user's password -->
        <div class="form-group">
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Password*"
            required />
          <span id="passwordError" class="error"></span>
        </div>
      </div>
      <!-- Submit button for the registration form -->
      <button class="submit" type="submit">Sign up</button>

      <!-- Link to navigate back to the home page -->
      <div class="backToHome"><a href="../index.php">Back to Home</a></div>
    </form>


    <!-- Image slider with background images -->
    <div class="side-container register-image" style="width: 50%">
      <div class="side-wrapper">
        <div
          class="side-image"
          style="background-image: url('../images/login.jpg')"></div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap JavaScript for functionality like dropdowns and modals -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>



  <!-- Custom JavaScript -->

  <script src="script.js"></script>
</body>

</html>