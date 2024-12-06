    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            margin: 20px;
            background-color: #8b00ff; /* Change background to black */
            color: white; /* Make text white for better visibility */
        }

        .seat-layout {
            width: 80%;
        }

        .screen {
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            color: white; /* Ensure screen label is visible */
            position: relative;
        }

        .screen::before {
          content: "";
          display: block;
          width: 80%; /* Make the screen wider */
          height: 20px; /* Increase height for a more prominent screen */
          background: black; /* Screen is now black */
          border-radius: 50px; /* Add curvature to the screen */
          margin: 0 auto; /* Center the screen */
        }

        .section {
            margin: 30px 0;
        }

        .section-title {
            text-align: left;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .seat-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            gap: 5px;
            transform: perspective(300px) rotateX(5deg); /* Add depth to rows */
        }

        .seat {
            width: 25px;
            height: 25px;
            background-color: white; /* Change seat color to white */
            color: black; /* Make seat text black for contrast */
            border: 1px solid white; /* Update border to white */
            text-align: center;
            line-height: 25px;
            cursor: pointer;
        }

        .seat:hover {
            background-color: lightgreen;
        }

        .seat.occupied {
            background-color: #ccc;
            cursor: not-allowed;
            color: blue;
        }

        .seat.selected {
            background-color: yellow;
            color: black;
        }

        .recliner {
            background-color: lightblue; /* Unique color for recliners */
            border-radius: 50%;
        }

        .row-label {
            margin-right: 5px;
            font-weight: bold;
            color: white; /* Ensure row labels are visible */
        }

        .legend {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-color {
            border: 1px solid black;
        }

        .legend-available {
            background-color: lightgray;
        }

        .legend-selected {
            background-color: yellow;
        }

        .legend-occupied {
            background-color: blue;
        }

        .legend-recliner {
            background-color: lightblue;
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
</body>
</html>

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
