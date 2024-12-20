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
$bookingsStmt = $conn->query("SELECT b.id, u.name as user_name, m.title as movie_title, b.seats, b.booking_date 
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <!-- <p>Email: <?php echo htmlspecialchars($admin['email']); ?></p> -->

    <h2>Manage Movies</h2>
    <a href="add_movie.php" class="btn">Add Movie</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?php echo $movie['id']; ?></td>
            <td><?php echo htmlspecialchars($movie['title']); ?></td>
            <td><?php echo htmlspecialchars($movie['genre']); ?></td>
            <td><?php echo htmlspecialchars($movie['duration']); ?> mins</td>
            <td>
                <a href="edit_movie.php?id=<?php echo $movie['id']; ?>" class="btn">Edit</a>
                <a href="delete_movie.php?id=<?php echo $movie['id']; ?>" class="btn" style="background: #dc3545;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Manage Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Manage Bookings</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Movie</th>
            <th>Seats</th>
            <th>Booking Date</th>
        </tr>
        <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
            <td><?php echo htmlspecialchars($booking['movie_title']); ?></td>
            <td><?php echo htmlspecialchars($booking['seats']); ?></td>
            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="logout.php" class="btn" style="background: #dc3545;">Logout</a>
</body>
</html>
