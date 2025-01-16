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
//  // sql to create table and add admin user
// $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT); // Hash the password
// $sql = "INSERT INTO admins (email, password) VALUES ('admin@example.com', '$hashedPassword')";

// if ($conn->query($sql) === TRUE) {
//     echo "Admin user created successfully";
// } else {
//     echo "Error creating admin user: " . $conn->error;
// }


// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// // sql to create table
// $sql = "INSERT INTO admins (email, password)
// VALUES 
// ('admin@example.com', 'admin123')";
    
//     if ($conn->query($sql) === TRUE) {
//       echo "Table admin created successfully";
//     } else {
//       echo "Error creating table: " . $conn->error;
//     }



// Close connection
// mysqli_close($conn);



?>










