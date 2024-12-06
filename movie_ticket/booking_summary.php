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