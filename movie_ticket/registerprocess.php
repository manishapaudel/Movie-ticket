<?php
// Start session
session_start();

// Database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ensure fields are not empty
    if (empty($username) || empty($password)) {
        header("Location: registration.php?error=empty_fields");
        exit();
    }

    // Check if the username is already taken
    $sql_check = "SELECT id FROM Login WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Username already exists
        $stmt_check->close();
        $conn->close();
        header("Location: registration.php?error=username_taken");
        exit();
    }
    $stmt_check->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql_insert = "INSERT INTO Login (username, password) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ss", $username, $hashed_password);

    if ($stmt_insert->execute()) {
        // Registration successful
        $stmt_insert->close();
        $conn->close();
        header("Location: Login.php?success=registration_complete");
        exit();
    } else {
        // Database error
        $stmt_insert->close();
        $conn->close();
        header("Location: registration.php?error=database_error");
        exit();
    }
} else {
    // Redirect if accessed without POST
    header("Location: registration.php");
    exit();
}
?>