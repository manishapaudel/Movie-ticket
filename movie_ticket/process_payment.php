<?php
header('Content-Type: application/json');
include 'config.php'; // Database connection

// Receive data from the front-end (Khalti payment success payload)
$data = json_decode(file_get_contents('php://input'), true);

// Ensure valid data was received
if ($data) {
    try {
        // Extract data
        $payment_id = $data['payment']['payment_id'];
        $amount = $data['payment']['amount'] / 100; // Convert paisa to main currency
        $selectedSeats = json_decode($_POST['selectedSeats'], true);
        $bookingDate = $_POST['bookingDate'];

        // Start transaction
        $conn->beginTransaction();

        // Save payment details in the database
        $stmt = $conn->prepare("INSERT INTO payments (payment_id, amount, booking_date) VALUES (?, ?, ?)");
        $stmt->execute([$payment_id, $amount, $bookingDate]);

        // Update seat statuses to 'occupied'
        foreach ($selectedSeats as $seat_id) {
            $stmt = $conn->prepare("UPDATE seats SET status = 'occupied' WHERE id = ?");
            $stmt->execute([$seat_id]);
        }

        // Commit transaction
        $conn->commit();

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Rollback transaction if something goes wrong
        $conn->rollBack();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data received']);
}
?>
