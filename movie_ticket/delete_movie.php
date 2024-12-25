<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the movie
    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->execute([$id]);

    // Update IDs to renumber them
    $stmt = $conn->query("SET @autoid = 0");
    $stmt = $conn->query("UPDATE movies SET id = (@autoid := @autoid + 1)");
    $stmt = $conn->query("ALTER TABLE movies AUTO_INCREMENT = 1");

    header("Location: admin_dashboard.php");
    exit;
}
?>
