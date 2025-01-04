<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seat Booking System</title>
  <style>
    /* General Styling */
    body {
      font-family: 'Arial', sans-serif;
      background: #f8fafc;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    h1 {
      color: #333;
      margin-bottom: 30px;
      font-size: 2em;
      text-align: center;
    }

    /* Seat Selection Styling */
    .seat-container {
      margin: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .seats-row {
      display: flex;
      justify-content: center;
      margin: 10px 0;
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
      transition: all 0.3s ease;
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

    /* Booking Summary Styling */
    .booking-summary {
      margin-top: 30px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      text-align: center;
    }
    .booking-summary h3 {
      margin-bottom: 20px;
      color: #333;
      font-size: 1.5em;
    }
    .booking-summary p {
      margin: 10px 0;
      color: #555;
      font-size: 1.1em;
    }
    .booking-summary input[type="date"] {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
      width: 100%;
    }
    .booking-summary button {
      width: 100%;
      padding: 10px;
      background: #22c55e;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
    }
    .booking-summary button:hover {
      background: #16a34a;
    }

    /* Khalti Payment Button */
    .khalti-button {
      width: 100%;
      padding: 10px;
      background-color: #f9c74f;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      margin-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    .khalti-button:hover {
      background-color: #e9b34d;
      transform: scale(1.05);
    }
    .khalti-button img {
      margin-right: 10px;
      width: 25px;
      height: 25px;
    }

  </style>
</head>
<body>

  <h1>Seat Booking System</h1>

  <div class="seat-container" id="seatContainer">
    <?php
    include 'config.php'; // Ensure this file initializes a PDO connection in the variable $conn

    try {
        // Fetch seat data from the database
        $sql = "SELECT * FROM seats";
        $stmt = $conn->prepare($sql); // Use PDO's prepare statement
        $stmt->execute();
    
        // Fetch all rows as an associative array
        $seatsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!$seatsData) {
            echo "No seats data found.";
        }
    } catch (PDOException $e) {
        echo "Error fetching seat data: " . $e->getMessage();
    }
    
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
 <!-- Khalti Payment Button -->
    <button class="khalti-button" id="khaltiPaymentBtn">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Khalti_logo.svg/640px-Khalti_logo.svg.png" alt="Khalti Logo">
      Pay with Khalti
    </button>
      <button type="submit">Confirm Booking</button>
    </form>

   
  </div>

  <script src="https://khalti.com/static/khalti-checkout.js"></script>
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

    const khaltiConfig = {
      publicKey: "YOUR_PUBLIC_KEY", // Replace with your Khalti public key
      productIdentity: "SeatBookingSystem",
      productName: "Seat Booking",
      productUrl: "http://yourwebsite.com", // Replace with your website URL
      eventHandler: {
        onSuccess(payload) {
          console.log("Payment successful", payload);

          // Send payment details to the server
          fetch("process_payment.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                alert("Payment successful!");
                window.location.href = "booking_confirmation.php"; // Redirect to confirmation
              } else {
                alert("Payment verification failed!");
              }
            })
            .catch((error) => {
              console.error("Payment error:", error);
              alert("An error occurred while processing the payment.");
            });
        },
        onError(error) {
          console.error("Payment error:", error);
          alert("Payment failed! Please try again.");
        },
        onClose() {
          console.log("Payment widget closed.");
        },
      },
    };

    const khaltiCheckout = new KhaltiCheckout(khaltiConfig);

    document.getElementById("khaltiPaymentBtn").addEventListener("click", () => {
      const amount = totalPrice * 100; // Convert price to paisa
      khaltiCheckout.show({ amount });
    });
  </script>

</body>
</html>
