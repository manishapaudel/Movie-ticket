<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];

    // Handle file upload
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] == UPLOAD_ERR_OK) {
        $posterTmpName = $_FILES['poster']['tmp_name'];
        $posterName = $_FILES['poster']['name'];
        $posterExt = pathinfo($posterName, PATHINFO_EXTENSION);
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (!in_array(strtolower($posterExt), $allowedExts)) {
            $error = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
        } else {
            $posterNewName = uniqid() . "." . $posterExt;
            move_uploaded_file($posterTmpName, "uploads/" . $posterNewName);
        }
    } else {
        $posterNewName = null; // No poster uploaded
    }

    if (empty($error)) {
        // Validate inputs
        if (empty($title) || empty($genre) || empty($duration)) {
            $error = "Title, genre, and duration are required.";
        } else {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO movies (title, genre, duration, description, poster) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $genre, $duration, $description, $posterNewName]);

            $success = "Movie added successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 500px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-bottom: 16px;
        }
        .btn {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 16px;
        }
        .success {
            color: green;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <h1>Add Movie</h1>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="genre">Genre</label>
        <select id="genre" name="genre" required>
            <option value="">-- Select Genre --</option>
            <option value="Action">Action</option>
            <option value="Comedy">Comedy</option>
            <option value="Drama">Drama</option>
            <option value="Horror">Horror</option>
            <option value="Sci-Fi">Sci-Fi</option>
        </select>

        <label for="duration">Duration (in minutes)</label>
        <input type="number" id="duration" name="duration" min="1" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter a brief description of the movie"></textarea>

        <label for="poster">Upload Poster</label>
        <input type="file" id="poster" name="poster" accept="image/*">

        <button type="submit" class="btn">Add Movie</button>
    </form>

    <a href="admin_dashboard.php" class="btn" style="background: #6c757d;">Back to Dashboard</a>
</body>
</html>
