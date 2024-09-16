<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index">
    <div>
        <form action="reset_process.php" method="post">
            <h2>Reset Your Password</h2>
            <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error_message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <input type="text" name="reset_code" placeholder="Enter reset code" required>
            <input type="password" name="new_password" placeholder="New password" required>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
