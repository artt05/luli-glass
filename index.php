<?php
// Start session at the top of the file
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Include the database connection file
require_once __DIR__ . '/db_connection/db_conn.php';

// Debug database connection
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
} else {
  echo "<script>console.log('Database connection is active.');</script>";
}

// Debugging for logged-in user session
if (isset($_SESSION['user_id'])) {
  echo "<script>console.log('Logged-in User Data: " . json_encode($_SESSION['user_id']) . "');</script>";
} else {
  echo "<script>console.log('No user is logged in.');</script>";
}

// Fetch products based on the selected category
$category = 'glass'; // Default to 'glass'
$sql = "SELECT * FROM products WHERE type = ?";
echo "<script>console.log('Query: $sql with type = $category');</script>";

$stmt = $conn->prepare($sql);

if (!$stmt) {
  die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

// Debug the query and result
$products = [];
if ($result) {
  echo "<script>console.log('Query executed successfully.');</script>";
  if ($result->num_rows > 0) {
    echo "<script>console.log('Number of Products Found: {$result->num_rows}');</script>";
    while ($product = $result->fetch_assoc()) {
      $products[] = $product;
    }
    echo "<script>console.log('Products: ', " . json_encode($products) . ");</script>";
  } else {
    echo "<script>console.log('No products found for category: {$category}');</script>";
  }
} else {
  echo "<script>console.error('Query execution failed: " . $stmt->error . "');</script>";
}

?>
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


  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="style.css" />

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

  <?php $activePage = 'home';
  include __DIR__ . '/components/header.php'; ?>
  <div class="hero">
    <h1>Welcome to Luli Glass</h1>
    <h2>Your Trusted Glass Experts</h2>
    <p>Providing high-quality glass solutions for over 20 years.</p>
    <a href="contact.php" class="btn btn-primary hero-button aldrich-regular">Contact Us</a>
  </div>



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
          <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
              <div class="card swiper-slide">
                <div class="image-box">
                  <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="default-image" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                </div>
                <div class="info">
                  <div class="name"><?php echo htmlspecialchars($product['name']); ?></div>
                  <button type="button" class="btn btn-light view-button" onclick="location.href='product-details.php?id=<?php echo htmlspecialchars($product['id']); ?>'">
                    View
                  </button>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No products available.</p>
          <?php endif; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
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