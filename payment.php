<?php
session_start();

// Include database connection
require_once 'db_connection/db_conn.php'; // Ensure this points to your database connection file

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

    // If user does not exist in the database, unset the session
    if (!$userExists) {
        unset($_SESSION['user_id']);

        // Show SweetAlert for invalid session
        echo '<script>
                Swal.fire({
                    title: "Your session is invalid. Please log in again.",
                    icon: "warning",
                    confirmButtonText: "Login",
                    confirmButtonColor: "rgb(86 204 255)"
                }).then(() => {
                    window.location.href = "/luli-glass/auth/login.php";
                });
              </script>';
        exit();
    }
} else {
    // If no user_id in session, show SweetAlert for login
    echo '<script>
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
        </script>';
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment-Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/payment.css"> <!-- Benutzerdefinierte CSS-Datei für das Styling -->
</head>

<body>
    <div class="container">
        <!-- Zahlungsformular -->
        <form action="#" id="paymentForm">

            <div class="col">
                <h3 class="title">Payment</h3> <!-- Titel für das Zahlungsformular -->

                <!-- Abschnitt für akzeptierte Karten mit Bildern -->
                <div class="inputBox">
                    <label for="name">Card Accepted:</label>
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20240715140014/Online-Payment-Project.webp" alt="credit/debit card image">
                </div>

                <!-- Eingabefeld für den Namen auf der Karte -->
                <div class="inputBox">
                    <label for="cardName">Name On Card:</label>
                    <input type="text" id="cardName" placeholder="Enter card name" required>
                    <span class="error-message" id="cardNameError" style="color: red;"></span> <!-- Fehlermeldung -->
                </div>

                <!-- Eingabefeld für die Kreditkartennummer -->
                <div class="inputBox">
                    <label for="cardNum">Credit Card Number:</label>
                    <input type="text" id="cardNum" placeholder="1111-2222-3333-4444" maxlength="19" required>
                    <span class="error-message" id="cardNumError" style="color: red;"></span> <!-- Fehlermeldung -->
                </div>

                <!-- Dropdown für den Ablaufmonat -->
                <div class="inputBox">
                    <label for="expMonth">Exp Month:</label>
                    <select id="expMonth" required>
                        <option value="">Choose month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    <span class="error-message" id="expMonthError" style="color: red;"></span> <!-- Fehlermeldung -->
                </div>


                <div class="flex">
                    <!-- Dropdown für das Ablaufjahr -->
                    <div class="inputBox">
                        <label for="expYear">Exp Year:</label>
                        <select id="expYear" required>
                            <option value="">Choose Year</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                        </select>
                        <span class="error-message" id="expYearError" style="color: red;"></span> <!-- Fehlermeldung -->
                    </div>

                    <!-- Eingabefeld für die CVV -->
                    <div class="inputBox">
                        <label for="cvv">CVV</label>
                        <input type="number" id="cvv" placeholder="123" required>
                        <span class="error-message" id="cvvError" style="color: red;"></span> <!-- Fehlermeldung -->
                    </div>
                </div>

            </div>

            <!-- Abschicken-Button -->
            <input type="submit" value="Finish Payment" class="submit_btn" id="finishPaymentButton">

        </form> <!-- Ende des Zahlungsformulars -->
    </div>

    <!-- Zahlungsbestätigungs-Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel"> Payment Successful 🎉</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Thank you for your order! Your payment has been processed successfully.</p>
                    <p>Your order is being prepared and will be shipped soon. 🚚 </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="window.location.href='index.php';">Back to Home</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS und benutzerdefiniertes Skript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/checkout.js"></script>
</body>

</html>