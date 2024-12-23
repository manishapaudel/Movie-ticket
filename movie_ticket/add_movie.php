<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$conn = new PDO("mysql:host=localhost;dbname=cinemas", "root", "");

// Initialize messages
$error = '';
$success = '';

// Define genres manually or fetch them dynamically if still needed
$genres = ["Action", "Comedy", "Drama", "Horror", "Sci-Fi"];

// Handle form submission
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
            move_uploaded_file($posterTmpName, "uploads/" . $posterNewName);
        }
    }

    if (empty($error)) {
        if (empty($title) || empty($genre) || empty($duration)) {
            $error = "Title, genre, and duration are required.";
        } else {
            // Insert movie data into the database
            try {
                $stmt = $conn->prepare(
                    "INSERT INTO movies (title, genre, duration, description, poster) VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([$title, $genre, $duration, $description, $posterNewName]);
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h1 class="text-center text-primary mb-4">Add New Movie</h1>

                    <!-- Form for adding movie -->
                    <form method="POST" action="" enctype="multipart/form-data" id="addMovieForm">
                        <!-- Display messages -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success"><?= $success; ?></div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Movie Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter movie title" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <select id="genre" name="genre" class="form-select" required>
                                <option value="">-- Select Genre --</option>
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?= htmlspecialchars($genre); ?>"><?= htmlspecialchars($genre); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (in minutes)</label>
                            <input type="number" id="duration" name="duration" class="form-control" min="1" placeholder="Enter movie duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="poster" class="form-label">Movie Poster</label>
                            <input type="file" id="poster" name="poster" class="form-control" accept="image/*" required>
                            <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG. Max size: 2MB.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Movie</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Toastr JS for notifications -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
