<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Luli Glass</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="./css/index.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Aldrich&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
</head>

<body class="aldrich-regular">
  <div class="header">
    <div style="z-index: 1000; padding-left: 20px; font-size: 20px;">LULIGLASS</div>
    <div class="header-logo">
      <a href="index.php">

        <img src="./images/luli-glass.png" alt="Logo.jpg" />
      </a>
    </div>
    <div class="nav">
      <ul class="nav-list aldrich-regular">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>


    <div class="icons">
      <!-- An icon (bi-person-fill) taken from Bootstrap activates a dropdown menu on click, providing options to "Log in" or "Register". -->
      <div class="dropdown">
        <i class="bi bi-person-fill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button"
          aria-haspopup="true" style="font-size: 1.5rem"></i>
        <ul class="dropdown-menu aldrich-regular">
          <li><a class="dropdown-item" href="./auth/login.php">Log in</a></li>
          <li><a class="dropdown-item" href="auth/register.php">Register</a></li>
        </ul>
      </div>
      <div class="position-relative">
        <!-- This class represents the shopping cart icon -->
        <i class="bi bi-cart-fill" style="font-size: 1.5rem"></i>
        <!-- This span serves as a badge to display the current number of items in the cart -->
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="itemCount"
          style="font-size: 0.75rem">
          0
        </span>
      </div>
    </div>

  </div>
  <div class="hero">
    <h1>Welcome to Luli Glass</h1>
    <h2>Your Trusted Glass Experts</h2>
    <p>Providing high-quality glass solutions for over 20 years.</p>
    <a href="contact.php" class="btn btn-primary hero-button aldrich-regular">Contact Us</a>
  </div>


  <div class="container">
    <h2>Our Services</h2>
    <section class="services">
      <div class="card">
        <div class="content">
          <div class="icon"><i class="fa fa-code"></i></div>
          <div class="title">Glass</div>
          <p>Premium glass solutions for homes and businesses, combining style and durability.</p>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <div class="icon"><i class="fa fa-mobile"></i></div>
          <div class="title">Mirror</div>
          <p>Custom mirrors crafted to enhance spaces with elegance and functionality.</p>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <div class="icon"><i class="fa fa-paint-brush"></i></div>
          <div class="title">Plastic </div>
          <p>High-quality plastic products tailored for versatile and reliable use.</p>
        </div>
      </div>

  </div>

  </div>
  </section>
  </div>

  <!-- 
  <div class="chakra-stack">
    <div>
        <p class="chakra-text">How It Works</p>
        <div class="chakra-text">It’s quite simple. Enter your measurements, choose your favorite glass tint, glass thickness, strength, edge style, etc., and check out your custom-designed glass table top.</div>
    </div>

    <div class="step">
        <div class="step-number">1</div>
        <img src="/path/to/design-specs-icon.svg" alt="Custom Design to Your Specs">
        <h2 class="chakra-heading">Custom Design to Your Specs</h2>
        <p class="chakra-text">There are no limits. We cut to your exact needs, from simple shapes to very complex projects.</p>
    </div>

    <div class="step">
        <div class="step-number">2</div>
        <img src="/path/to/support-icon.svg" alt="Technical & Design Support">
        <h2 class="chakra-heading">Technical & Design Support</h2>
        <p class="chakra-text">Our team is here to support you in all your questions to get you the right product to your exact needs. Live chat with us or email!</p>
    </div>

    <div class="step">
        <div class="step-number">3</div>
        <img src="/path/to/fabrication-icon.svg" alt="Fabrication & Quality Control">
        <h2 class="chakra-heading">Fabrication & Quality Control</h2>
        <p class="chakra-text">Our glass table tops are fabricated in our state-of-the-art plant in Manassas, VA. We guarantee 100% premium quality at all times.</p>
        <a class="button" href="/path/to/video.mp4">
            <span>Take a Look Behind The Scene</span>
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M15 5l-1.41 1.41L18.17 11H2v2h16.17l-4.59 4.59L15 19l7-7-7-7z"></path></svg>
        </a>
    </div>

    <div class="step">
        <div class="step-number">4</div>
        <img src="/path/to/delivery-icon.svg" alt="Curbside Delivery">
        <h2 class="chakra-heading">Curbside, Contactless Delivery</h2>
        <p class="chakra-text">Your glass table top, hardware, and accessories are packed safely and curbside delivered by a FedEx carrier. All prices include FREE shipping.</p>
        <a class="button" href="/shipping-handling">
            <span>View Shipping and Handling</span>
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M15 5l-1.41 1.41L18.17 11H2v2h16.17l-4.59 4.59L15 19l7-7-7-7z"></path></svg>
        </a>
    </div>
