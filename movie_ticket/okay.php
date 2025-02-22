<?php
include 'config.php';
session_start();

// Initialize booked seats array
$bookedSeats = [];

// Ticket price
$ticketPrice = 250; // Change this as needed

// Check if date is set in the request
if (isset($_POST['date'])) {
    $show_date = $_POST['date'];

    // Fetch booked seats for the selected date
    $stmt = $conn->prepare("SELECT seats FROM bookings WHERE booking_date = ?");
    $stmt->bind_param("s", $show_date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $seatNumbers = explode(',', $row['seats']); // Convert seat string to array
        foreach ($seatNumbers as $seat) {
            $bookedSeats[] = intval(trim($seat)); // Convert to integer and store
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Movie Ticket Booking</title>
    <style>
       body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          padding: 20px;
       }
       .container {
          max-width: 800px;
          margin: auto;
          background: #fff;
          padding: 20px;
          border-radius: 8px;
       }
       h1, h3 {
          color: #333;
       }
       label {
          display: block;
          margin-top: 10px;
       }
       input[type="date"],
       select {
          padding: 8px;
          margin-top: 5px;
          width: 200px;
       }
       /* Seat Map Grid */
       .seat-map {
          display: grid;
          grid-template-columns: repeat(8, 1fr);
          gap: 10px;
          margin: 20px 0;
       }
       .seat {
          background: #ddd;
          border: 1px solid #999;
          padding: 10px;
          text-align: center;
          cursor: pointer;
          border-radius: 4px;
       }
       .seat.selected {
          background: #6c6;
       }
       .seat.booked {
          background: #f66 !important;
          pointer-events: none;
          cursor: not-allowed;
       }
       button {
          padding: 10px 20px;
          background: #333;
          color: #fff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
       }
       button:hover {
          background: #555;
       }
       /* Legend for seat statuses */
       .seat-legend {
          display: flex;
          justify-content: space-around;
          margin-top: 20px;
       }
       .seat-legend div {
          display: flex;
          align-items: center;
          font-size: 14px;
       }
       .seat-legend div span {
          display: inline-block;
          width: 20px;
          height: 20px;
          margin-right: 5px;
          border: 1px solid #999;
       }
       .seat-legend .available {
          background: #ddd;
       }
       .seat-legend .booked {
          background: #f66;
       }
    </style>
</head>
<body>
<div class="container">
    <h1>Book Your Movie Ticket</h1>
    <form method="POST" action="">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" required value="<?php echo isset($show_date) ? $show_date : ''; ?>">
        <button type="submit">Check Availability</button>
    </form>

    <?php if (isset($show_date)) { ?>
        <h3>Seat Map (Date: <?php echo htmlspecialchars($show_date); ?>)</h3>
        <div class="seat-map">
            <?php
            for ($i = 1; $i <= 40; $i++) {
                $class = "seat";
                if (in_array($i, $bookedSeats)) {
                    $class .= " booked"; // Mark booked seats
                }
                echo '<div class="'. $class .'" data-seat="'.$i.'">'.$i.'</div>';
            }
            ?>
        </div>

        <h3>Total Amount: NPR <span id="totalAmount">0</span></h3>
        <button id="checkoutBtn">Proceed to Checkout</button>

        <div class="seat-legend">
            <div><span class="available"></span>Available</div>
            <div><span class="booked"></span>Booked</div>
        </div>
    <?php } ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const bookedSeats = <?php echo json_encode($bookedSeats); ?>; // Convert PHP array to JavaScript
    const seatElements = document.querySelectorAll(".seat");
    const ticketPrice = <?php echo $ticketPrice; ?>;
    let selectedSeats = [];
    const totalAmountSpan = document.getElementById("totalAmount");
    const checkoutBtn = document.getElementById("checkoutBtn");

    seatElements.forEach(seat => {
        const seatNumber = parseInt(seat.dataset.seat);
        if (bookedSeats.includes(seatNumber)) {
            seat.classList.add("booked");
            seat.innerText = "X"; // Mark booked seats
        }
        seat.addEventListener("click", function () {
            if (!this.classList.contains("booked")) {
                if (this.classList.contains("selected")) {
                    this.classList.remove("selected");
                    selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                } else {
                    this.classList.add("selected");
                    selectedSeats.push(seatNumber);
                }
                totalAmountSpan.textContent = selectedSeats.length * ticketPrice;
            }
        });
    });

    checkoutBtn.addEventListener("click", function () {
        if (selectedSeats.length === 0) {
            alert("Please select at least one seat before proceeding to checkout.");
            return;
        }
        alert("Proceeding to checkout with seats: " + selectedSeats.join(", ") + "\nTotal Amount: NPR " + (selectedSeats.length * ticketPrice));
        // Redirect or submit form here
    });
});
</script>
</body>
</html>
