<?php
session_start();
include 'config.php'; // Include your database connection

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check credentials
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin) {
        if (password_verify($password, $admin["password"])) {
            // Set session and redirect to admin dashboard
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = 'Password does not match.';
        }
    } else {
        $error = 'No email address found.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
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
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-weight: bold;
            color: #fff;
        }

        input[type="email"],
        input[type="password"] {
            width: 94%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            background: #333;
            color: #f5f5f5;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
        }

        input:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.8);
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background-color: #2575fc;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        button:hover {
            background-color: #1a5bbf;
        }

        .error {
            color: #ff4d4d;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .link {
            color: #2575fc;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.8rem;
            }
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(blue, pink);
                color: #f5f5f5;
            }

            .login-container {
                background: #252525;
                color: #f5f5f5;
            }

            input {
                background: #333;
                border: 1px solid #444;
                color: #f5f5f5;
            }

            input:focus {
                border-color: #2575fc;
                box-shadow: 0 0 5px rgba(37, 117, 252, 0.8);
            }

            button {
                background: #2575fc;
                color: #ffffff;
            }

            .link {
                color: #2575fc;
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Admin Login</h1>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <div style="text-align: center; margin-top: 10px;">
        <a href="index.php" class="link">← Back to Home</a>
    </div>
</div>
</body>
</html>
