<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $message = '';

    // Validate passwords match
    if ($password !== $retype_password) {
        $message = '<p class="error">Passwords do not match!</p>';
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        try {
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->execute([$email, $hashed_password]);
            $message = '<p class="success">Registration successful! <a href="login.php" class="link">Login here</a></p>';
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) { // Duplicate email
                $message = '<p class="error">Email is already registered!</p>';
            } else {
                $message = '<p class="error">An error occurred. Please try again later.</p>';
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
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(pink, pink, blue, blue);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .register-container {
            background: #252525;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
            text-align: center;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-weight: bold;
            color: #fff;
        }

        input {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            background: #fff;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        input:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.8);
            transform: scale(1.03);
        }

        button {
            padding: 0.8rem;
            background-color: #2575fc;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.2s ease;
            cursor: pointer;
        }

        button:hover {
            background-color: #1a5bbf;
            transform: scale(1.05);
        }

        .error {
            color: #ff4d4d;
            font-size: 0.9rem;
            text-align: center;
        }

        .success {
            color: #28a745;
            font-size: 0.9rem;
            text-align: center;
        }

        .link {
            color: #2575fc;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h1>Register</h1>
    <?php if (!empty($message)) echo $message; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <label for="retype_password">Retype Password:</label>
            <input type="password" id="retype_password" name="retype_password" placeholder="Retype your password" required>
        </div>
        <button type="submit">Register</button>
    </form>
    <div style="text-align: center; margin-top: 10px;">
        <a href="login.php" class="link">← Back to Login</a>
    </div>
</div>
</body>
</html>
