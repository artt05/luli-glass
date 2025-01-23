<?php


// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../db_connection/db_conn.php';

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Calculate total items in the cart
$totalItems = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
}

// Initialize user name variable
$userFullName = null;

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Fetch user details
    $stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userFullName = $user['first_name'] . ' ' . $user['last_name'];
    }
    $stmt->close();
}

define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__))); // Path to your project's root directory
define('BASE_URL', '/luli-glass'); // Update this if the project is hosted in a subdirectory

?>
<style>
    @media screen and (max-width: 860px) {


        #mobileMenu {
            position: absolute;
            top: 12vh;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 100;
            display: none;
            padding: 10px;
            border-top: 1px solid;
        }

        #mobileMenu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #mobileMenu ul li a {
            text-decoration: none;
            color: black;
            display: block;
            padding: 10px;
        }
    }
</style>

<div class="header">
    <div id="mobileMenu" class="hidden">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
    <div class="header-text" style="z-index: 1000; padding-left: 20px; font-size: 20px">
        <a style="text-decoration: none; color:black;" href="index.php">
            LULIGLASS
        </a>
    </div>
    <div class="header-logo">
        <a href="index.php">
            <img src="<?php echo BASE_URL; ?>/images/luli-glass.png" alt="Logo.jpg" />
        </a>
    </div>

    <div class="nav">
        <ul class="nav-list">
            <li><a href="<?php echo BASE_URL; ?>/index.php" class="<?php echo $activePage == 'home' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/products.php" class="<?php echo $activePage == 'products' ? 'active' : ''; ?>">Products</a></li>
            <li>
                <a href="<?php echo (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') ? BASE_URL . '/admin/projects.php' : BASE_URL . '/projects.php'; ?>"
                    class="<?php echo $activePage == 'projects' ? 'active' : ''; ?>">
                    Projects
                </a>
            </li>
            <li><a href="<?php echo BASE_URL; ?>/about.php" class="<?php echo $activePage == 'about' ? 'active' : ''; ?>">About</a></li>
            <li><a href="<?php echo BASE_URL; ?>/contact.php" class="<?php echo $activePage == 'contact' ? 'active' : ''; ?>">Contact</a></li>
        </ul>
    </div>


    <div class="icons">
        <div class="dropdown">
            <?php if ($userFullName): ?>
                <!-- Display user's name if logged in -->
                <a class="dropdown-toggle" style="text-decoration: none; color: black; font-family: 'Inter', sans-serif; font-size: 18px" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($userFullName); ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="auth/logout.php">Logout</a></li>
                </ul>
            <?php else: ?>
                <!-- Default person icon if not logged in -->
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
            <?php endif; ?>
        </div>
        <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'): ?>
            <!-- Display cart icon only if the user is NOT an admin -->
            <div class="position-relative" id="cartIcon" style="cursor: pointer;" onclick="toggleCartMenu()">
                <i class="bi bi-cart-fill" style="font-size: 1.5rem"></i>
                <span
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="itemCount"
                    style="font-size: 0.75rem">
                    <?php echo $totalItems; ?>
                </span>
            </div>
        <?php endif; ?>






        <!-- Menu Icon (Visible in Mobile View) -->
        <div class="menu-icon" id="menuIcon" onclick="toggleMobileMenu()" style="cursor: pointer;">
            <img src="./images/toggle.svg" alt="Menu" style="width: 1.5rem; height: auto;" />
        </div>



        <!-- Product Menu Container -->
        <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'): ?>
            <div id="productMenu" class="product-menu hidden">
                <?php include 'productMenu.php'; ?>
            </div>
        <?php endif; ?>

    </div>

</div>



<script>
    function toggleMobileMenu() {
        console.log('Toggle icon clicked'); // Debugging log
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
            console.log('Show the menu');
            mobileMenu.style.display = 'block'; // Show the menu
        } else {
            console.log('Hide the menu');
            mobileMenu.style.display = 'none'; // Hide the menu
        }
    }
</script>