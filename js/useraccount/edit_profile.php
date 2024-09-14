<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'config.php'; // Include your database connection

// Fetch user data from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];

    // Update user data in the database
    $update_query = "UPDATE users SET username = ?, email = ? WHERE username = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sss", $new_username, $new_email, $username);

    if ($update_stmt->execute()) {
        $_SESSION['username'] = $new_username;
        $_SESSION['success_message'] = "Profile updated successfully.";
        header("Location: edit_profile.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body class="index">
<!-- <nav class="navbar">
    <div class="navbar_left">
        <a href="/dashboard.php">Dashboard</a>
        <a href="book_type.php">Book Type</a>
        <a href="books_taken.php">Books Taken</a>
        <a href="add_book.php">Add New Book</a>
    </div>
    <div class="navbar_right">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</nav> -->
    
    <div class="edit_profile_container">
        <form action="edit_profile.php" method="post">
            <h2>Edit Profile</h2>
            <?php
            if (isset($_SESSION['success_message'])) {
                echo '<div class="success_message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error_message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="submit" value="Update Profile">
        <a  href="change_password.php" class="change-password-button">Change Password</a>
        <a href="/dashboard.php" class="back-button"> Back to the dashboard </a>
        </form>
    </div>

    <script src="script.js"></script> <!-- Include your JS file -->
    
</body>
</html>
