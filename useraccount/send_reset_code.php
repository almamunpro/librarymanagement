<?php
session_start();
include 'db_connection.php'; // Ensure this file connects properly to your database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email is registered
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a reset code and store it in the database
        $reset_code = bin2hex(random_bytes(16)); // Generate a random reset code
        $query = "UPDATE users SET reset_code = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $reset_code, $email);
        $stmt->execute();

        // Send reset code to the user's email
        $to = $email;
        $subject = "Password Reset Request";
        $message = "Your password reset code is: " . $reset_code . "\nPlease enter this code to reset your password.";
        $headers = "From: no-reply@example.com";

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['success_message'] = "A reset code has been sent to your email.";
            header('Location: reset_password.php'); // Redirect to the same page
        } else {
            $_SESSION['error_message'] = "Failed to send reset code. Please try again.";
            header('Location: forgot_password.php'); // Redirect to the same page
        }
        exit();
    } else {
        $_SESSION['error_message'] = "No account found with that email.";
        header('Location: forgot_password.php'); // Redirect to the same page
        exit();
    }
}
?>
