<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['username'] == $username) {
            $error_message = "Username already taken.";
        } else {
            $error_message = "Email already registered. <a href='login.php'>Login here</a>";
        }
        $_SESSION['error_message'] = $error_message;
        header("Location: register.php");
        exit();
    }

    // If no existing user is found, proceed with the registration
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Registration successful, set up session and redirect to dashboard
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        // Handle insertion error
        $_SESSION['error_message'] = "Error registering user. Please try again.";
        header("Location: register.php");
        exit();
    }
}
