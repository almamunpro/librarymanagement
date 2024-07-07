<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body>
    <h1>Checkout</h1>

    <div class="cart-container" id="cartContainer">
        <!-- Cart items will be displayed here -->
    </div>

    <button onclick="calculateTotal()">Done</button>

    <div id="totalAmountContainer" style="display: none;">
        <!-- Total amount will be displayed here -->
    </div>

    <button id="markItemsButton" onclick="toggleCheckboxes()">Mark Items</button>

    <button onclick="goToPayment()">Proceed to Payment</button> <!-- Payment Button -->

    <script src="scripts.js"></script> <!-- Include your JavaScript file -->
    <script>
        function goToPayment() {
            window.location.href = "payment.php";
        }
    </script>
</body>
</html>
