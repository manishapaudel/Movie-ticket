<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$conn = new PDO("mysql:host=localhost;dbname=cinemas", "root", "");

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
        $posterExt = strtolower(pathinfo($posterName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (!in_array($posterExt, $allowedExts)) {
            $error = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
        } else {
            $posterNewName = uniqid() . "." . $posterExt;
            move_uploaded_file($posterTmpName, "uploads/" . $posterNewName);
        }
    } else {
        $posterNewName = null; // No poster uploaded
    }

    if (empty($error)) {
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
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="number"], textarea, select, input[type="file"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }
        .btn {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-secondary {
            background: #6c757d;
            text-align: center;
        }
        .btn-secondary:hover {
            background: #565e64;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
        }
        .success {
            background: #d4edda;
            color: #155724;
        }
    </style>
    <script>
        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const genre = document.getElementById('genre').value.trim();
            const duration = document.getElementById('duration').value.trim();

            if (!title || !genre || !duration) {
                alert('Please fill in all required fields.');
                return false;
            }

            if (duration <= 0) {
                alert('Duration must be greater than 0.');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Add Movie</h1>

        <?php if (!empty($error)): ?>
            <div class="message error"><?= $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="message success"><?= $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter movie title" required>

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
            <input type="number" id="duration" name="duration" min="1" placeholder="Enter movie duration" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter a brief description of the movie"></textarea>

            <label for="poster">Upload Poster</label>
            <input type="file" id="poster" name="poster" accept="image/*">

            <button type="submit" class="btn">Add Movie</button><br>

            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>
