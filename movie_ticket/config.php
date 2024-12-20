<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinemas";

try {
    // Establish connection using PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='font-family: Arial, sans-serif; color: green;'>Connected successfully.</p>";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
