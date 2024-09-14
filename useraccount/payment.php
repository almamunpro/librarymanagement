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
    <title>Payment</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="paymentContainer"> 
        <h1>Payment</h1>

        <form id="payment-form" action="process_payment.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="rentalDays">Rental Days:</label>
            <input type="text" id="rentalDays" name="rentalDays" readonly> <!-- Read-only field -->

            <label for="totalAmount">Amount:</label>
            <input type="text" id="totalAmount" name="totalAmount" readonly> <!-- Read-only field -->

            <!-- Include a hidden input for the Stripe token -->
            <input type="hidden" name="stripeToken" id="stripeToken">

            <button type="submit">Submit Payment</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fill the amount and calculate rentalDays
            let totalAmount = sessionStorage.getItem('totalAmount');

            if (totalAmount) {
                document.getElementById('totalAmount').value = totalAmount;

                // Calculate rental days as amount divided by 10
                let rentalDays = totalAmount / 10;
                document.getElementById('rentalDays').value = rentalDays;
            }
        });
    </script>
</body>
</html>
