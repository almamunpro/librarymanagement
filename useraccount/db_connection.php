<?php
// Database credentials
$host = 'localhost'; // Your database host
$db = 'users'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password
$charset = 'utf8mb4'; // Character set

// Data Source Name (DSN) for PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // Disable emulation of prepared statements
];

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Handle connection error
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
