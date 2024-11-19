<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .login-container {
            border: 3px solid #ccc;
            background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(loginbackground.jpg);
            padding: 30px;
            width: 90%;
            height: 90%;
            margin: 0 auto;
            background-size: cover; /* Adjust as needed */
    background-position: center; /* Adjust as needed */
    background-repeat: no-repeat;
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
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #fff;

        }

        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container p {
            text-align: center;
            color: #fff;

        }

    </style>
</head>
<body>

    <div class="login-container"> 

        <h2>Login</h2>
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