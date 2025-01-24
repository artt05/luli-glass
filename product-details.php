<?php
// Start session at the top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once __DIR__ . '/db_connection/db_conn.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch the product details from the database

if ($product_id) {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die('Product not found.');
    }
} else {
    die('Product ID is missing in the URL.');
}



// Pass active page to header
$activePage = 'product-details';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./css/product-detail.css" />
    <link rel="stylesheet" href="./css/productMenu.css" />
</head>

<body>

    <?php include __DIR__ . '/components/header.php'; ?>

    <div class="product-container">
        <div class="product-container2">
            <!-- Image Section -->
            <div class="product-image-section" style="display: flex; flex-direction: column">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                <div style="font-size: 16px; padding-top: 10px">Delivery: Ships within 5 business days</div>
            </div>


            <!-- Details Section -->
            <div class="product-details-section">
                <h1><?php echo $product['name']; ?></h1>

                <div style="display: flex; flex-direction: column">
                    <form action="submit-order.php" method="POST" enctype="multipart/form-data" oninput="sendAjaxRequest()">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />


                        <div>


                            <!-- Second Section: Dimensions and Quantity -->
                            <div class="dimension-selection">
                                <h4>Select Dimensions</h4>


                                <div class="dimension-input">
                                    <label>Height</label>
                                    <div class="dimension-group">
                                        <input type="number" min="0" class="dimension" name="height-meters" placeholder="m" oninput="sendAjaxRequest()">
                                        <input type="number" min="0" class="dimension" name="height-centimeters" placeholder="cm" oninput="sendAjaxRequest()">
                                        <input type="number" min="0" class="dimension" name="height-millimeters" placeholder="mm" oninput="sendAjaxRequest()">
                                    </div>
                                </div>

                                <div class="dimension-input">
                                    <label>Width</label>
                                    <div class="dimension-group">
                                        <input type="number" min="0" class="dimension" name="width-meters" placeholder="m" oninput="sendAjaxRequest()">
                                        <input type="number" min="0" class="dimension" name="width-centimeters" placeholder="cm" oninput="sendAjaxRequest()">
                                        <input type="number" min="0" class="dimension" name="width-millimeters" placeholder="mm" oninput="sendAjaxRequest()">
                                    </div>
                                </div>

                                <div class="dimension-input">
                                    <label>Thickness </label>
                                    <input type="number" min="0" class="dimension" placeholder="mm" name="thickness" oninput="sendAjaxRequest()">
                                </div>

                                <div class="dimension-input">
                                    <label>Border Radius</label>
                                    <input type="number" min="0" class="dimension" placeholder="mm" name="border_radius" oninput="sendAjaxRequest()">
                                </div>

                                <div class="dimension-input">
                                    <label>Quantity </label>
                                    <input type="number" min="1" class="dimension" placeholder="pcs" name="quantity" placeholder="Enter quantity" oninput="sendAjaxRequest()">
                                </div>
                            </div>
                        </div>

                        <!-- Third Section: Additional Details and Submit -->
                        <div class="additional-details">
                            <h4>Additional Details</h4>
                            <textarea style="width: 70%;" name="additional_details" rows="4" placeholder="Enter any specific details or instructions"></textarea>

                            <!-- <form id="file-upload-form" method="POST" enctype="multipart/form-data" action="/upload">
                                <div class="file-upload">
                                    <label style="padding-bottom: 10px;">Upload File</label>
                                    <input type="file" name="custom_file[]" id="file-input" multiple />
                                    <ul id="file-list"></ul>
                                    <button type="submit">Upload Files</button>
                                </div>
                            </form> -->


                            <!-- Price Display -->
                            <div class="price-container">
                                <label for="price-display">Price</label>
                                <div class="price-box">
                                    <span id="price-display" class="current-price">$0.00</span>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <button type="button"
                                class="add-to-cart-button"
                                onclick="addToCart(
        <?php echo $product['id']; ?>,
        '<?php echo $product['name']; ?>',
        '<?php echo $product['image_url']; ?>',
        document.querySelector('input[name=quantity]').value,
        document.getElementById('price-display').innerText.replace('Price: $', '').trim(),
        document.querySelector('input[name=thickness]').value,
        (
            (parseFloat(document.querySelector('input[name=width-meters]').value || 0) * 1000) +
            (parseFloat(document.querySelector('input[name=width-centimeters]').value || 0) * 10) +
            (parseFloat(document.querySelector('input[name=width-millimeters]').value || 0))
        ),
        (
            (parseFloat(document.querySelector('input[name=height-meters]').value || 0) * 1000) +
            (parseFloat(document.querySelector('input[name=height-centimeters]').value || 0) * 10) +
            (parseFloat(document.querySelector('input[name=height-millimeters]').value || 0))
        ),
        document.querySelector('input[name=border_radius]').value
    );">
                                Add to Cart
                            </button>

                        </div>
                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/calculatePrice.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>

<?php
$conn->close();
?>