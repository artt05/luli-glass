<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Log in</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet" />
  <!-- Linking Bootstrap CSS for styling -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Linking Swiper CSS for the image slider -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Linking custom stylesheet -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Log in form container -->
  <div class="log-in" style="width: 100% !important">
    <form
      id="loginForm"
      class="loginForm"
      style="width: 50%"
      onsubmit="validateLoginForm(event)">
      <!-- Logo and title -->
      <div class="noble">
        <a href="../index.php">
          <img
            src="../images/luli-glass.png"
            style="width: 150px; height: 150px" />
        </a>
      </div>
      <div class="signUp">
        <!-- Log in title and sign up link -->
        <h1>Log in</h1>
        <p>Don’t have an account? <a href="register.php">Sign up</a></p>
      </div>

      <div class="form-groups">
        <!-- Email input field -->
        <div class="form-group">
          <input type="email" id="email" placeholder="Email Address*" />
          <span id="emailError" class="error"></span>
        </div>

        <!-- Password input field -->
        <div class="form-group">
          <input type="password" id="password" placeholder="Password*" />
          <span id="passwordError" class="error"></span>
        </div>
      </div>

      <!-- Forgot password link -->
      <div class="forgot-pass-container">
        <div class="forgotPass">
          <a href="forgot-password.php">Forgot password?</a>
        </div>
      </div>

      <!-- Submit button for logging in -->
      <button class="submit" type="submit">Log in</button>
      <!-- Link back to the homepage -->
      <div class="backToHome"><a href="../index.php">Back to Home</a></div>
    </form>

    <!-- Image slider for the log-in page -->
    <div class="register-image" style="width: 50%">
      <div class="side-container" style="width: initial !important">
        <div class="side-wrapper">
          <div
            class="side-image"
            style="background-image: url('../images/login.jpg')"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Linking Bootstrap JS for interactivity -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- Linking Swiper JS for the image slider -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Custom JavaScript -->

  <script src="script.js"></script>
</body>

</html>