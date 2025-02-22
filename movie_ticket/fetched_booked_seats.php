<?php
include 'config.php';

// Debug: Print received GET parameters
file_put_contents('debug_log.txt', print_r($_GET, true), FILE_APPEND);

if (!isset($_GET['show_date']) || empty($_GET['show_date'])) {
    echo json_encode(["error" => "Missing show_date parameter"]);
    exit;
}

$date = $_GET['show_date'];

$stmt = $conn->prepare("SELECT seat_number FROM seats WHERE status = 'booked' AND show_date = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$bookedSeats = [];
while ($row = $result->fetch_assoc()) {
    $bookedSeats[] = intval($row['seat_number']);
}

echo json_encode($bookedSeats);

$stmt->close();
$conn->close();
?>


