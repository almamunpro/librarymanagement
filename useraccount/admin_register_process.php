<?php
include 'config.php'; // Ensure this file includes the database connection
session_start(); // Start session to store error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection and other vulnerabilities
    $admin_name = htmlspecialchars(trim($_POST['username'])); // Changed to admin_name
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Check if admin_name or email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM admin_user WHERE admin_name = ? OR email = ?");
    $stmt->bind_param("ss", $admin_name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin with the same admin_name or email already exists
        $user = $result->fetch_assoc();
        if ($user['admin_name'] == $admin_name) {
            $error_message = "Admin name already taken.";
        } else {
            $error_message = "Email already registered. Please login instead.";
        }
        $_SESSION['error_message'] = $error_message; // Store error message in session
        header("Location: admin_register.php"); // Redirect back to registration page
        exit();
    }

    // If no admin is found, insert the new admin into the database
    $stmt = $conn->prepare("INSERT INTO admin_user (admin_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $admin_name, $email, $password);

    if ($stmt->execute()) {
        // Registration successful, set up session variables and redirect to dashboard
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        // Handle insertion error
        $_SESSION['error_message'] = "Error registering admin. Please try again.";
        header("Location: admin_register.php"); // Redirect back to registration page
        exit();
    }
}
?>
