<?php
require 'config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $selectedSeats = json_decode($_POST['selectedSeats'], true);
    $totalPrice = (int) $_POST['totalPrice'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert booking details
        $stmt = $conn->prepare("INSERT INTO bookings (title, total_price) VALUES (?, ?)");
        $stmt->bind_param("si", $title, $totalPrice);
        $stmt->execute();
        $bookingId = $conn->insert_id;

        // Update seats
        $seatUpdateStmt = $conn->prepare("UPDATE seats SET status = 'occupied' WHERE id = ?");
        foreach ($selectedSeats as $seatId) {
            $seatUpdateStmt->bind_param("i", $seatId);
            $seatUpdateStmt->execute();
        }

        // Commit transaction
        $conn->commit();
        echo "Booking Confirmed! Booking ID: $bookingId";
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
