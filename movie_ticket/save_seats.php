<?php
// save_seats.php
include 'config.php'; // Database connection file

// Get the raw POST data
$inputData = file_get_contents("php://input");
$data = json_decode($inputData, true);

// Check if data is valid
if (isset($data['selectedSeats']) && is_array($data['selectedSeats'])) {
    $selectedSeats = $data['selectedSeats'];
    
    try {
        // Begin a transaction to ensure atomicity
        $conn->beginTransaction();

        // Prepare the SQL update query
        $stmt = $conn->prepare("UPDATE seats SET status = :status WHERE id = :id");

        foreach ($selectedSeats as $seat) {
            $seatId = getSeatId($seat['row'], $seat['number'], $seat['type'], $conn); // Get seat ID based on row, number, and type
            if ($seatId) {
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':id', $seatId);

                // Set status to 'booked' for selected seats
                $status = 'booked';
                $stmt->execute();
            }
        }

        // Commit transaction
        $conn->commit();

        // Return success response
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Rollback transaction on error
        $conn->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}

// Function to get seat ID based on row, number, and type
function getSeatId($row, $number, $type, $conn) {
    $sql = "SELECT id FROM seats WHERE row = :row AND number = :number AND type = :type LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':row', $row);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['id'] : null;
}
?>
