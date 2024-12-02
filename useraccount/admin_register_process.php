<?php
session_start();
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $id = htmlspecialchars(trim($_POST['id']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the provided ID matches 25416
    $requiredAdminCode = "25416";
    if ($id !== $requiredAdminCode) {
        $_SESSION['error_message'] = "Invalid admin code.";
        header("Location: admin_register.php");
        exit();
    }

    // Prepare SQL statement to check if the username or email already exists
    $stmt = $conn->prepare("SELECT * FROM admin_user WHERE admin_name = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Username or email already exists.";
        header("Location: admin_register.php");
        exit();
    }

    // Insert new admin into the database if the username/email does not exist
    $stmt = $conn->prepare("INSERT INTO admin_user (admin_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Registration successful. You can now log in.";
        header("Location: admin_login.php");
    } else {
        $_SESSION['error_message'] = "Registration failed. Please try again.";
        header("Location: admin_register.php");
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
