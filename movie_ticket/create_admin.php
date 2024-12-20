<?php
include 'config.php';

$email = 'admin@example.com';
$password = 'admin123';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
$stmt->execute([$email, $hashedPassword]);

echo "Admin created successfully!";
?>
