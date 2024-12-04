<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to access your account on My Website.">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Fallback for background image */
        }

        .login-container {
            border: 3px solid #ccc;
            background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(loginbackground.jpg);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            margin: 5% auto;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .login-container h2 {
            text-align: center;
            color: #fff;
        }

        .login-container form {
            text-align: center;
            color: #fff;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2); /* Slightly more opaque for better contrast */
            color: #fff;
        }

        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .login-container p {
            text-align: center;
            color: #fff;
        }

        .login-container a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
            echo "<p style='color: red; text-align: center;'>Invalid username or password. Please try again.</p>";
        } elseif (isset($_GET['error']) && $_GET['error'] === 'empty_fields') {
            echo "<p style='color: red; text-align: center;'>Please fill in all required fields.</p>";
        }
        ?>
        <form action="loginprocess.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</body>
</html>
