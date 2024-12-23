<?php
include 'config.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$userId])) {
        header("Location: admin_dashboard.php?message=User deleted successfully");
    } else {
        header("Location: admin_dashboard.php?error=Failed to delete user");
    }
    exit;
}
?>
