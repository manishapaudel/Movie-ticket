
<?php
include 'config.php';
session_start();


$bookedSeats = isset($_GET['booked']) ? explode(',', $_GET['booked']) : [3,9,19];


if (isset($_POST['date'])) {
    // $show_date = $_POST['date'];
    // $show_time = $_POST['timing'];

    $stmt = $conn->prepare("SELECT seats FROM bookings WHERE booking_date = ?");
    $stmt->bind_param("s", $show_date, );
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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : (isset($_GET['title']) ? $_GET['title'] : 'Unknown Movie');
    $date = $_POST['date'];
    $timing = $_POST['timing'];
    $language = $_POST['language'];
    $seatsStr = $_POST['seats'];
    $selectedSeats = array_filter(explode(',', $seatsStr));
    $seatPrice = 200;
    $totalAmount = count($selectedSeats) * $seatPrice;

    // session_start(); // Make sure session is started at the top
//     // Check if user is logged in
//     if (!isset($_SESSION['user_id'])) {
//         die("Error: User not logged in. Please log in to book tickets.");
//     }
//     // Get user ID from session
//     $user_id = $_SESSION['user_id'];
// // Retrieve movie_id based on movie title
// $movie_id = null;
// $stmt_movie = $conn->prepare("SELECT movie_id FROM movies WHERE title = ?");
// $stmt_movie->bind_param("s", $title);
// $stmt_movie->execute();
// $stmt_movie->bind_result($movie_id);
// $stmt_movie->fetch();
// $stmt_movie->close();

// if (!$movie_id) {
//     die("Error: Movie not found in the database.");
// }

// // Now insert the booking with movie_id
// $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_id, seats, booking_date) VALUES (?, ?, ?, NOW())");
// $stmt->bind_param("iis", $user_id, $movie_id, $seatsStr);

// if ($stmt->execute()) {
//     echo "Booking successful!";
// } else {
//     die("Error: " . $stmt->error);
// }

// $stmt->close();
// $conn->close();






    
    // *** ENCODE DATA FOR PAYMENT REQUEST ***
    $bookingData = [
        'title' => $title,
        'date' => $date,
        'timing' => $timing,
        'language' => $language,
        'seats' => $seatsStr,
        'amount' => $totalAmount,
        'user_id' => 1, // Replace with actual user ID from session $_SESSION['user_id']
        'booking_id' => null, // We'll get this AFTER the booking is recorded
    ];

    $encodedData = base64_encode(json_encode($bookingData));
    $urlSafeData = urlencode($encodedData);
    $paymentRequestURL = "paymentrequest.php?data=" . $urlSafeData;
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
           button { padding: 10px 20px; background: #5A2D82; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
           button:hover { background: #7D3C98; }
       </style>
    </head>
    <body>
       <div class="summary">
           <h2>Booking Summary</h2>
           <p><strong>Movie Name:</strong> <?php echo htmlspecialchars($title); ?></p>
           <p><strong>Date:</strong> <?php echo htmlspecialchars($date); ?></p>
           <p><strong>Timing:</strong> <?php echo htmlspecialchars($timing); ?></p>
           <p><strong>Language:</strong> <?php echo htmlspecialchars($language); ?></p>
           <p><strong>Selected Seats:</strong> <?php echo htmlspecialchars(implode(', ', $selectedSeats)); ?></p>
           <p><strong>Total Amount:</strong> NPR <?php echo $totalAmount; ?></p>

           <!-- Proceed to Payment form -->
           <form action="payment-request.php" method="POST">
               <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
               <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
               <input type="hidden" name="timing" value="<?php echo htmlspecialchars($timing); ?>">
               <input type="hidden" name="language" value="<?php echo htmlspecialchars($language); ?>">
               <input type="hidden" name="seats" value="<?php echo htmlspecialchars($seatsStr); ?>">
               <input type="hidden" name="amount" value="<?php echo $totalAmount; ?>">
<!-- Pay with khalti -->
<form action="payment-request.php" method="post" style="text-align: center; margin-top: 20px;">
    <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
    <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
    <input type="hidden" name="timing" value="<?php echo htmlspecialchars($timing); ?>">
    <input type="hidden" name="language" value="<?php echo htmlspecialchars($language); ?>">
    <input type="hidden" name="seats" value="<?php echo htmlspecialchars($seatsStr); ?>">
    <input type="hidden" name="total" value="<?php echo $totalAmount; ?>">
    <input type="hidden" name="user_id" value="1"> <!-- Change dynamically -->
    <input type="hidden" name="booking_date" value="2025-02-21"> <!-- Change dynamically -->
    <input type="hidden" name="movie_id" value="10">
    <button id="payment-button" type="submit" name="place-order" class="btn place-order-btn"
        style="background-color: #5A2D82; color: white; border: none; padding: 12px 20px; font-size: 16px;  
               font-weight: bold; display: flex; align-items: center; justify-content: center; 
               border-radius: 5px; cursor: pointer; transition: 0.3s; width: 220px; margin: auto;">
        <img src="khalti.jpg" alt="Khalti Logo"
            style="width: 24px; height: 24px; margin-right: 10px;">
        Pay With Khalti
    </button>
</form>


               
               <button class="btn" id="confirmButton" >Confirm Booking</button>
               <script>
        document.getElementById("confirmButton").addEventListener("click", function() {
            alert("Successfully booked!");
            window.print();
        });
</script>
<?php 
include 'config.php';
    // session_start(); // Make sure session is started at the top
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        die("Error: User not logged in. Please log in to book tickets.");
    }
    // Get user ID from session
    $user_id = $_SESSION['user_id'];
// Retrieve movie_id based on movie title
$movie_id = null;
$stmt_movie = $conn->prepare("SELECT movie_id FROM movies WHERE title = ?");
$stmt_movie->bind_param("s", $title);
$stmt_movie->execute();
$stmt_movie->bind_result($movie_id);
$stmt_movie->fetch();
$stmt_movie->close();

if (!$movie_id) {
    die("Error: Movie not found in the database.");
}

// Now insert the booking with movie_id
$stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_id, seats, booking_date) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iis", $user_id, $movie_id, $seatsStr);

if ($stmt->execute()) {
    echo "";
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();

?>


           </form>
           <br><br>
           <form action="index.php">
           <button >Go to Dashboard</button>
           </form>
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
        background: #f66 !important; /* Red color for booked seats */
    pointer-events: none; /* Disable clicking */
    cursor: not-allowed;
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

        <?php
    // Get movie title from URL parameters
    $title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'Unknown Movie';
    ?>

    <!-- Display Movie Title -->
    <h2>Selected Movie: <?php echo $title; ?></h2>

    <form method="POST" action="check_availability.php">
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
    for ($i = 1; $i <= 40; $i++) {
        $class = "seat";
        if (in_array($i, $bookedSeats)) {
            $class .= " booked disabled"; // Disable selection for booked seats
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
        <br>
        
        
<br><br>
        <!-- Hidden input to hold selected seat numbers -->
        <form action="" method="">
        <input type="hidden" id="seats" name="seats" value="">
        <button type="submit">Checkout</button>
        </form>


    </form>
</div>
<script>
   

document.addEventListener("DOMContentLoaded", function () {
        const bookedSeats = <?php echo json_encode($bookedSeats); ?>; // Convert PHP array to JavaScript
        const seatElements = document.querySelectorAll(".seat");

        seatElements.forEach(seat => {
            const seatNumber = parseInt(seat.dataset.seat);
            if (bookedSeats.includes(seatNumber)) {
                seat.classList.add("booked", "disabled");
                seat.innerText = "X"; // Mark booked seats
            }
            seat.addEventListener("click", function () {
            if (this.classList.contains("booked")) {
                alert("Already booked, please select another seat!");
            }
        });
        });
    })
  document.addEventListener("DOMContentLoaded", function () {
    const seatElements = document.querySelectorAll(".seat:not(.booked)"); // Exclude booked seats
    const seatsInput = document.getElementById("seats");
    const totalAmountDisplay = document.createElement("p");
    totalAmountDisplay.innerHTML = "<strong>Total Amount: NPR 0</strong>";
    document.querySelector(".container").appendChild(totalAmountDisplay);

    let selectedSeats = [];
    const seatPrice = 200; // Price per seat

    seatElements.forEach(seat => {
        seat.addEventListener("click", function () {
            const seatNumber = this.dataset.seat;

            if (this.classList.contains("selected")) {
                this.classList.remove("selected");
                selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
            } else {
                this.classList.add("selected");
                selectedSeats.push(seatNumber);
            }

            seatsInput.value = selectedSeats.join(",");
            totalAmountDisplay.innerHTML = `<strong>Total Amount: NPR ${selectedSeats.length * seatPrice}</strong>`;
        });
    });

    document.querySelector("form").addEventListener("submit", function (event) {
        if (selectedSeats.length === 0) {
            event.preventDefault(); // Prevent form submission
            alert("Please select at least one seat.");
        }
    });
});




    document.querySelector('form').addEventListener('submit', function(event) {
    document.querySelector('input[name="date"]').value = document.getElementById('date').value;
    document.querySelector('input[name="timing"]').value = document.getElementById('timing').value;
    document.querySelector('input[name="language"]').value = document.getElementById('language').value;
});

</script>
</body>
</html>
