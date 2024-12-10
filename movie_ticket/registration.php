<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];

    // Validate inputs
    if ($password !== $retype_password) {
        $message = "<div class='error'>Passwords do not match!</div>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->execute([$email, $hashed_password]);
            $message = "<div class='success'>Registration successful! <a href='Login.php'>Login here</a></div>";
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) { // Duplicate entry
                $message = "<div class='error'>Email is already registered!</div>";
            } else {
                $message = "<div class='error'>An error occurred: " . htmlspecialchars($e->getMessage()) . "</div>";
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
    <title>Register</title>
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f9f9f9;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #007BFF;
        }
        label {
            display: block;
            font-size: 0.9rem;
            text-align: left;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 0.7rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            box-sizing: border-box;
        }
        input:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        button {
            width: 100%;
            padding: 0.7rem;
            font-size: 1rem;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .error, .success {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border-radius: 5px;
        }
        .error {
            color: #ff0000;
            background: #ffe6e6;
        }
        .success {
            color: #28a745;
            background: #e6ffed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <?php if (isset($message)) echo $message; ?>
        <form method="POST" action="">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <label for="retype_password">Retype Password</label>
            <input type="password" id="retype_password" name="retype_password" required>
            
            <button type="submit">Register</button>
        </form>
        <a href="Login.php">Already have an account? Login here</a>
    </div>
</body>
</html>