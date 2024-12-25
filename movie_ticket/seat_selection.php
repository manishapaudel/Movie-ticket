
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #1c1c1c;
        color: #f1f1f1;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        height: 100vh;
    }

    .seat-layout {
        width: 85%;
        max-width: 1200px;
        background-color: #2c2c2c;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

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
        position: relative;
    }

    .seat:hover {
        background-color: #00b894;
        transform: scale(1.1);
    }

    .seat.selected {
        background-color: #fdcb6e;
        color: #2d3436;
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
.modal.visible {
    display: block;
}
    /* .modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #ffffff; 
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #333333; 
    z-index: 1000;
    width: 300px;
    text-align: center;
    display: none;
} */



.modal-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-around;
}

.modal-buttons button {
    background: #fdcb6e; /* Highlight button for visibility */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    color: #333333; /* Text matches modal theme */
    transition: background 0.3s;
}

.modal-buttons button:hover {
    background: #00b894; /* Green on hover for better visual feedback */
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: none;
}

.overlay.visible {
    display: block;
}

</style>


<div class="seat-layout">
    <div class="screen">SCREEN</div>

    <!-- Classic Section -->
    <div class="section">
        <div class="section-title">CLASSIC (450.00)</div>
        <div class="seat-container" id="classic-seats"></div>
    </div>

    <!-- Club Section -->
    <div class="section">
        <div class="section-title">CLUB (450.00)</div>
        <div class="seat-container" id="club-seats"></div>
    </div>

    <!-- Recliner Section -->
    <div class="section">
        <div class="section-title">RECLINER (750.00)</div>
        <div class="seat-container" id="recliner-seats"></div>
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

<div class="modal" id="confirmation-modal">
    <p>Confirm your seat selection?</p>
    <div class="modal-buttons">
        <button id="confirm-selection" ><a href="booking_summary.php">Confirm</a></button>
        <button id="cancel-selection"><a href="index.php">Cancel</a></button>
    </div>
</div>
<div class="overlay" id="overlay"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const seatsData = {
            classic: { rows: ['M', 'L', 'K', 'J', 'I', 'H'], cols: 14 },
            club: { rows: ['F', 'E', 'D', 'C', 'B'], cols: 18 },
            recliner: { rows: ['A'], cols: 10 },
        };

        const seatContainerIds = {
            classic: "#classic-seats",
            club: "#club-seats",
            recliner: "#recliner-seats",
        };

        const renderSeats = (type) => {
            const container = document.querySelector(seatContainerIds[type]);
            const { rows, cols } = seatsData[type];
            rows.forEach((row) => {
                const rowDiv = document.createElement("div");
                rowDiv.classList.add("seat-row");
                const rowLabel = document.createElement("span");
                rowLabel.classList.add("row-label");
                rowLabel.textContent = row;
                rowDiv.appendChild(rowLabel);

                for (let i = 1; i <= cols; i++) {
                    const seatDiv = document.createElement("div");
                    seatDiv.classList.add("seat");
                    if (type === "recliner") seatDiv.classList.add("recliner");
                    seatDiv.textContent = i;
                    rowDiv.appendChild(seatDiv);
                }

                container.appendChild(rowDiv);
            });
        };

        Object.keys(seatsData).forEach(renderSeats);

        const seats = document.querySelectorAll(".seat");
        const modal = document.getElementById("confirmation-modal");
        const overlay = document.getElementById("overlay");
        const confirmButton = document.getElementById("confirm-selection");
        const cancelButton = document.getElementById("cancel-selection");



        
        let selectedSeats = [];

        const toggleModal = (visible) => {
            modal.classList.toggle("visible", visible);
            overlay.classList.toggle("visible", visible);
        };

        const updateTotal = () => {
            const totalElement = document.querySelector("#total-price") || document.createElement("div");
            totalElement.id = "total-price";
            totalElement.style.marginTop = "20px";
            totalElement.style.textAlign = "center";
            totalElement.style.fontWeight = "bold";
            const total = selectedSeats.reduce((sum, seat) => sum + (seat.type === "recliner" ? 750 : 450), 0);
            totalElement.textContent = `Total: ₹${total}`;
            document.querySelector(".seat-layout").appendChild(totalElement);
        };

        seats.forEach((seat) => {
            seat.addEventListener("click", () => {
                if (seat.classList.contains("occupied")) return;
                seat.classList.toggle("selected");
                const seatData = { row: seat.parentNode.querySelector(".row-label").textContent, number: seat.textContent, type: seat.classList.contains("recliner") ? "recliner" : "classic" };

                if (seat.classList.contains("selected")) {
                    selectedSeats.push(seatData);
                } else {
                    selectedSeats = selectedSeats.filter((s) => !(s.row === seatData.row && s.number === seatData.number));
                }

                updateTotal();
            });
        });

        openModalButton.addEventListener("click", () => {
        if (selectedSeats.length > 0) {
            toggleModal(true);
        } else {
            alert("Please select at least one seat.");
        }
    });

        confirmButton.addEventListener("click", () => {
            console.log("Selected Seats: ", selectedSeats);
            toggleModal(false);
        });

        cancelButton.addEventListener("click", () => {
            toggleModal(false);
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") toggleModal(false);
        });
    });
</script>