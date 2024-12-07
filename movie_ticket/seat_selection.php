<style>
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #1c1c1c; /* Dark background for a minimalist feel */
    color: #f1f1f1; /* Light text for contrast */
    display: flex;
    justify-content: center;
    margin: 0;
    height: 100vh;
    align-items: center;
}

/* Seat Layout Container */
.seat-layout {
    width: 85%;
    max-width: 1200px;
    background-color: #2c2c2c; /* Dark gray background for seats container */
    padding: 20px;
    border-radius: 10px; /* Rounded corners for a modern touch */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/* Screen Section */
.screen {
    text-align: center;
    margin: 30px 0;
    font-size: 22px;
    font-weight: bold;
    color: #ffffff;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.screen::before {
    content: "";
    display: block;
    width: 90%;
    height: 15px;
    background-color: #444444;
    margin: 0 auto;
    border-radius: 10px;
}

/* Seat Sections (Classic, Club, Recliner) */
.section {
    margin: 40px 0;
}

.section-title {
    text-align: left;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 20px;
    color: #e0e0e0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.seat-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Seat Row Styling */
.seat-row {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 10px;
}

.seat {
    width: 30px;
    height: 30px;
    background-color: #444444;
    border: 1px solid #777777;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.2s ease-in-out;
}

.seat:hover {
    background-color: #00b894; /* Subtle green on hover */
    transform: scale(1.1); /* Slightly enlarge seat on hover */
}

.seat.selected {
    background-color: #fdcb6e; /* Yellow for selected seat */
    color: #2d3436; /* Dark text for contrast */
}

.seat.occupied {
    background-color: #636e72;
    color: #dfe6e9;
    cursor: not-allowed;
}

.seat.recliner {
    background-color: #74b9ff;
    border-radius: 50%;
}

.row-label {
    font-size: 16px;
    font-weight: bold;
    color: #dfe6e9;
    margin-right: 10px;
}

/* Seat Legend */
.legend {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
    font-size: 14px;
}

.legend-item {
    display: flex;
    align-items: center;
}

.legend-color {
    width: 20px;
    height: 20px;
    border-radius: 50%;
}

.legend-available {
    background-color: #444444;
}

.legend-selected {
    background-color: #fdcb6e;
}

.legend-occupied {
    background-color: #636e72;
}

.legend-recliner {
    background-color: #74b9ff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .seat-layout {
        width: 95%;
        padding: 10px;
    }

    .seat-row {
        gap: 8px;
    }

    .seat {
        width: 25px;
        height: 25px;
        font-size: 12px;
    }

    .section-title {
        font-size: 16px;
    }

    .legend {
        font-size: 12px;
    }
}

</style>


<div class="seat-layout">
    <div class="screen">SCREEN</div>

    <!-- Classic Section -->
    <div class="section">
        <div class="section-title">CLASSIC (450.00)</div>
        <div class="seat-container">
            <?php
            $classic_rows = ['M', 'L', 'K', 'J', 'I', 'H'];
            foreach ($classic_rows as $row) {
                echo "<div class='seat-row'>";
                echo "<span class='row-label'>$row</span>";
                for ($i = 1; $i <= 14; $i++) {
                    echo "<div class='seat'>$i</div>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Club Section -->
    <div class="section">
        <div class="section-title">CLUB (450.00)</div>
        <div class="seat-container">
            <?php
            $club_rows = ['F', 'E', 'D', 'C', 'B'];
            foreach ($club_rows as $row) {
                echo "<div class='seat-row'>";
                echo "<span class='row-label'>$row</span>";
                for ($i = 1; $i <= 18; $i++) {
                    $occupied_class = ($i > 13) ? "occupied" : ""; // Make some seats occupied
                    echo "<div class='seat $occupied_class'>$i</div>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Recliner Section -->
    <div class="section">
        <div class="section-title">RECLINER (750.00)</div>
        <div class="seat-container">
            <?php
            $recliner_row = 'A';
            echo "<div class='seat-row'>";
            echo "<span class='row-label'>$recliner_row</span>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<div class='seat recliner'>$i</div>";
            }
            echo "</div>";
            ?>
        </div>
    </div>

    <!-- Legend -->
    <div class="legend">
        <div class="legend-item">
            <div class="legend-color legend-available"></div> Available
        </div>
        <div class="legend-item">
            <div class="legend-color legend-selected"></div> Selected
        </div>
        <div class="legend-item">
            <div class="legend-color legend-occupied"></div> Occupied
        </div>
        <div class="legend-item">
            <div class="legend-color legend-recliner"></div> Recliner
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const seats = document.querySelectorAll(".seat");
        const legendSelected = document.querySelector(".legend-selected");
        const legendAvailable = document.querySelector(".legend-available");
        const legendOccupied = document.querySelector(".legend-occupied");
        const legendRecliner = document.querySelector(".legend-recliner");

        // Seat selection handler
        seats.forEach(seat => {
            // Add click event listener
            seat.addEventListener("click", () => {
                // Skip the interaction if the seat is occupied
                if (seat.classList.contains("occupied")) return;

                // Toggle the selected state
                seat.classList.toggle("selected");
            });
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const seats = document.querySelectorAll(".seat");
        const totalElement = document.createElement("div");
        const classicPrice = 450;
        const reclinerPrice = 750;

        totalElement.style.marginTop = "20px";
        totalElement.style.textAlign = "center";
        totalElement.style.fontWeight = "bold";
        totalElement.textContent = "Total: ₹0";
        document.querySelector(".seat-layout").appendChild(totalElement);

        seats.forEach(seat => {
            seat.addEventListener("click", () => {
                if (seat.classList.contains("occupied")) return;

                seat.classList.toggle("selected");

                const selectedSeats = document.querySelectorAll(".seat.selected");
                let total = 0;

                selectedSeats.forEach(selectedSeat => {
                    if (selectedSeat.classList.contains("recliner")) {
                        total += reclinerPrice;
                    } else {
                        total += classicPrice;
                    }
                });

                totalElement.textContent = `Total: ₹${total}`;
            });
        });
    });
</script>

<!-- <?php
require 'config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $showtimeId = $_GET['showtime_id'];

    $stmt = $conn->prepare("SELECT id, seat_number, status, price FROM seats WHERE showtime_id = ?");
    $stmt->bind_param("i", $showtimeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $seats = [];
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }

    echo json_encode($seats);
}
?> -->
