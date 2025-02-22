<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission when the user clicks the submit button

    $selectedSeats = json_decode($_POST['selectedSeats'], true); // Decode the selected seats
    $totalPrice = (int)$_POST['totalPrice']; // Get the total price
    $bookingDate = $_POST['bookingDate']; // Get the selected booking date

    // Example validation (you can expand it based on your requirements)
    if (empty($selectedSeats) || $totalPrice <= 0 || empty($bookingDate)) {
        echo "<h1>Booking Failed!</h1>";
        echo "<p>Invalid data submitted. Please go back and try again.</p>";
        exit;
    }

    // Process the booking logic (e.g., inserting into database)
    // Here you could add your database insertion logic or other processes

    // For now, we'll just display the submitted data as an example
    echo "<h1>Booking Summary</h1>";
    echo "<p>Selected Seats: " . implode(", ", $selectedSeats) . "</p>";
    echo "<p>Total Price: ₹$totalPrice</p>";
    echo "<p>Booking Date: $bookingDate</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Summary</title>
</head>
<body>

  <h1>Booking Summary</h1>
  <form action="" method="POST">
      <label for="bookingDate">Select Date:</label>
      <input type="date" id="bookingDate" name="bookingDate" required>
      
      <input type="hidden" id="selectedSeatsInput" name="selectedSeats" value='[]'> <!-- Set initial empty value or modify dynamically -->
      <input type="hidden" id="totalPriceInput" name="totalPrice" value="0"> <!-- Set initial total price -->

      <p id="totalPriceText">Total Price: ₹0</p> <!-- Total Price display -->

      <button type="submit">Confirm Booking</button> <!-- Submit button -->
  </form>

  <script>
    // Assuming you have JavaScript handling the seat selection and updating the hidden inputs dynamically
    let selectedSeats = [];
    let totalPrice = 0;

    // Update selected seats and total price when seats are selected or deselected
    function updateBookingSummary() {
      document.getElementById('selectedSeatsInput').value = JSON.stringify(selectedSeats);
      document.getElementById('totalPriceInput').value = totalPrice;
      document.getElementById('totalPriceText').textContent = `Total Price: ₹${totalPrice}`;
    }

    // Example function to simulate seat selection (this can be modified based on your actual seat selection logic)
    function selectSeat(seatId, price) {
      if (selectedSeats.includes(seatId)) {
        // Deselect seat
        selectedSeats = selectedSeats.filter(id => id !== seatId);
        totalPrice -= price;
      } else {
        // Select seat
        selectedSeats.push(seatId);
        totalPrice += price;
      }

      updateBookingSummary();
    }

    // Example: Select some seats
    selectSeat(1, 450); // Select seat with ID 1 and price 450
    selectSeat(2, 450); // Select seat with ID 2 and price 450

  </script>

</body>
</html>
