<?php
session_start();
include 'config.php'; // Ensure this file connects properly to your database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reset_code = $_POST['reset_code'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header('Location: reset_password.php'); // Redirect back to the form
        exit();
    }

    // Fetch user by reset code
    $query = "SELECT email FROM users WHERE reset_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $reset_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password and reset code
        $query = "UPDATE users SET password = ?, reset_code = NULL WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();

        $_SESSION['success_message'] = "Password has been reset successfully. You can now log in.";
        header('Location: login.php'); // Redirect to the login page
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid reset code.";
        header('Location: reset_password.php'); // Redirect back to the form
        exit();
    }
}
?>
