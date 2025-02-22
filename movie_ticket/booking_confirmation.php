<?php
include 'config.php';
session_start();

// Initialize variables (important to prevent undefined variable notices)
$title = $date = $timing = $language = $seats = "";
$totalAmount = 0;
$user_id = null; // Initialize user_id

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from $_POST, using isset() to check if each key exists
    

    // Get user_id from session (important for security)
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Handle the case where the user is not logged in.  
        // You might redirect them to the login page or display an error message.
        die("Error: User not logged in."); // Example: Stop execution
    }

    // *** Database Insertion ***
    try {
        $stmt = $conn->prepare("INSERT INTO bookings (title, date, timing, language, seats, amount, user_id) 
                              VALUES (:title, :date, :timing, :language, :seats, :amount, :user_id)");

        $stmt->execute([
            ':title' => $title,
            ':date' => $date,
            ':timing' => $timing,
            ':language' => $language,
            ':seats' => $seats,
            ':amount' => $totalAmount,
            ':user_id' => $user_id,
        ]);

        $booking_id = $conn->lastInsertId(); // Get the ID of the newly inserted booking

    } catch (PDOException $e) {
        // Handle database errors (log them, display a user-friendly message)
        error_log("Database Error: " . $e->getMessage()); // Log the error
        die("Error: Booking failed. Please try again."); // User-friendly message
    }


} else {
    die("Error: No POST data received.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>
<body>
    <div>
        <h2>Booking Confirmed!</h2>
        <p><strong>Movie Name:</strong> <?php echo $title; ?></p>
        <p><strong>Date:</strong> <?php echo $date; ?></p>
        <p><strong>Timing:</strong> <?php echo $timing; ?></p>
        <p><strong>Language:</strong> <?php echo $language; ?></p>
        <p><strong>Seats:</strong> <?php echo $seats; ?></p>
        <p><strong>Total Amount:</strong> NPR <?php echo $totalAmount; ?></p>
        <p><strong>Booking ID:</strong> <?php echo $booking_id; ?></p>  </div>
</body>
</html>