<style>
/* Booking Summary Styles */
.booking-summary {
  margin-top: 20px;
  border: 1px solid #ccc;
  padding: 15px;
  border-radius: 5px;
  max-width: 400px;
  background-color: #f9f9f9;
}

.booking-summary h3 {
  font-size: 1.5em;
  color: #333;
}

.booking-summary p {
  font-size: 1.2em;
  color: #555;
}

.booking-summary button {
  padding: 10px 20px;
  background: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.booking-summary button:hover {
  background-color: #0056b3;
}
</style>

<section>
  <div id="seat-layout">
    <!-- Rendered dynamically via JavaScript -->
  </div>

  <div class="booking-summary">
    <h3>Booking Summary</h3>
    <p id="selected-seats">Selected Seats: None</p>
    <p id="total-price">Total Price: ₹0</p>

    <form action="confirm_booking.php" method="POST">
      <input type="hidden" name="title" value="<?= htmlspecialchars($title) ?>">
      <input type="hidden" id="selectedSeatsInput" name="selectedSeats">
      <input type="hidden" id="totalPriceInput" name="totalPrice">
      <button type="submit">Proceed</button>
    </form>
  </div>
</section>

<script>
  let selectedSeats = [];
  let totalPrice = 0;

  // Fetch seat layout dynamically from the server
  async function fetchSeats(showtimeId) {
    const response = await fetch(`/api/seats/${showtimeId}`);
    const seats = await response.json();

    // Render seat layout dynamically
    const seatContainer = document.getElementById("seat-layout");
    seatContainer.innerHTML = seats
      .map(
        (seat) => `
        <div class="seat ${seat.status}" data-id="${seat.id}" data-price="${seat.price}">
          ${seat.number}
        </div>
      `
      )
      .join("");

    // Add seat click event listeners
    document.querySelectorAll(".seat").forEach((seat) => {
      seat.addEventListener("click", () => handleSeatSelection(seat));
    });
  }

  // Handle seat selection
  function handleSeatSelection(seat) {
    const price = parseInt(seat.getAttribute("data-price"));

    // Skip if seat is occupied
    if (seat.classList.contains("occupied")) return;

    // Toggle selected state
    seat.classList.toggle("selected");
    const seatId = seat.getAttribute("data-id");

    // Add/remove seat from selection and update price
    if (seat.classList.contains("selected")) {
      selectedSeats.push(seatId);
      totalPrice += price;
    } else {
      selectedSeats = selectedSeats.filter((id) => id !== seatId);
      totalPrice -= price;
    }

    // Update booking summary
    updateBookingSummary();
  }

  // Update booking summary section
  function updateBookingSummary() {
    document.getElementById("selected-seats").textContent =
      selectedSeats.length > 0
        ? `Selected Seats: ${selectedSeats.join(", ")}`
        : "Selected Seats: None";
    document.getElementById("total-price").textContent = `Total Price: ₹${totalPrice}`;

    // Update hidden form fields
    document.getElementById("selectedSeatsInput").value = JSON.stringify(selectedSeats);
    document.getElementById("totalPriceInput").value = totalPrice;
  }

  // Initialize seat layout (replace `showtimeId` with actual showtime ID)
  const showtimeId = 1; // Example showtime ID
  fetchSeats(showtimeId);
</script>
