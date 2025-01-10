<?php
// Include the database connection file
include __DIR__ . '/db_connection/db_conn.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch the product details from the database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die('Product not found.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $product['name']; ?> - Product Details</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="./style.css" />
    <script>
        function calculatePrice() {
            const basePrice = <?php echo $product['price']; ?>;
            const height = document.querySelector('input[name="height"]').value;
            const width = document.querySelector('input[name="width"]').value;
            const thickness = document.querySelector('input[name="thickness"]').value || 1; // Default thickness is 1
            const borderRadius = document.querySelector('input[name="border_radius"]').value || 0;

            if (height && width) {
                const area = height * width;
                const price = basePrice + area * 0.05 + thickness * 10 + borderRadius * 0.5; // Example formula
                document.getElementById('price-display').innerText = Price: $$ {
                    price.toFixed(2)
                };
            } else {
                document.getElementById('price-display').innerText = "Price: $0.00";
            }
        }
    </script>
</head>

<body>
    <?php include __DIR__ . '/components/header.php'; ?>

    <div class="product-container">
        <div class="product-container2">
            <div class="product-image-section">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" />
            </div>

            <div class="product-details-section">
                <h1><?php echo $product['name']; ?></h1>
                <!-- <p id="price-display">Price: $<?php echo number_format($product['price'], 2); ?></p> -->
                <div style="display: flex; flex-direction: column">
                    <form action="submit-order.php" method="POST" oninput="calculatePrice()">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />

                        <!-- Shape Selection -->
                        <div class="shape-selection">
                            <h4>Choose Your Shape</h4>
                            <div class="shape-options">
                                <label class="shape-option">
                                    <input type="radio" name="shape" value="rectangle" checked />
                                    Rectangle
                                </label>
                                <label class="shape-option">
                                    <input type="radio" name="shape" value="round" />
                                    Round
                                </label>
                                <label class="shape-option">
                                    <input type="radio" name="shape" value="oval" />
                                    Oval
                                </label>
                                <label class="shape-option">
                                    <input type="radio" name="shape" value="square" />
                                    Square
                                </label>
                            </div>
                        </div>

                        <!-- Dimensions -->
                        <div class="dimension-selection">
                            <h4>Select Dimensions</h4>
                            <p>Cutting tolerance is within 1/8"</p>

                            <!-- Height Inputs -->
                            <div class="dimension-input">
                                <label for="height-meters">Height</label>
                                <div class="dimension-group">
                                    <input type="number" name="height-meters" min="0" placeholder="Meters" />
                                    <input type="number" name="height-centimeters" min="0" max="99" placeholder="Cm" />
                                    <input type="number" name="height-millimeters" min="0" max="999" placeholder="Mm" />
                                </div>

                            </div>

                            <!-- Width Inputs -->
                            <div class="dimension-input">
                                <label for="width-meters">Width</label>
                                <div class="dimension-group">
                                    <input type="number" name="width-meters" min="0" placeholder="Meters" />
                                    <input type="number" name="width-centimeters" min="0" max="99" placeholder="Cm" />
                                    <input type="number" name="width-millimeters" min="0" max="999" placeholder="Mm" />
                                </div>

                            </div>
                        </div>
                        <div class="dimension-input">
                            <label for="thickness">Thickness (mm)</label>
                            <input type="number" name="thickness" min="1" />
                        </div>
                        <div class="dimension-input">
                            <label for="border_radius">Border Radius (mm)</label>
                            <input type="number" name="border_radius" min="0" />
                        </div>
                        <div class="price-container">
                            <label for="price-display">Price</label>
                            <div class="price-box">
                                <span id="price-display" class="current-price">Price: $0.00</span>
                            </div>
                        </div>


                        <!-- Submit -->
                        <button type="submit" class="add-to-cart-button" style="margin-top: 40px;">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2024 Luli Glass. All Rights Reserved.</p>
    </footer>
    <script src="./js/script.js"></script>
</body>

</html>

<?php
$conn->close();
?>