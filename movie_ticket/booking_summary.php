<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle booking confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedSeats = json_decode($_POST['selectedSeats'], true);
    $totalPrice = $_POST['totalPrice'];
    $bookingDate = $_POST['bookingDate'];

    if (!empty($selectedSeats) && !empty($bookingDate)) {
        // Insert booking into bookings table
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, selected_seats, total_price, booking_date) VALUES (?, ?, ?, ?)");
        $userId = 1; // Example user ID, adjust as needed
        $selectedSeatsStr = implode(",", $selectedSeats);
        $stmt->bind_param("isis", $userId, $selectedSeatsStr, $totalPrice, $bookingDate);
        $stmt->execute();

        // Update seat status
        foreach ($selectedSeats as $seatId) {
            $updateStmt = $conn->prepare("UPDATE seats SET status = 'occupied' WHERE id = ?");
            $updateStmt->bind_param("i", $seatId);
            $updateStmt->execute();
        }

        echo "<h1>Booking Confirmed!</h1>";
        echo "<p>Total Price: ₹$totalPrice</p>";
        echo "<p>Booking Date: $bookingDate</p>";
        echo "<p>Selected Seats: " . implode(", ", $selectedSeats) . "</p>";

        exit;
    }
}

// Fetch seat data
$result = $conn->query("SELECT * FROM seats");
$seatsData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seatsData[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seat Booking System</title>
  <style>
    .seat-container { margin: 20px; }
    .seats-row { display: flex; margin: 5px; justify-content: center; }
    .seat { width: 30px; height: 30px; margin: 5px; border: 1px solid #999; text-align: center; line-height: 30px; cursor: pointer; border-radius: 5px; }
    .available { background-color: #f1f1f1; }
    .occupied { background-color: #666; cursor: not-allowed; }
    .selected { background-color: #28a745; }
    .booking-summary { margin-top: 20px; padding: 15px; border: 1px solid #ccc; max-width: 400px; background-color: #f9f9f9; }
    .booking-summary button { padding: 10px 20px; background: #28a745; color: #fff; border: none; cursor: pointer; border-radius: 5px; }
  </style>
</head>
<body>

  <h1>Seat Booking System</h1>
  <div class="seat-container" id="seatContainer">
    <?php
      // Group seats by rows for rendering
      $rows = ['A', 'B'];
      foreach ($rows as $row) {
          echo '<div class="seats-row">';
          foreach ($seatsData as $seat) {
              if (strpos($seat['number'], $row) === 0) {
                  $class = $seat['status'] === 'available' ? 'available' : 'occupied';
                  echo "<div class='seat $class' 
                            data-id='{$seat['id']}' 
                            data-price='{$seat['price']}'>
                            {$seat['number']}
                        </div>";
              }
          }
          echo '</div>';
      }
    ?>
  </div>

  <div class="booking-summary">
    <h3>Booking Summary</h3>
    <p id="selectedSeatsText">Selected Seats: None</p>
    <p id="totalPriceText">Total Price: ₹0</p>
    <form action="" method="POST">
      <label for="bookingDate">Select Date:</label>
      <input type="date" id="bookingDate" name="bookingDate" required>
      <input type="hidden" id="selectedSeatsInput" name="selectedSeats">
      <input type="hidden" id="totalPriceInput" name="totalPrice">
      <br><br>
      <button type="submit">Confirm Booking</button>
    </form>
  </div>

  <script>
    let selectedSeats = [];
    let totalPrice = 0;

    document.querySelectorAll('.seat.available').forEach(seat => {
      seat.addEventListener('click', () => {
        const seatId = parseInt(seat.dataset.id);
        const price = parseInt(seat.dataset.price);

        seat.classList.toggle('selected');
        if (seat.classList.contains('selected')) {
          selectedSeats.push(seatId);
          totalPrice += price;
        } else {
          selectedSeats = selectedSeats.filter(id => id !== seatId);
          totalPrice -= price;
        }

        updateSummary();
      });
    });

    function updateSummary() {
      document.getElementById("selectedSeatsText").textContent =
        selectedSeats.length > 0 ? `Selected Seats: ${selectedSeats.join(", ")}` : "Selected Seats: None";
      document.getElementById("totalPriceText").textContent = `Total Price: ₹${totalPrice}`;
      document.getElementById("selectedSeatsInput").value = JSON.stringify(selectedSeats);
      document.getElementById("totalPriceInput").value = totalPrice;
    }
  </script>

</body>
</html>
