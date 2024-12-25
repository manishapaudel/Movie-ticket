<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seat Booking System</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: #f3f4f6;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    h1 {
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }
    .seat-container {
      margin: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .seats-row {
      display: flex;
      justify-content: center;
      margin: 5px;
    }
    .seat {
      width: 40px;
      height: 40px;
      margin: 5px;
      border: 2px solid #ddd;
      border-radius: 8px;
      text-align: center;
      line-height: 40px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }
    .seat:hover {
      transform: scale(1.1);
    }
    .available {
      background-color: #e0e7ff;
    }
    .occupied {
      background-color: #94a3b8;
      cursor: not-allowed;
    }
    .selected {
      background-color: #22c55e;
    }
    .booking-summary {
      margin-top: 20px;
      padding: 15px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }
    .booking-summary h3 {
      margin-bottom: 15px;
      color: #333;
    }
    .booking-summary button {
      width: 100%;
      padding: 10px;
      background: #22c55e;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s;
    }
    .booking-summary button:hover {
      background: #16a34a;
    }
    input[type="date"] {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 10px;
      width: 100%;
    }
  </style>
</head>
<body>

  <h1>Seat Booking System</h1>
  <div class="seat-container" id="seatContainer">
    <?php
      $rows = ['A', 'B'];
      foreach ($rows as $row) {
          echo '<div class="seats-row">';
          foreach ($seatsData as $seat) {
              if (strpos($seat['number'], $row) === 0) {
                  $class = $seat['status'] === 'available' ? 'available' : 'occupied';
                  echo "<div class='seat $class' data-id='{$seat['id']}' data-price='{$seat['price']}'>
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
