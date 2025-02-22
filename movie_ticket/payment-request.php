<?php
include 'config.php';
session_start();

// Debugging: Check if 'data' is received
if (!isset($_GET['data']) || empty($_GET['data'])) {
    die("Error: No data received.");
}

// Decode Base64 and JSON
$decoded_data = json_decode(base64_decode($_GET['data']), true);

// Debugging: Check if decoding was successful
if ($decoded_data === null) {
    die("Error: Invalid JSON data - " . json_last_error_msg());
}

// Extract Data
$status = $decoded_data['status'] ?? null;
$user_id = $decoded_data['user_id'] ?? null;
$bookingid = $decoded_data['booking_id'] ?? null;
$amount = isset($decoded_data['amount']) ? intval($decoded_data['amount'] * 100) : 0;

// Check if required fields are present
if (!$user_id || !$bookingid || !$amount) {
    die("Error: Missing required data.");
}

// Database Queries Using Prepared Statements
try {
    // Get user email
    $stmt = $conn->prepare("SELECT email FROM users WHERE userid = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Get booking details
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $bookingid);
    $stmt->execute();
    $order_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} catch (Exception $e) {
    error_log("Database Error: " . $e->getMessage());
    die("Error: Unable to retrieve booking details.");
}

// Default User Info (Modify as needed)
$email = $user_result['email'] ?? 'no-email@example.com';
$name = "Guest User"; // Fetch from database if available
$phone = "9800000000"; // Fetch from database if available

// Khalti API Request Data
$postFields = array(
    "return_url" => "http://localhost/movie_ticket/payment-response.php",
    "website_url" => "http://localhost/movie_ticket",
    "amount" => $amount,
    "purchase_order_id" => "BOOKING_" . $bookingid,
    "purchase_order_name" => "Movie Ticket",
    "meta_data" => array(
        "booking_id" => $bookingid,
        "user_id" => $user_id
    )
);

// Convert Data to JSON
$jsonData = json_encode($postFields);

// Khalti API Call
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Key YOUR_KHALTI_SECRET_KEY', // Replace with your live key
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);
$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (curl_errno($curl)) {
    error_log('CURL Error: ' . curl_error($curl));
    die("Error: Payment request failed. Please try again.");
}

curl_close($curl);

// Handle Khalti Response
$responseArray = json_decode($response, true);

if ($http_status != 200 || isset($responseArray['error'])) {
    error_log("Khalti API Error: " . ($responseArray['error'] ?? "Unexpected error") . " - Response: " . $response);
    die("Error: Payment initiation failed. Please try again later.");
} elseif (isset($responseArray['payment_url'])) {
    header('Location: ' . $responseArray['payment_url']);
    exit();
} else {
    error_log("Unexpected Khalti Response: " . $response);
    die("Error: Payment initiation failed. Please try again later.");
}
?>
