<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'config.php';

// Adding a new movie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_date = $_POST['release_date'];

    $stmt = $conn->prepare("INSERT INTO movies (title, description, release_date) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $release_date]);
}

// Deleting a movie
if (isset($_GET['delete'])) {
    $movie_id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->execute([$movie_id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Manage Movies</h1>

    <!-- Add Movie Form -->
    <form method="POST" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" required>
        <button type="submit">Add Movie</button>
    </form>

    <!-- List of Movies -->
    <h2>Movies</h2>
    <ul>
        <?php
        $stmt = $conn->query("SELECT * FROM movies");
        while ($movie = $stmt->fetch()) {
            echo "<li>
                {$movie['title']} ({$movie['release_date']})
                <a href='admin_dashboard.php?delete={$movie['id']}'>Delete</a>
            </li>";
        }
        ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
