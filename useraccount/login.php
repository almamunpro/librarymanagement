<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index">
    <div >
        <form action="login_process.php" method="post">
            <h2>Login</h2>
            <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error_message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <p>Don't have an account? <a class="reg" href="register.php">Register here</a></p>
            <a class="forget" href="forgot_password.php">Forgot Password?</a>
        </form>
        
    </div>
</body>
</html>
