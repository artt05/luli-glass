<?php
session_start();

// Include database connection
require_once 'db_connection/db_conn.php'; // Ensure this points to your database connection file

$isLoggedIn = false; // Default value

// Check if the session contains user_id
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Query to check if the user_id exists in the database
    $query = "SELECT COUNT(*) FROM users WHERE id = ?";
    $stmt = $conn->prepare($query); // Use the MySQLi connection variable
    $stmt->bind_param("i", $userId); // Bind the user_id parameter as an integer
    $stmt->execute();
    $stmt->bind_result($userExists);
    $stmt->fetch();
    $stmt->close();

    if ($userExists) {
        $isLoggedIn = true; // User exists in the database
    } else {
        unset($_SESSION['user_id']); // Invalid session
    }
}
if ($userId) {
    $query = "
        SELECT 
            od.product_id AS id,
            od.quantity,
            od.price,
            p.name AS name,
            p.image_url AS image
        FROM 
            order_details od
        JOIN 
            products p
        ON 
            od.product_id = p.id
        WHERE 
            od.userinfo_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch items and populate session cart
    while ($row = $result->fetch_assoc()) {
        // Ensure all fields are stored in the session cart
        $_SESSION['cart'][$row['id']] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'image' => $row['image'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
        ];
    }
    $stmt->close();
}


?>
<script>
    // Pass the PHP login status to JavaScript
    const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    console.log("Is user logged in?", isLoggedIn);
</script>

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
    <link rel="stylesheet" href="css/checkout.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
</head>

<body class="aldrich-regular">
    <?php $activePage = 'contact';
    include __DIR__ . '/components/header.php'; ?>

    <div class="d-flex flex-column">
        <div class="container">
            <div class="form-container">
                <h2>Order Information</h2>
                <form id="orderForm" action="backend/process_order.php" method="POST" class="form-section">
                    <div class="grid-container" style="width:100%">
                        <div class="input-group">
                            <label for="firstName">First Name*</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                        </div>
                        <div class="input-group">
                            <label for="lastName">Last Name*</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                        </div>
                        <div class="input-group">
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-group">
                            <label for="phone">Phone Number*</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                            <span id="phoneError" class="text-danger"></span>
                        </div>
                        <div class="input-group">
                            <label for="country">Country*</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>
                        </div>
                        <div class="input-group">
                            <label for="city">City*</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                        </div>
                        <div class="input-group">
                            <label for="postalCode">Postal Code*</label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Postal Code" required>
                            <span id="postalCodeError" class="text-danger"></span>
                        </div>
                        <div class="input-group">
                            <label for="address">Address*</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        </div>
                    </div>
            </div>

            <div class="checkout-wrapper">
                <div class="cart-section">
                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                        <h2>Your Shopping Cart</h2>
                        <table class="table">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            <?php
                            $totalPrice = 0;
                            $totalQuantity = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $totalQuantity += intval($item['quantity']);
                                $totalPrice += $item['price'];
                            ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($item['image'] ?? 'images/default-image.jpg') ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?>" width="50"></td>

                                    <td><?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?></td>

                                    <td>$<?= $item['price'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                </tr>
                                <input type="hidden" name="cart[<?= $item['id'] ?>][name]" value="<?= $item['name'] ?>">
                                <input type="hidden" name="cart[<?= $item['id'] ?>][price]" value="<?= $item['price'] ?>">
                                <input type="hidden" name="cart[<?= $item['id'] ?>][quantity]" value="<?= $item['quantity'] ?>">
                                <input type="hidden" name="cart[<?= $item['id'] ?>][image]" value="<?= $item['image'] ?>">
                            <?php } ?>
                        </table>
                </div>
                <div class="total-section mt-3">
                    <h5>Total Quantity:</h5>
                    <h5 class="text-end"><?= $totalQuantity ?></h5>
                    <input type="hidden" name="total_quantity" value="<?= $totalQuantity ?>">

                    <h5>Total Price:</h5>
                    <h5 class="text-end">$<?= number_format($totalPrice, 2) ?></h5>
                    <input type="hidden" name="total_price" value="<?= $totalPrice ?>">

                    <button type="button" class="btn btn-primary mt-3" style="grid-column: span 2; padding:10px 0px">
                        Go to Payment
                    </button>
                </div>

            <?php else: ?>
                <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100%; min-height: 300px;">
                    <img src="../images/shopping_cart_empty.webp" alt="Empty Cart" style="width: 200px; height: auto;">

                    <p style="font-size: 20px;">Your cart is empty.</p>
                </div>
            <?php endif; ?>

            </form>
            </div>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/script.js"></script>
    <script src="./js/checkout.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const checkoutButton = document.querySelector(".btn-primary");
            const orderForm = document.getElementById("orderForm");

            if (!checkoutButton) {
                console.error("Checkout button not found! Ensure it has the correct class or ID.");
                return;
            }

            checkoutButton.addEventListener("click", (event) => {
                event.preventDefault();

                const formValid = orderForm.checkValidity();
                console.log("Form valid state:", formValid);

                if (!formValid) {
                    Swal.fire({
                        title: "Please fill out all required fields!",
                        icon: "warning",
                        confirmButtonText: "OK",
                        confirmButtonColor: "rgb(86 204 255)"
                    });
                    orderForm.reportValidity();
                    return;
                }

                console.log("Checkout button clicked. Is user logged in?", isLoggedIn);

                if (isLoggedIn) {
                    window.location.href = "/luli-glass/payment.php";
                } else {


                    Swal.fire({
                        title: "You must be logged in to proceed with the payment",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Login",
                        confirmButtonColor: "rgb(86 204 255)",
                        cancelButtonText: "Register",
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/luli-glass/auth/login.php";
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = "/luli-glass/auth/register.php";
                        }
                    });

                }
            });
        });
    </script>
</body>

</html>