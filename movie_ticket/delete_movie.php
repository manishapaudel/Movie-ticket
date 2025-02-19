<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // First, delete the movie
    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Reset AUTO_INCREMENT only if needed
        $conn->query("ALTER TABLE movies AUTO_INCREMENT = 1");

        // Redirect back to admin dashboard
        header("Location: admin_dashboard.php?message=Movie Deleted Successfully");
        exit;
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
}
?>
