<?php
// Include the database connection
require_once __DIR__ . '/db_connection/db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve and sanitize form inputs
  $full_name = $conn->real_escape_string($_POST['full-name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone_number = $conn->real_escape_string($_POST['phoneNumber']);
  $message = $conn->real_escape_string($_POST['message']);

  // Insert the data into the contact_form table
  $sql = "INSERT INTO contact_form (full_name, email, phone_number, message) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("ssss", $full_name, $email, $phone_number, $message);

    if ($stmt->execute()) {
      echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thank you!',
                    text: 'Your message has been sent successfully.'
                });
            </script>";
    } else {
      echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong. Please try again later.'
                });
            </script>";
    }
    $stmt->close();
  } else {
    echo "Error: " . $conn->error;
  }

  // Close the database connection

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <?php $activePage = 'contact';
  include __DIR__ . '/components/header.php'; ?>

  <div class="hero">
    <h1>Contact Us</h1>
    <h2>We're Here to Help</h2>
    <p>Got any questions about the products? We're here to help. Chat to our friendly team 24/7 and get onboard in less
      than 5 minutes.</p>
  </div>

  <div class="contact-container">
    <div class="form-section">
      <div class="contact-form">
        <h1>Contact our team</h1>
        <div style="padding-bottom: 15px;">Request a quote for installation or ask a question</div>

        <form method="POST">
          <label for="full-name">Full name</label>
          <input type="text" id="full-name" name="full-name" placeholder="Full name" required />

          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Your email" required />

          <label for="phoneNumber">Phone number</label>
          <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Your phone number" required />

          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Message" rows="4" required></textarea>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    <!-- Contact Info Section -->
    <div class="contact-info">


      <div class="chat-options">
        <img class="contact-img" src="./images/multipleglass.jpg" alt="">
      </div>



      <p class="same-color" style="padding-top: 30px;"> Visit Us</p>
      <p> Address: Bernice, Kosovo near Amc Hall.</p>
      <!-- <button>Prishtinë, Lorem Ipsum</button> -->
      <p class="same-color">Call our team</p>

      <div>Tel: 049 800 800</div>

    </div>



  </div>
  <footer class="footerr">
    <div class="footer-containerr">
      <div class="footer-logo">
        <a href="index.php">
          <img src="./images/luli-glass.png" alt="Luli Glass Logo" />
        </a>
        <div class="footer-section contact">

          <p style="margin: 0px;"> <strong>Phone:</strong> 049 800 800</p>
          <p style="margin: 0px;">
            <strong>Mail:</strong>
            <a href="mailto:contact@support.com" style="color: white;">luliglass@gmail.com</a>
          </p>
          <p style="margin: 0px;">
            <strong>Address:</strong> Prishtinë
          </p>
        </div>
      </div>
      <div class="footer-nav">
        <div class="footer-section-links">
          <div style="font-size: 28px; padding-bottom: 10px">Other Pages</div>
          <div class="footer-links">
            <a href="#">Privacy & Policy</a>
            <a href="#">Terms of Use</a>
            <a href="#">Disclaimer</a>
            <a href="#">FAQ</a>
            </ul>
          </div>

        </div>

      </div>
      <div class="footer-social">
        <div class="footer-section-links">
          <div style="font-size: 28px;">Socials</div>
          <div class="footer-socials">
            <a href="#"><img src="images/facebook-svgrepo-com.png" alt="Facebook" /></a>

            <a href="#"><img src="images/instagram.png" alt="Instagram" style="width: 50px; height: 50px;" /></a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2024 Luli Glass. All Rights Reserved.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/script.js"></script>
</body>

</html>