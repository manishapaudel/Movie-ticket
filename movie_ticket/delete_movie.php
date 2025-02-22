<?php
include 'config.php';

if (isset($_GET['movie_id'])) {
    $id = intval($_GET['movie_id']);

   

    // Proceed with deletion
    $stmt_delete = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
        // Redirect to dashboard with a success message
        header("Location: admin_dashboard.php?message=Movie Deleted Successfully");
        exit;
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
} else {
    header("Location: admin_dashboard.php?error=Invalid Request");
    exit;
}
?>
