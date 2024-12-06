// seats.php
<?php
require 'config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $showtimeId = $_GET['showtime_id'];

    $stmt = $conn->prepare("SELECT id, seat_number, status, price FROM seats WHERE showtime_id = ?");
    $stmt->bind_param("i", $showtimeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $seats = [];
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }

    echo json_encode($seats);
}
?>
