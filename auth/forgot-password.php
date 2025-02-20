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
  <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Linking Swiper CSS for the image slider -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Linking custom stylesheet -->
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="/auth/forgot-password.css" />
</head>

<body>
  <div class="register">
    <form id="registrationForm" onsubmit="validateForgotPasswordForm(event)">
      <div class="noble">
        <img
          src="../images/luli-glass.png"
          style="width: 150px; height: 150px" />
      </div>
      <div class="signUp">
        <h1>Forgot Password</h1>
        <p>
          Enter the email address associated with your account. We will send
          you an email with instructions for your new password.
        </p>
      </div>

      <div class="form-group">
        <input
          type="email"
          id="email"
          placeholder="Email Address*"
          required />
        <span id="emailError" class="error"></span>
      </div>

      <button type="submit">Send</button>

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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="script.js"></script>
</body>

</html>