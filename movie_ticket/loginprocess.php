<?php
// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL statement to prevent SQL injection
$sql = "SELECT * FROM Login WHERE username = ? AND password = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if user exists and password matches
if (mysqli_num_rows($result) > 0) {
    // Successful login, redirect to a protected page or set session
    header("Location: protected_page.php");
    exit();
} else {
    // Failed login, display error message or redirect to login page with error message
    echo "Invalid username or password.";
    // You can redirect back to login.php with an error message in the URL or session
    header("Location: login.php?error=invalid_credentials");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>