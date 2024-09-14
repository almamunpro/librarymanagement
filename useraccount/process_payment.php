
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
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
    $amount = $_POST['totalAmount']; // The amount is now passed as 'totalAmount'

    $token = $_POST['stripeToken'];
    $cartItems = json_decode($_POST['cartItems'], true); // Assuming cartItems are sent as JSON string

    // Calculate rental days based on the amount (e.g., $10 per day)
    $rentalDays = $amount / 10;

    // Validate inputs
    if (empty($name) || empty($address) || empty($phone) || empty($amount)) {
        die('Please complete all required fields.');
    }

    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        die('Please enter a valid phone number.');
    }

    try {
        // Process payment through Stripe
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100, // Amount in cents
            'currency' => 'usd',
            'description' => 'Book Rental Payment',
            'source' => $token,
        ]);

        // Insert order into the orders table
        $stmt = $conn->prepare("INSERT INTO orders (username, name, address, phone, amount, rentalDays) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdi", $username, $name, $address, $phone, $amount, $rentalDays);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Insert each cart item into the order_items table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, title, imgSrc, rentalDays) VALUES (?, ?, ?, ?)");
        foreach ($cartItems as $item) {
            $stmt->bind_param("isss", $order_id, $item['title'], $item['imgSrc'], $rentalDays);
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
