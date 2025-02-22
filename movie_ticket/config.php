<?php
// config.php

$servername = "localhost";
$username = "root"; // default username for MySQL
$password = ""; // default password for MySQL
$dbname = "mydb"; // your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 
?>
