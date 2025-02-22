<?php
// Include your database configuration file
include 'config.php'; // Replace with your DB config file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Directory where the image will be saved
        $fileName = basename($_FILES['poster']['name']); // Original file name
        $uploadFile = $uploadDir . $fileName;

        // Validate file type and size
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($_FILES['poster']['type'], $allowedTypes) && $_FILES['poster']['size'] <= 2 * 1024 * 1024) { // Max size: 2MB
            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES['poster']['tmp_name'], $uploadFile)) {
                echo "File uploaded successfully!";

                // Store the uploaded file's path in the database
                $title = $_POST['title']; // Assuming the form has a field for movie title
                $description = $_POST['description']; // Assuming the form has a description field
                $posterPath = $uploadFile; // Save the uploaded file path

                // Insert the movie data into the database
                $sql = "INSERT INTO movies (title, description, image_url) VALUES (:title, :description, :image_url)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'title' => $title,
                    'description' => $description,
                    'image_url' => $posterPath
                ]);

                echo "Movie and poster uploaded successfully!";
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file format or file size exceeds 2MB.";
        }
    } else {
        echo "File upload error.";
    }
}
?>
