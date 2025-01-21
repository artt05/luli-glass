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
  <title>Product Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  $activePage = 'products';
  include __DIR__ . '/components/header.php';
  ?>

  <div class="services-page">
    <div class="imageservices">
      <div class="services-main">
        <h1>Our New Collection</h1>
        <p>Explore our range of high-quality products designed to suit all your needs.</p>
      </div>
    </div>

    <div class="main-section">
      <h2 style="text-align: center; margin-bottom: 20px;">Glass</h2>
    </div>
    <section class="product-grid">
      <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
          <a href="product-details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product-card-link" style="text-decoration: none;">
            <div class="product-card" data-category="<?php echo htmlspecialchars($product['type']); ?>">
              <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
              <h3><?php echo htmlspecialchars($product['name']); ?></h3>
              <a href="product-details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="details-button" style="text-decoration: none;">Learn more</a>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No products available.</p>
      <?php endif; ?>
    </section>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>