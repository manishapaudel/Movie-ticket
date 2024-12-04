<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error());
    die("We are experiencing technical difficulties. Please try again later.");
}

// Create the SQL query with password hashing and additional fields
$sql= "CREATE TABLE Login (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute the query and check for errors
if (mysqli_query($conn, $sql)) {
    echo "Table 'Users' created successfully.";
} else {
    error_log("Error creating table: " . mysqli_error($conn));
    echo "Error creating table. Please check the logs for more details.";
}

// Close the connection
mysqli_close($conn);
?>
