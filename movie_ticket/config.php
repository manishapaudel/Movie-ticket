<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// // SQL to create table
// $tableSql = "CREATE TABLE IF NOT EXISTS seats (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     number VARCHAR(10) NOT NULL,
//     status ENUM('available', 'occupied') DEFAULT 'available',
//     price DECIMAL(10, 2) NOT NULL
// )";

// // Execute table creation query
// if (mysqli_query($conn, $tableSql)) {
//     echo "Table `seats` created successfully.<br>";
// } else {
//     echo "Error creating table: " . mysqli_error($conn) . "<br>";
// }

// // SQL to insert sample data
// $insertSql = "INSERT INTO seats (number, status, price) VALUES
//     ('A1', 'available', 150),
//     ('A2', 'occupied', 150),
//     ('A3', 'available', 150),
//     ('B1', 'available', 200),
//     ('B2', 'occupied', 200),
//     ('B3', 'available', 200)";

// // Execute data insertion query
// if (mysqli_query($conn, $insertSql)) {
//     echo "Sample data inserted into `seats` table successfully.<br>";
// } else {
//     echo "Error inserting data: " . mysqli_error($conn) . "<br>";
// }

// // Close connection
// mysqli_close($conn);



?>










