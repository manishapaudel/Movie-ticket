<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="register_process.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="Login.php">Login here</a></p>
    </div>
</body>
</html>