<?php
session_start();
include 'config.php'; // Ensure this file contains a valid `$conn` connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Check if the database connection is valid
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // ✅ Prepare the SQL statement
    $stmt = $conn->prepare("SELECT userid, email, password FROM users WHERE email = ?");
    
    if ($stmt) {
        // ✅ Bind the email parameter
        $stmt->bind_param("s", $email);
        
        // ✅ Execute the statement
        $stmt->execute();
        
        // ✅ Bind the result variables
        $stmt->bind_result($userid, $db_email, $db_password);
        
        // ✅ Fetch the result
        if ($stmt->fetch()) {
            // ✅ Verify the password
            if (password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $userid;
                $_SESSION['email'] = $db_email;

                // ✅ Redirect after successful login
                header("Location: index.php?login_success=true");
                exit();
            } else {
                $errorMessage = "Invalid email or password.";
            }
        } else {
            $errorMessage = "Invalid email or password.";
        }

        // ✅ Close the statement
        $stmt->close();
    } else {
        die("Database query preparation failed: " . $conn->error);
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
      * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: #f8f5f0; /* Nude background color */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #3e3b37; /* Dark grayish color for text */
    padding: 1rem;
}

.container {
    background: #ffffff; /* White background for the container */
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
    color: #6a0dad; /* Purple color */
    margin-bottom: 1rem;
}

label {
    display: block;
    margin: 0.5rem 0 0.2rem;
    font-weight: bold;
    color: #3e3b37;
    text-align: left;
}

input {
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 1rem;

    border: 1px solid #ccc;
    border-radius: 4px;

    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;

}

input:focus {
    border-color: #6a0dad; /* Purple focus color */
    outline: none;
    box-shadow: 0 0 5px rgba(106, 13, 173, 0.8);
}

.btn {
    display: inline-block;
    width: 100%;
    padding: 0.8rem;
    background: #6a0dad; /* Purple background */
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
    background: #581a96; /* Darker purple on hover */
}

.link-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 1rem;
    gap: 0.5rem;
}

.link {
    color: #6a0dad; /* Purple link color */
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
    color: #6a0dad; /* Purple color for the toggle */
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
        background: #f8f5f0;
        color: #3e3b37;
    }

    .container {
        background: #ffffff;
        color: #3e3b37;
    }

    input {
        background: #fff;
        border: 1px solid #444;
        color: #111;
    }

    input:focus {
        border-color: #6a0dad;
        box-shadow: 0 0 5px rgba(106, 13, 173, 0.8);
    }

    .btn {
        background: #6a0dad;
        color: #ffffff;
    }

    .link {
        color: #6a0dad;
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

        
    // document.querySelector('form').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent actual form submission
    //     window.location.href = 'index.php'; // Redirect to index.php
    // });

    </script>
</body>
</html>