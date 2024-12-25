<?php
include 'config.php';

// Admin details
$email = 'admin@example.com';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Securely hash the password

// Insert the admin record
$stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (:email, :password)");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
    echo "Admin created successfully.";
} else {
    echo "Error creating admin.";
}
?>
