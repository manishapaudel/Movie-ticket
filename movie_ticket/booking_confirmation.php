<?php
session_start();

// Include your database configuration file
include 'config.php';

// Check if booking details are set (replace with actual verification logic if required)
if (!isset($_SESSION['booking_details'])) {
    header("Location: index.php"); // Redirect to the main page if no booking details
    exit();
}

// Retrieve booking details from the session
$bookingDetails = $_SESSION['booking_details'];

// Clear session booking details (optional)
unset($_SESSION['booking_details']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }
        .confirmation-container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h1 {
            color: #22c55e;
            margin-bottom: 10px;
            font-size: 24px;
            animation: bounceIn 1s ease-out;
        }
        @keyframes bounceIn {
            0% {
                transform: scale(0.9);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        p {
            color: #333;
            margin: 10px 0;
            font-size: 16px;
        }
        .button-container {
            margin-top: 20px;
        }
        a {
            display: inline-block;
            padding: 12px 25px;
            background: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        a:hover {
            background: #2563eb;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
        }
        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 1s ease-out;
        }
        @keyframes scaleIn {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
        .icon svg {
            width: 40px;
            height: 40px;
            fill: #ffffff;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1.2 15L6 12.2l1.4-1.4L10.8 14l6.8-6.8 1.4 1.4-8.2 8.4z"/>
        </svg>
    </div>
    <h1>Booking Confirmed!</h1>
    <p>Thank you for your booking. Here are your details:</p>
    <p><strong>Seats:</strong> <?php echo implode(", ", $bookingDetails['seats']); ?></p>
    <p><strong>Total Price:</strong> ₹<?php echo number_format($bookingDetails['total_price'], 2); ?></p>
    <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($bookingDetails['date']); ?></p>
    <div class="button-container">
        <a href="index.php">Back to Home</a>
    </div>
</div>

</body>
</html>
