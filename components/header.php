<?php
// Start session at the top
session_start();

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Calculate total items in the cart
$totalItems = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
}
?>

<div class="header">
    <div class="header-text" style="z-index: 1000; padding-left: 20px; font-size: 20px">
        <a style="text-decoration: none; color:black;" href="index.php">
            LULIGLASS
        </a>
    </div>
    <div class="header-logo">
        <a href="index.php">
            <img src="./images/luli-glass.png" alt="Logo.jpg" />
        </a>
    </div>
    <div class="nav">
        <ul class="nav-list">
            <li><a href="index.php" class="<?php echo $activePage == 'home' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="products.php" class="<?php echo $activePage == 'products' ? 'active' : ''; ?>">Products</a></li>
            <li><a href="about.php" class="<?php echo $activePage == 'about' ? 'active' : ''; ?>">About</a></li>
            <li><a href="contact.php" class="<?php echo $activePage == 'contact' ? 'active' : ''; ?>">Contact</a></li>
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
                <li><a class="dropdown-item" href="auth/register.php">Register</a></li>
            </ul>
        </div>
        <div class="position-relative" id="cartIcon" style="cursor: pointer;" onclick="toggleCartMenu()">
            <i class="bi bi-cart-fill" style="font-size: 1.5rem"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                id="itemCount"
                style="font-size: 0.75rem">
                <?php echo $totalItems; ?>
            </span>
        </div>

        <!-- Menu Icon (Visible in Mobile View) -->
        <div class="menu-icon" id="menuIcon" onclick="toggleMobileMenu()" style="cursor: pointer;">
            <img src="./images/toggle.svg" alt="Menu" style="width: 1.5rem; height: auto;" />
        </div>

        <!-- Product Menu Container -->
        <div id="productMenu" class="product-menu hidden">
            <?php include 'productMenu.php'; ?>
        </div>
    </div>
</div>