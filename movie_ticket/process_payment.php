<?php
// Khalti API credentials
$public_key = "YOUR_PUBLIC_KEY"; // Khalti public key
$secret_key = "YOUR_SECRET_KEY"; // Khalti secret key
$merchant_id = "YOUR_MERCHANT_ID"; // Your Khalti merchant id

// Collect form data
$date = $_POST['date'];
$timing = $_POST['timing'];
$language = $_POST['language'];
$seatsStr = $_POST['seats']; // Comma-separated seat numbers
$amount = $_POST['amount']; // Total amount

// Prepare the request data for Khalti API
$data = [
    'purchase_url' => 'https://www.khalti.com/checkout/#/payment/',  // This can be dynamically set to Khalti payment gateway
    'product_name' => 'Movie Ticket Booking', // Your product name (e.g., Movie Ticket)
    'amount' => $amount * 100, // Khalti expects the amount in paisa (100 paisa = 1 NPR)
    'mobile' => 'User Mobile Number', // Get the user's mobile number (e.g., from session or input)
    'merchant_id' => $merchant_id,
    'product_info' => 'Seats: ' . $seatsStr,
    'order_id' => uniqid("order_"),
    'callback_url' => "your-callback-url", // Specify the callback URL
];

// Send the data to Khalti using cURL
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = 'https://khalti.com/api/v2/payment/';

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Key ' . $secret_key,
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    // Execute cURL request
    $response = curl_exec($ch);
    $response_data = json_decode($response, true);

    // Check for successful response
    if (isset($response_data['payment_url'])) {
        header('Location: ' . $response_data['payment_url']);
        exit;
    } else {
        echo "Error in payment request.";
    }
}
?>
