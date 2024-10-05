<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure you use the correct field name
    $admin_name = htmlspecialchars(trim($_POST['admin_name'])); // Changed from 'username'
    $password = $_POST['password'];

    // Prepare the SQL statement to check for admin_name
    $stmt = $conn->prepare("SELECT * FROM admin_user WHERE admin_name = ?");
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the admin data
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // If password is correct, set session and redirect to admin dashboard
            $_SESSION['admin_name'] = $user['admin_name']; // Store the admin name in session
            header("Location: /admin/uploads/admin.php"); // Updated redirection path
            exit();

        } else {
            // If password is incorrect, show error
            $_SESSION['error_message'] = "Invalid password.";
            header("Location: admin_login.php");
            exit();
        }
    } else {
        // If no user is found, show error
        $_SESSION['error_message'] = "No user found with that admin name.";
        header("Location: admin_login.php");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
