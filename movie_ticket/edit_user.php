<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the user details in the database
    $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
    if ($stmt->execute([$email, $password, $userId])) {
        header("Location: admin_dashboard.php?message=User updated successfully");
    } else {
        header("Location: admin_dashboard.php?error=Failed to update user");
    }
    exit;
}
?>
