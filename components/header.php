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