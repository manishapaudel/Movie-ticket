<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="cinemas";

// Create connection
$conn = new mysqli($servername, $username, $password,  $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql= "
CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL 1  UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
)";

if (mysqli_query($conn, $sql)) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

$conn->close();
?>