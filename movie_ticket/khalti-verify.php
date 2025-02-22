<?php
if (isset($_GET['pidx'])) {
    $pidx = $_GET['pidx']; // Payment ID from Khalti

    // Khalti Payment Verification URL
    $verifyUrl = "https://khalti.com/api/v2/payment/verify/";

    // Secret Key 
    $secretKey = "68791341fdd94846a146f0457ff7b455"; 
 

    // Prepare verification data
    $data = array("pidx" => $pidx);

    // Convert data to JSON
    $jsonData = json_encode($data);

    // Initialize cURL session
    $ch = curl_init($verifyUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Key $secretKey",
        "Content-Type: application/json"
    ));

    // Execute cURL request and get response
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response
    $responseData = json_decode($response, true);

    if (isset($responseData['status']) && $responseData['status'] == "Completed") {
        echo "Payment Successful!";
        // Store booking details in the database
    } else {
        echo "Payment Verification Failed!";
    }
} else {
    echo "Invalid request!";
}
?>
