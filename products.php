<?php
// Include the database connection file
include __DIR__ . '/db_connection/db_conn.php';

// Get the selected category (default to 'glass' if none is provided)
$category = isset($_GET['category']) ? $_GET['category'] : 'glass';

// Fetch products based on the selected category
$sql = "SELECT * FROM products WHERE type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Page</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="style.css" />

</head>

<body>
  <?php $activePage = 'products';
  include __DIR__ . '/components/header.php'; ?>

  <div class="services-page">
    <div class="imageservices">
      <div class="services-main">
        <h1>Our New Collection</h1>
        <p>
          Explore our range of high-quality products designed to suit all your
          needs.
        </p>
      </div>
    </div>

    <div class="main-section">
      <aside class="sidebar">
        <button class="tab <?php echo $category == 'glass' ? 'active' : ''; ?>" data-type="glass">Glass</button>
        <button class="tab <?php echo $category == 'mirror' ? 'active' : ''; ?>" data-type="mirror">Mirror</button>
      </aside>
    </div>

    <section class="product-grid">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="product-card" data-category="' . $row['type'] . '">';
          echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" />';
          echo '<h3>' . $row['name'] . '</h3>';
          echo '<a href="product-details.php?id=' . $row['id'] . '" class="details-button" style="text-decoration: none;">Learn more</a>';

          echo '</div>';
        }
      } else {
        echo '<p>No products found for the selected category.</p>';
      }
      ?>
    </section>
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
  <script src="./js/script.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>























































<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Page</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="/css/services.css" />

</head>

<body>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Luli Glass</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="header">
      <div style="z-index: 1000; padding-left: 20px; font-size: 20px">
        LULIGLASS
      </div>
      <div class="header-logo">
        <a href="index.php">
          <img src="./images/luli-glass.png" alt="Logo.jpg" />
        </a>
      </div>
      <div class="nav">
        <ul class="nav-list">
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php" class="active">Products</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>

      <div class="icons">
        <div class="dropdown">
          <i
            class="bi bi-person-fill dropdown-toggle"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            role="button"
            aria-haspopup="true"
            style="font-size: 1.5rem"></i>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="auth/login.php">Log in</a></li>
            <li>
              <a class="dropdown-item" href="auth/register.php">Register</a>
            </li>
          </ul>
        </div>
        <div class="position-relative">
          <i class="bi bi-cart-fill" style="font-size: 1.5rem"></i>
          <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
            id="itemCount"
            style="font-size: 0.75rem">
            0
          </span>
        </div>
      </div>
    </div>
  </body>

  <div class="services-page">

    <div class="imageservices">

      <div class="services-main">
        <h1>Our New Collection</h1>
        <p>
          Explore our range of high-quality products designed to suit all your
          needs.
        </p>
      </div>
    </div>

    <div class="main-section">
      <aside class="sidebar">
        <button class="tab active" data-type="glass">Glass</button>
        <button class="tab" data-type="mirror">Mirror</button>

      </aside>
    </div>

    <section class="product-grid">
      <div class="product-card" data-category="glass">
        <img src=./images/clearglass.jpg alt="Glass Product" class="glass" />
        <h3>Clear Glass </h3>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="glass">
        <img src="./images/GreyGlass.jpg" alt="Glass Product" />
        <h3>Grey Glass </h3>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="glass">
        <img src="./images/reflectiveglass.webp" alt="Glass Product" />
        <h3>Reflective Glass</h3>
        <p></p>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="glass">
        <img src="./images/frostedglass.webp" alt="Glass Product" />
        <h3>Frosted Glass</h3>
        <p></p>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="glass">
        <img src="https://via.placeholder.com/200" alt="Glass Product" />
        <h3>Glass Product #2</h3>
        <p>$220.00</p>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="glass">
        <img src="https://via.placeholder.com/200" alt="Glass Product" />
        <h3>Glass Product #2</h3>
        <p>$220.00</p>
        <button class="details-button">Learn more</button>
      </div>

      <div class="product-card" data-category="mirror" style="display: none">
        <img src="https://via.placeholder.com/200" alt="Mirror Product" />
        <h3>Mirror Product #1</h3>
        <p>$180.00</p>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="mirror" style="display: none">
        <img src="https://via.placeholder.com/200" alt="Mirror Product" />
        <h3>Mirror Product #2</h3>
        <p>$200.00</p>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="mirror" style="display: none">
        <img src="https://via.placeholder.com/200" alt="Mirror Product" />
        <h3>Mirror Product #1</h3>
        <p>$180.00</p>
        <button class="details-button">Learn more</button>
      </div>
      <div class="product-card" data-category="mirror" style="display: none">
        <img src="https://via.placeholder.com/200" alt="Mirror Product" />
        <h3>Mirror Product #2</h3>
        <p>$200.00</p>
        <button class="details-button">Learn more</button>
      </div>

    </section>
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



  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html> -->