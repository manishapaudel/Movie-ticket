<?php
include 'config.php';

// Fetch movie details
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("Invalid movie ID.");
    }

    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" means integer
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();

    if (!$movie) {
        die("Movie not found.");
    }
}

// Update movie details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];

    // Handle poster upload
    $poster = $movie['poster']; // Default to existing poster
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = uniqid() . basename($_FILES['poster']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['poster']['tmp_name'], $targetFilePath)) {
            $poster = $fileName;
        }
    }

    $stmt = $conn->prepare("UPDATE movies SET title = ?, genre = ?, duration = ?, description = ?, poster = ? WHERE id = ?");
    $stmt->bind_param("ssissi", $title, $genre, $duration, $description, $poster, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Movie updated successfully!'); window.location.href='admin_dashboard.php';</script>";
        exit;
    } else {
        echo "Error updating movie: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background: #0056b3;
        }

        img {
            max-width: 100px;
            margin-top: 10px;
            border-radius: 5px;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Movie</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($movie['id']); ?>">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required>
            </div>

            <div class="form-group">
                <label>Genre</label>
                <select name="genre" required>
                    <option value="Action" <?php echo $movie['genre'] == 'Action' ? 'selected' : ''; ?>>Action</option>
                    <option value="Comedy" <?php echo $movie['genre'] == 'Comedy' ? 'selected' : ''; ?>>Comedy</option>
                    <option value="Drama" <?php echo $movie['genre'] == 'Drama' ? 'selected' : ''; ?>>Drama</option>
                    <option value="Horror" <?php echo $movie['genre'] == 'Horror' ? 'selected' : ''; ?>>Horror</option>
                    <option value="Romance" <?php echo $movie['genre'] == 'Romance' ? 'selected' : ''; ?>>Romance</option>
                </select>
            </div>

            <div class="form-group">
                <label>Duration (in minutes)</label>
                <input type="number" name="duration" value="<?php echo htmlspecialchars($movie['duration']); ?>" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" required><?php echo htmlspecialchars($movie['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Poster</label>
                <input type="file" name="poster">
                <?php if (!empty($movie['poster'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($movie['poster']); ?>" alt="Poster">
                <?php endif; ?>
            </div>

            <button type="submit">Save Changes</button>
        </form>
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
