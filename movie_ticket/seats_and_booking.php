CREATE TABLE seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(10),
    price INT,
    status ENUM('available', 'occupied') DEFAULT 'available'
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_price INT,
    booking_date DATE
);

CREATE TABLE booking_seats (
    booking_id INT,
    seat_id INT,
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (seat_id) REFERENCES seats(id)
);
