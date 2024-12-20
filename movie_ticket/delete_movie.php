<?php
include 'config.php';

// Get movie ID from query parameter
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid movie ID.");
}

// Delete movie from database
$stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin_dashboard.php");
exit;
?>
