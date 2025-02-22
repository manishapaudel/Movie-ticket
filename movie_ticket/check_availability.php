<?php
include 'config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $show_date = $_POST['date']; // Get selected date

    // Fetch booked seats for the selected date
    $stmt = $conn->prepare("SELECT seats FROM bookings WHERE booking_date = ?");
    $stmt->bind_param("s", $show_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookedSeats = [];

    while ($row = $result->fetch_assoc()) {
        $seatNumbers = explode(',', $row['seats']); // Convert seat string to array
        foreach ($seatNumbers as $seat) {
            $bookedSeats[] = intval(trim($seat)); // Store booked seats as integers
        }
    }
    $stmt->close();
    $conn->close();

    // Redirect back to booking page with booked seats
    header("Location: index.php?date=$show_date&booked=" . implode(",", $bookedSeats));
    exit();
}
?>
