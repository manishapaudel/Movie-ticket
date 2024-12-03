<?php
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

// Create the SQL query with password hashing
$sql = "CREATE TABLE Login (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Login created successfully";

    // Insert 5 usernames and passwords with password hashing
    $users = [
        ['username' => 'riya', 'password' => password_hash('password1', PASSWORD_DEFAULT)],
        ['username' => 'priyanka', 'password' => password_hash('password2', PASSWORD_DEFAULT)],
        ['username' => 'ram', 'password' => password_hash('password3', PASSWORD_DEFAULT)],
        ['username' => 'shyam', 'password' => password_hash('password4', PASSWORD_DEFAULT)],
        ['username' => 'hari', 'password' => password_hash('password5', PASSWORD_DEFAULT)]
    ];

    foreach ($users as $user) {
        $sql = "INSERT INTO Login (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $user['username'], $user['password']);
        mysqli_stmt_execute($stmt);
    }

    echo "Users inserted successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>