<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];
    $date = $_POST['date'];
    $timing = $_POST['timing'];
    $seatsStr = $_POST['seats'];
    $seatNumbers = explode(",", $seatsStr);

    // Insert into bookings table
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_id, seats, booking_date, timing) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $user_id, $movie_id, $seatsStr, $date, $timing);

    if ($stmt->execute()) {
        // Update each seat as booked in seats table
        foreach ($seatNumbers as $seatNumber) {
            $stmt2 = $conn->prepare("UPDATE seats SET status = 'booked' WHERE seat_number = ? AND show_date = ? AND timing = ?");
            $stmt2->bind_param("iss", $seatNumber, $date, $timing);
            $stmt2->execute();
        }

        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
