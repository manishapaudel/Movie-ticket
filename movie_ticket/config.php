<?php
// config.php

$host = "localhost";
$dbname = "mydb";
$username = "root";
$password = "";

try {
    // Creating a PDO instance for database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle any connection error
    echo "Connection failed: " . $e->getMessage();
}

?>
