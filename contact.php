<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- Bootstrap Icons: This link imports a collection of SVG-based icons from the Bootstrap Icons library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
</head>

<body class="aldrich-regular">
  <?php $activePage = 'contact';
  include __DIR__ . '/components/header.php'; ?>

  <div class="hero">
    <h1>Contact Us</h1>
    <h2>We're Here to Help</h2>
    <p>Got any questions about the products? We're here to help. Chat to our friendly team 24/7 and get onboard in less
      than 5 minutes.</p>
  </div>

  <div class="contact-container">
    <!-- Contact Form Section -->
    <div class="form-section">
      <div class="contact-form">
        <h1>Contact our team</h1>
        <div style="padding-bottom: 15px;">Request a quote for installation or ask a question</div>

        <p>Call our team Mon-Fri from 8am to 5pm.</p>
        <button>049 800 800</button>
        <div class="form-group">
          <form onsubmit="sendContactEmail(event)" method="POST">
            <label for="full-name">Full name</label>
            <input
              type="text"
              id="full-name"
              name="full-name"
              placeholder="Full name"
              required />



            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email" required />

            <label for="phoneNumber">Phone number</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required />

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    <!-- Contact Info Section -->
    <div class="contact-info">


      <div class="chat-options">
        <img class="contact-img" src="./images/multipleglass.jpg" alt="">
      </div>



      <h3 style="padding-top: 15px">Visit us</h3>
      <p>Chat to us in person at our HQ.</p>
      <button>Prishtinë, Lorem Ipsum</button>
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