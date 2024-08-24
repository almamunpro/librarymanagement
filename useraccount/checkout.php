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

    

    <div id="totalAmountContainer">
        Total Amount: $<span id="totalAmount"></span>
        <input type="hidden" id="totalAmountHidden" name="totalAmount">
    </div>

    <button id="markItemsButton" onclick="toggleCheckboxes()">Mark Items</button>
    <button onclick="goToPayment()">Proceed to Payment</button> <!-- Payment Button -->

    <script src="scripts.js"></script> <!-- Include your JavaScript file -->
    <script>
        function updateAmount() {
            let rentalDays = document.getElementById('rentalDays').value;
            let baseAmount = calculateBaseAmount(); // Your existing logic to calculate base amount
            let totalAmount = rentalDays * baseAmount;

            document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
            document.getElementById('totalAmountHidden').value = totalAmount.toFixed(2);

            // Store rental days and total amount in sessionStorage
            sessionStorage.setItem('rentalDays', rentalDays);
            sessionStorage.setItem('totalAmount', totalAmount.toFixed(2));
        }

        function goToPayment() {
            window.location.href = "payment.php";
        }

        // Initial calculation on page load
        document.addEventListener("DOMContentLoaded", function() {
            updateAmount();
        });
    </script>
</body>
</html>
