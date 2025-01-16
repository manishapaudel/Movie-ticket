<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'config.php'; // Include the database connection

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $posterNewName = null;

    // Handle file upload
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] == UPLOAD_ERR_OK) {
        $posterTmpName = $_FILES['poster']['tmp_name'];
        $posterName = $_FILES['poster']['name'];
        $posterExt = strtolower(pathinfo($posterName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($posterExt, $allowedExts)) {
            $error = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
        } elseif ($_FILES['poster']['size'] > $maxFileSize) {
            $error = "File size exceeds 2MB.";
        } else {
            $posterNewName = uniqid() . "." . $posterExt;
            $posterPath = "uploads/" . $posterNewName;

            if (move_uploaded_file($posterTmpName, $posterPath)) {
                // Upload successful
            } else {
                $error = "Failed to upload poster.";
            }
        }
    }

    if (empty($error)) {
        if (empty($title) || empty($genre) || empty($duration)) {
            $error = "Title, genre, and duration are required.";
        } else {
            try {
                // Insert movie data into the database
                $stmt = $conn->prepare(
                    "INSERT INTO movies (title, genre, duration, description, poster) VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([$title, $genre, $duration, $description, $posterPath]);
                $success = "Movie added successfully!";
            } catch (PDOException $e) {
                $error = "Error adding movie: " . htmlspecialchars($e->getMessage());
            }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#description',
            height: 200,
            menubar: false
        });

        // Display Toast notifications for success/error messages
        <?php if ($success): ?>
        toastr.success("<?= $success; ?>");
        <?php elseif ($error): ?>
        toastr.error("<?= $error; ?>");
        <?php endif; ?>
    </script>
    <style>
        /* Custom Styles */
        body {
            background: linear-gradient(pink, pink, blue, blue);
            animation: gradientBG 10s ease infinite;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            background: #111;
        }

        .form-label {
            color: #fff;  /* Changed to white color */
        }

        .card-body {
            padding: 2rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #2d87f0;
        }

        .btn-primary {
            background-color: #2d87f0;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #1f6cc7;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #2d87f0;
            box-shadow: 0 0 8px rgba(45, 135, 240, 0.5);
        }

        .form-select {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }

        .form-select:focus {
            border-color: #2d87f0;
            box-shadow: 0 0 8px rgba(45, 135, 240, 0.5);
        }

        /* More specific selector for the small text with the 'form-text' class */
        .form-control + .form-text {
            font-size: 0.875rem;
            color: #fff !important;  /* Force white color */
        }


        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .alert {
            font-size: 1rem;
            padding: 15px;
            margin-bottom: 15px;
        }

        .text-primary {
            color: #2d87f0 !important;
        }
    </style>
</head>
<body>

<!-- Form for adding movie -->
<form method="POST" action="add_movie.php" enctype="multipart/form-data">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php endif; ?>
    
    <div class="mb-3">
        <label for="title">Movie Title</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="genre">Genre</label>
        <select id="genre" name="genre" required>
            <option value="">-- Select Genre --</option>
            <option value="Action">Action</option>
            <option value="Comedy">Comedy</option>
            <option value="Drama">Drama</option>
            <option value="Horror">Horror</option>
            <option value="Sci-Fi">Sci-Fi</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="duration">Duration (in minutes)</label>
        <input type="number" id="duration" name="duration" min="1" required>
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="poster">Movie Poster</label>
        <input type="file" id="poster" name="poster" accept="image/*" required>
    </div>
    <button type="submit">Add Movie</button>
</form>

</body>
          
</html>
