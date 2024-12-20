<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database configuration
    include 'config.php';

    try {
        // Check if email and password are provided
        if (!isset($_POST['email']) || empty(trim($_POST['email'])) || 
            !isset($_POST['password']) || empty(trim($_POST['password']))) {
            throw new Exception("Email and password are required.");
        }

        // Sanitize and validate the input
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and the password matches
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $successMessage = "Login successful! Welcome, " . htmlspecialchars($user['email']);
        } else {
            $errorMessage = "Invalid email or password.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.7rem;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 4px;
            margin-top: 1rem;
        }
        .btn:hover {
            background: #0056b3;
        }
        .link {
            margin-top: 1rem;
            display: block;
            color: #007BFF;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        .error {
            color: #FF0000;
            margin-bottom: 1rem;
        }
        .success {
            color: #28a745;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($successMessage)): ?>
            <div class="success"><?= htmlspecialchars($successMessage) ?></div>
            <a href="index.php" class="btn">Go to Dashboard</a>
        <?php else: ?>
            <?php if (isset($errorMessage)): ?>
                <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Enter Email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter Password" required>
                <button type="submit" class="btn">Login</button>
            </form>
            <a href="registration.php" class="link">Don't have an account? Register here</a><br>
            <a href="admin_login.php" class="link">Login as Admin</a>
        <?php endif; ?>
    </div>
</body>
</html>
