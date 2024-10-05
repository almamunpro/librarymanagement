<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="index">
    <div>
        <form action="admin_login_process.php" method="post">
            <h2>Admin Login</h2>
            <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error_message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <!-- Change name from 'username' to 'admin_name' -->
            <input type="text" name="admin_name" placeholder="Admin Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <p>Don't have an account? <a class="reg" href="register.php">Register here</a></p>
            <a class="forget" href="forgot_password.php">Forgot Password?</a>
        </form>
    </div>
</body>
</html>
