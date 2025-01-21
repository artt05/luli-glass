<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>
<link
  href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
  rel="stylesheet" />
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
  crossorigin="anonymous" />
<!-- Bootstrap Icons: This link imports a collection of SVG-based icons from the Bootstrap Icons library -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="style.css" />
<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }
</style>

<body>
  <?php $activePage = 'about';
  include __DIR__ . '/components/header.php'; ?>

  <div class="main-container-about">
    <div class="container1-about">
      <div class="text">
        <h2 style="color: #5ac9e5">How it started</h2>
        <h1 style="padding: 20px 0px">
          Our Dream is Global Learing Transformation
        </h1>
      </div>
      <div style="padding-bottom: 10px;">
        Luli Glass, founded over 25 years ago, focuses on creating high-quality glass solutions. They combine craftsmanship with innovation to redefine glass as a transformative element in design and functionality. </div>
      <div style="padding-bottom: 10px;">
        With over 10,000 projects completed, they have worked on residential spaces and large-scale commercial installations. Their commitment to energy efficiency, sustainability, and unique decorative designs has made them a trusted name in the glass industry. </div>
      <div style="padding-bottom: 10px;">
        With over 3,000 loyal clients and 5,000 positive reviews, Luli Glass continues to push the boundaries of glass and inspire spaces through innovative, reliable, and beautifully crafted glass solutions. </div>
    </div>

    <div class="container2-about">
      <div class="container2"></div>
      <div class="container2-1">
        <div class="box-container">
          <div class="about-box">
            <h1 class="about-box-title">10+</h1>
            <p>Years Experience</p>
          </div>
          <div class="about-box">
            <h1 class="about-box-title">1000+</h1>
            <p>Projects</p>
          </div>
          <div class="about-box">
            <h1 class="about-box-title">500+</h1>
            <p>Positive Reviews</p>
          </div>
          <div class="about-box">
            <h1 class="about-box-title">700+</h1>
            <p>Trusted Clients</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footerr">
    <div class="footer-containerr">
      <div class="footer-logo">
        <a href="index.php">
          <img src="/luli-glass/images/luli-glass.png" alt="Luli Glass Logo" />
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


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>