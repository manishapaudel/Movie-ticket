<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        
        echo "<div style='font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4; color: #333;'>
                <div style='background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; text-align: center;'>
                    <div style='font-size: 1.2rem; color: #28a745; background: #e6ffed; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem;'>
                        Login successful! Welcome, " . htmlspecialchars($user['email']) . ".
                    </div>
                    <a href='index.php' style='display: inline-block; padding: 0.7rem 1.5rem; font-size: 1rem; background: #007BFF; color: #fff; text-decoration: none; border-radius: 5px; transition: background 0.3s;'>Go to Dashboard</a>
                </div>
            </div>";
<<<<<<< HEAD
             
=======
        
        
>>>>>>> ea0313745a3790d74d2ccf52bacf100b03b0f20c
    } else {
        echo "<div class='error'>Invalid email or password!</div>";
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
        /* Minimalist CSS */
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
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <a href="registration.php" class="link">Don't have an account? Register here</a>
    </div>
</body>
</html>