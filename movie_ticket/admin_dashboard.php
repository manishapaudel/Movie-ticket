<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'config.php';

// Fetch admin details
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

// Fetch movies
$moviesStmt = $conn->query("SELECT * FROM movies");
$movies = $moviesStmt->fetchAll();

// Fetch users
$usersStmt = $conn->query("SELECT * FROM users");
$users = $usersStmt->fetchAll();

// Fetch bookings
$bookingsStmt = $conn->query("SELECT b.id, u.id as user_id, m.id as movie_id, b.seats, b.booking_date 
                              FROM bookings b 
                              JOIN users u ON b.user_id = u.id 
                              JOIN movies m ON b.movie_id = m.id");
$bookings = $bookingsStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome, Admin!</h1>

        <!-- Movies Section -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Manage Movies</h2>
                <a href="add_movie.php" class="btn btn-primary">Add Movie</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movies as $movie): ?>
                        <tr>
                            <td><?php echo $movie['id']; ?></td>
                            <td><?php echo htmlspecialchars($movie['title']); ?></td>
                            <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                            <td><?php echo htmlspecialchars($movie['duration']); ?> mins</td>
                            <td>
                                <a href="edit_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Users Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Manage Users</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bookings Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Manage Bookings</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Movie</th>
                            <th>Seats</th>
                            <th>Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo $booking['id']; ?></td>
                            <td><?php echo htmlspecialchars($booking['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($booking['movie_id']); ?></td>
                            <td><?php echo htmlspecialchars($booking['seats']); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
