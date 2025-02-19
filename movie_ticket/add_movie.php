<?php
// session_start();
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: admin_login.php");
//     exit();
// }

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
                // Prepare the SQL statement using MySQLi
                $stmt = $conn->prepare("INSERT INTO movies (title, genre, duration, description, poster) VALUES (?, ?, ?, ?, ?)");

                // Bind parameters (s = string, i = integer)
                $stmt->bind_param("ssiss", $title, $genre, $duration, $description, $posterPath);

                // Execute the statement
                if ($stmt->execute()) {
                    $success = "Movie added successfully!";
                    // Redirect to admin dashboard after success
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    $error = "Error adding movie: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } catch (Exception $e) {
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
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<!-- Form for adding movie -->
<form method="POST" action="add_movie.php" enctype="multipart/form-data">
<div class="container">
    <h2>Add Movie</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php endif; ?>

    <div class="form-group">
        <label for="title">Movie Title</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
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

    <div class="form-group">
        <label for="duration">Duration (in minutes)</label>
        <input type="number" id="duration" name="duration" min="1" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>
    </div>

    <div class="form-group">
        <label for="poster">Movie Poster</label>
        <input type="file" id="poster" name="poster" accept="image/*" required>
    </div>

    <button type="submit">Add Movie</button>
</div>
</form>

</body>
</html>
