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
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard">
        <h1>Welcome to your Dashboard, <?php echo $_SESSION['username']; ?>!</h1>
        <p>You are logged in!</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