</div>
 -->



  <section class="features">
    <div class="container">
      <h2>Why Choose Us?</h2>
      <div class="features">
        <div class="feature">
          <div class="icon-container">
            <img src="./images/window-svgrepo-com.svg" alt="Premium Quality Icon" class="feature-icon" />
          </div>
          <h3 class="feature-title">Premium Quality</h3>
          <p class="feature-description">Industrial-grade glass fiber fabric</p>
        </div>
        <div class="feature">
          <div class="icon-container">
            <img src="./images/security-svgrepo-com.svg" alt="Guaranteed Icon" class="feature-icon" />
          </div>
          <h3 class="feature-title">Guaranteed</h3>
          <p class="feature-description">Lifetime warranty on all products</p>
        </div>
        <div class="feature">
          <div class="icon-container">
            <img src="./images/shipping-truck-svgrepo-com.svg" alt="Fast Shipping Icon" class="feature-icon" />
          </div>
          <h3 class="feature-title">Fast Shipping</h3>
          <p class="feature-description">2-3 business days delivery</p>
        </div>
      </div>
    </div>
  </section>


  <section class="testimonials">
    <div class="testimonial-card">
      <div class="card-header">
        <div class="avatar" style="background: linear-gradient(135deg, #6ee7b7, #3b82f6);"></div>
        <div class="name">@John Doe</div>
      </div>
      <p>"Luli Glass provided exceptional service and quality products. Highly recommend!"</p>
    </div>

    <div class="testimonial-card">
      <div class="card-header">
        <div class="avatar" style="background: linear-gradient(135deg, #f87171, #a855f7);"></div>
        <div class="name">@Jane Smith</div>
      </div>
      <p>"The best glass products I've ever purchased. Great customer support too!"</p>
    </div>

    <div class="testimonial-card">
      <div class="card-header">
        <div class="avatar" style="background: linear-gradient(135deg, #34d399, #14b8a6);"></div>
        <div class="name">@Michael Brown</div>
      </div>
      <p>"Amazing craftsmanship and attention to detail. Will definitely buy again."</p>
    </div>
  </section>



  <!--Slider-->

  <div class="best-sellers" id="best-sellers">
    <div class="container swiper">
      <div class="slider-wrapper">
        <div class="card-wrapper swiper-wrapper">
          <div class="card swiper-slide">
            <div class="image-box one">
              <img src="./images/luli-glass.png" class="default-image" />
              <img src="./images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
          <div class="card swiper-slide">
            <div class="image-box two">
              <img src="./images/luli-glass.png" class="default-image" />
              <img src="./images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
          <div class="card swiper-slide">
            <div class="image-box three">
              <img src="/luli-glass/images/luli-glass.png" class="default-image" />
              <img src="/luli-glass/images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
          <div class="card swiper-slide">
            <div class="image-box four">
              <img src="/luli-glass/images/luli-glass.png" class="default-image" />
              <img src="/luli-glass/images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
          <div class="card swiper-slide">
            <div class="image-box five">
              <img src="./images/luli-glass.png" class="default-image" />
              <img src="./images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
          <div class="card swiper-slide">
            <div class="image-box six">
              <img src="./images/luli-glass.png" class="default-image" />
              <img src="./images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
          <div class="card swiper-slide">
            <div class="image-box seven">
              <img src="./images/luli-glass.png" class="default-image" />
              <img src="./images/black.jpg" class="hover-image" />
            </div>
            <div class="info">
              <div class="name">Text</div>
              <button type="button" class="btn btn-light view-button" onclick="view()">
                View
              </button>
            </div>
          </div>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </div>
  </div>


  <footer class="footerr">
    <div class="footer-containerr">
      <div class="footer-logo">
        <a href="index.php">
          <img src="images/luli-glass.png" alt="Luli Glass Logo" />
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
  <script src="./js/script.js"></script>
</body>

</html>