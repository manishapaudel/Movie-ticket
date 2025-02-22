<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'config.php';

// Fetch admin details
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Initialize arrays
$movies = [];
$users = [];
$bookings = [];

// Fetch movies
$moviesStmt = $conn->prepare("SELECT * FROM movies");
$moviesStmt->execute();
$resultMovies = $moviesStmt->get_result();
while ($row = $resultMovies->fetch_assoc()) {
    $movies[] = $row;
}

// Fetch users
$usersStmt = $conn->prepare("SELECT * FROM users");
$usersStmt->execute();
$resultUsers = $usersStmt->get_result();
while ($row = $resultUsers->fetch_assoc()) {
    $users[] = $row;
}

// Fetch bookings with user and movie details
$bookingsStmt = $conn->prepare("
    SELECT b.id, u.email as user_email, m.title as movie_title, b.seats, b.booking_date 
    FROM bookings b 
    JOIN users u ON b.user_id = u.id 
    JOIN movies m ON b.movie_id = m.id
");
$bookingsStmt->execute();
$resultBookings = $bookingsStmt->get_result();
while ($row = $resultBookings->fetch_assoc()) {
    $bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </nav>

    <!-- Dashboard Container -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome, <?php echo htmlspecialchars($admin['email']); ?>!</h1>

        <!-- Statistics Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center bg-primary text-white">
                    <div class="card-body">
                        <h2><?php echo count($movies); ?></h2>
                        <p>Movies</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center bg-success text-white">
                    <div class="card-body">
                        <h2><?php echo count($users); ?></h2>
                        <p>Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center bg-danger text-white">
                    <div class="card-body">
                        <h2><?php echo count($bookings); ?></h2>
                        <p>Bookings</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs for Movies, Users, and Bookings -->
        <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="movies-tab" data-bs-toggle="tab" data-bs-target="#movies" type="button" role="tab" aria-controls="movies" aria-selected="true">Movies</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="false">Users</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bookings-tab" data-bs-toggle="tab" data-bs-target="#bookings" type="button" role="tab" aria-controls="bookings" aria-selected="false">Bookings</button>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Movies Tab -->
            <div class="tab-pane fade show active" id="movies" role="tabpanel" aria-labelledby="movies-tab">
                <a href="add_movie.php" class="btn btn-primary mb-3">Add Movie</a>
                
                <table id="moviesTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th>Poster</th>
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
                            <td><?php echo htmlspecialchars($movie['description']); ?></td>
                            <td><img src="/uploads/<?php echo htmlspecialchars($movie['poster']); ?>" alt="Poster" width="50"></td>
                            <td>
                                <a href="edit_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                <table id="usersTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $user['id']; ?>">Edit</button>
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                        <!-- Edit User Modal -->
                        <div class="modal fade" id="editUserModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?php echo $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel<?php echo $user['id']; ?>">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="edit_user.php" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <div class="mb-3">
                                                <label for="userEmail<?php echo $user['id']; ?>" class="form-label">Email</label>
                                                <input type="email" name="email" id="userEmail<?php echo $user['id']; ?>" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="userPassword<?php echo $user['id']; ?>" class="form-label">Password</label>
                                                <input type="text" name="password" id="userPassword<?php echo $user['id']; ?>" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bookings Tab -->
            <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
                <table id="bookingsTable" class="table table-bordered table-striped">
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
                            <td><?php echo htmlspecialchars($booking['user_email']); ?></td>
                            <td><?php echo htmlspecialchars($booking['movie_title']); ?></td>
                            <td><?php echo htmlspecialchars($booking['seats']); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#moviesTable').DataTable();
            $('#usersTable').DataTable();
            $('#bookingsTable').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
