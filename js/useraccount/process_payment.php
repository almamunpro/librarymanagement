<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'vendor/autoload.php'; // Ensure you have included Composer's autoload file
\Stripe\Stripe::setApiKey('YOUR_SECRET_KEY');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    $cartItems = json_decode($_POST['cartItems'], true); // Assuming cartItems are sent as JSON string in a hidden input

    $token = $_POST['stripeToken'];

    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100, // Amount in cents
            'currency' => 'usd',
            'description' => 'Book Rental Payment',
            'source' => $token,
        ]);

        // Insert order into orders table
        $stmt = $conn->prepare("INSERT INTO orders (username, name, address, phone, amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $username, $name, $address, $phone, $amount);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Insert each cart item into order_items table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, title, imgSrc, rentalDays) VALUES (?, ?, ?, ?)");
        foreach ($cartItems as $item) {
            $stmt->bind_param("isss", $order_id, $item['title'], $item['imgSrc'], $item['rentalDays']);
            $stmt->execute();
        }
        $stmt->close();

        // Clear the cart after order is placed
        echo "<script>sessionStorage.removeItem('cartItems');</script>";

        // Redirect to a success page
        header("Location: success.php");
        exit();
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$conn->close();
?>
