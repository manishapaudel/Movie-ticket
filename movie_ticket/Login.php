<<<<<<< HEAD
=======
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

>>>>>>> 1475f07972649bb064dce3b5850f6171188fdbc1
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            padding: 1rem;
        }

        .container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 2rem;
            color: #2575fc;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            font-weight: bold;
            color: #333;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
<<<<<<< HEAD
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
=======
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
>>>>>>> 1475f07972649bb064dce3b5850f6171188fdbc1
        }

        input:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.8rem;
            background: #2575fc;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 1rem;
        }

        .btn:hover {
            background: #1a5bbf;
        }

        .link-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 1rem;
            gap: 0.5rem;
        }

        .link {
            color: #2575fc;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .link:hover {
            text-decoration: underline;
        }

        .password-container {
            position: relative;
            margin-bottom: 1rem;
        }

        .password-container input {
            padding-right: 2.5rem;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1rem;
            color: #2575fc;
        }

        .error {
            color: #ff4d4d;
            margin-bottom: 1rem;
        }

        .success {
            color: #28a745;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
            }
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1e1e2f, #343459);
                color: #f5f5f5;
            }

            .container {
                background: #252525;
                color: #f5f5f5;
            }

            input {
                background: #fff;
                border: 1px solid #444;
                color: #111;
            }

            input:focus {
                border-color: #2575fc;
                box-shadow: 0 0 5px rgba(37, 117, 252, 0.8);
            }

            .btn {
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
    <div class="container">
        <h1>Login</h1>

        <?php if (isset($successMessage)): ?>
            <div class="success"> <?= htmlspecialchars($successMessage) ?> </div>
            <a href="index.php" class="btn">Go to Dashboard</a>
        <?php else: ?>
            <?php if (isset($errorMessage)): ?>
                <div class="error"> <?= htmlspecialchars($errorMessage) ?> </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter Email" required>

                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Enter Password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <a href="admin_login.php" class="btn">Login as Admin</a>

            <div class="link-container">
                <a href="registration.php" class="link">Don't have an account? Register here</a>
                <a href="index.php" class="link">Back to Home</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerHTML = '&#128584;';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerHTML = '&#128065;';
            }
        }
        
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent actual form submission
        window.location.href = 'index.php'; // Redirect to index.php
    });

    </script>
</body>
</html>
