<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index">
    <div>
        <form action="send_reset_code.php" method="post">
            <h2>Forgot Password</h2>
            <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error_message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            if (isset($_SESSION['success_message'])) {
                echo '<div class="success_message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            ?>
            <input type="email" name="email" placeholder="Enter your registered email" required>
            <input type="submit" value="Send Reset Code">
        </form>
    </div>
</body>
</html>
