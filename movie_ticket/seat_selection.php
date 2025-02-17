<?php
// Simulated arrays for already booked and reserved seats.
$bookedSeats = [3, 7, 15];
$reservedSeats = [10, 18, 20];

// If the booking form is submitted, process and show the summary.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $timing = $_POST['timing'];
    $language = $_POST['language'];
    $seatsStr = $_POST['seats']; // Comma-separated seat numbers.
    // Remove any empty values (in case nothing was selected).
    $selectedSeats = array_filter(explode(',', $seatsStr));
    $seatPrice = 200; // Fixed price per seat.
    $totalAmount = count($selectedSeats) * $seatPrice;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
       <meta charset="UTF-8">
       <title>Booking Summary</title>
       <style>
           body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
           .summary { background: #fff; padding: 20px; max-width: 600px; margin: auto; }
           h2 { color: #333; }
           button { padding: 10px 20px; background: #333; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
           button:hover { background: #555; }
       </style>
    </head>
    <body>
       <div class="summary">
           <h2>Booking Summary</h2>
           <p><strong>Date:</strong> <?php echo htmlspecialchars($date); ?></p>
           <p><strong>Timing:</strong> <?php echo htmlspecialchars($timing); ?></p>
           <p><strong>Language:</strong> <?php echo htmlspecialchars($language); ?></p>
           <p><strong>Selected Seats:</strong> <?php echo htmlspecialchars(implode(', ', $selectedSeats)); ?></p>
           <p><strong>Total Amount:</strong> NPR <?php echo $totalAmount; ?></p>
           <!-- Proceed to Payment form -->
           <form action="esewa_payment.php" method="POST">
               <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
               <input type="hidden" name="timing" value="<?php echo htmlspecialchars($timing); ?>">
               <input type="hidden" name="language" value="<?php echo htmlspecialchars($language); ?>">
               <input type="hidden" name="seats" value="<?php echo htmlspecialchars($seatsStr); ?>">
               <input type="hidden" name="amount" value="<?php echo $totalAmount; ?>">
               <button type="submit">Confirm booking</button>
           </form>
           <br>
           <a href="booking.php">Go Back</a>
       </div>
    </body>
    </html>
    <?php
    exit;
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
          background: #f66;
       }
       .seat.reserved {
          background: #fc3;
       }
       .seat.disabled {
          pointer-events: none;
          opacity: 0.6;
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
       .seat-legend .reserved {
          background: #fc3;
       }
    </style>
</head>
<body>
<div class="container">
    <h1>Book Your Movie Ticket</h1>
    <form method="POST" action="">
        <!-- Date Selection -->
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" required>

        <!-- Timing Selection -->
        <label for="timing">Select Timing:</label>
        <select id="timing" name="timing" required>
            <option value="10:00 AM">10:00 AM</option>
            <option value="1:00 PM">1:00 PM</option>
            <option value="4:00 PM">4:00 PM</option>
            <option value="7:00 PM">7:00 PM</option>
            <option value="10:00 PM">10:00 PM</option>
        </select>

        <!-- Language Selection -->
        <label for="language">Select Language:</label>
        <select id="language" name="language" required>
            <option value="English">English</option>
            <option value="Spanish">Spanish</option>
            <option value="Hindi">Hindi</option>
            <option value="French">French</option>
        </select>

        <!-- Seat Selection -->
        <h3>Select Seats:</h3>
        <div class="seat-map">
            <?php
            // Generate 40 seats (5 rows x 8 columns)
            for ($i = 1; $i <= 40; $i++) {
                $class = "seat";
                if (in_array($i, $bookedSeats)) {
                    $class .= " booked disabled";
                } elseif (in_array($i, $reservedSeats)) {
                    $class .= " reserved disabled";
                }
                echo '<div class="'. $class .'" data-seat="'.$i.'">'.$i.'</div>';
            }
            ?>
        </div>
        <!-- Legend for Seat Status -->
        <div class="seat-legend">
            <div><span class="available"></span>Available</div>
            <div><span class="booked"></span>Booked</div>
            <div><span class="reserved"></span>Reserved</div>
        </div>
        <!-- Hidden input to hold selected seat numbers -->
        <input type="hidden" id="seats" name="seats" value="">
        <button type="submit">Confirm Booking</button>
    </form>
</div>
<script>
    // JavaScript for handling seat selection (only available seats can be toggled)
    const seatElements = document.querySelectorAll('.seat');
    let selectedSeats = [];

    seatElements.forEach(seat => {
        // Only allow click events if the seat is not booked or reserved.
        if (!seat.classList.contains('booked') && !seat.classList.contains('reserved')) {
            seat.addEventListener('click', () => {
                const seatNumber = seat.getAttribute('data-seat');
                if (seat.classList.contains('selected')) {
                    seat.classList.remove('selected');
                    selectedSeats = selectedSeats.filter(num => num !== seatNumber);
                } else {
                    seat.classList.add('selected');
                    selectedSeats.push(seatNumber);
                }
                // Update the hidden input with a comma-separated list.
                document.getElementById('seats').value = selectedSeats.join(',');
            });
        }
    });
</script>
</body>
</html>
