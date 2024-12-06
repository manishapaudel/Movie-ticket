<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .login-container {
            border: 3px solid #ccc;
            background: #fff;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            margin: 5% auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
            background-color: #f9f9f9;
        }

        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        .login-container p {
            text-align: center;
        }

        .login-container a {
            font-weight: bold;
            color: #4CAF50;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
</style>

    <div class="login-container">
        <h2>Register</h2>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'username_taken') {
                echo "<p style='color: red; text-align: center;'>Username is already taken. Please choose another.</p>";
            }
        }
        ?>
        <form action="register_process.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Password must contain at least one number, one uppercase and lowercase letter, and at least 8 characters.">
            <br><br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="Login.php">Login here</a></p>
    </div>

