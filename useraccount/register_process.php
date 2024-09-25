<?php
include 'config.php'; // Ensure this file includes the database connection
session_start(); // Start session to store error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection and other vulnerabilities
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Check if username or email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User with same username or email already exists
        $user = $result->fetch_assoc();
        if ($user['username'] == $username) {
            $error_message = "Username already taken.";
        } else {
            $error_message = "Email already registered. <a href='login.php'>Login here</a>";
        }
        $_SESSION['error_message'] = $error_message; // Store error message in session
        header("Location: register.php"); // Redirect back to registration page
        exit();
    }

    // If no user is found, insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Registration successful, set up session variables and redirect to dashboard
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        // Handle insertion error
        $_SESSION['error_message'] = "Error registering user. Please try again.";
        header("Location: register.php"); // Redirect back to registration page
        exit();
    }
}
