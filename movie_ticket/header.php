<?php 
// Start session at the very beginning (before any HTML output)
// session_start();  
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>

<style>
/* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background-color: #f9f9f9;
  color: #333;
}

/* Header Section */
.header {
  background: #ffffff;
  padding: 10px 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.logo img {
  height: 40px;
  width: auto;
}

/* Navigation Menu */
.nav {
  display: flex;
  align-items: center;
  gap: 25px;
}

.nav a {
  text-decoration: none;
  color: #333;
  font-size: 18px;
  font-weight: 500;
  padding: 8px 12px;
  transition: all 0.3s ease;
}

.nav a:hover {
  color: #007BFF;
  border-bottom: 2px solid #007BFF;
}

/* Search Bar */
.search {
  display: flex;
  align-items: center;
  position: relative;
}

.search input[type="text"] {
  padding: 8px 12px;
  font-size: 0.95rem;
  border: 1px solid #ccc;
  border-radius: 20px;
  outline: none;
  width: 200px;
  transition: border-color 0.3s ease;
}

.search input[type="text"]:focus {
  border-color: #007BFF;
}

/* User Actions */
.user-actions {
  display: flex;
  align-items: center;
  gap: 15px;
}

/* User Info Section */
.user-info {
  display: flex;
  align-items: center;
  background: #f8f9fa;
  padding: 8px 15px;
  border-radius: 20px;
  gap: 10px;
  font-size: 16px;
  font-weight: 500;
  color: #333;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.user-info i {
  font-size: 1.3rem;
  color: #007BFF;
}

.user-info:hover {
  transform: scale(1.05);
}

/* Styled Logout Button */
.btn-logout {
  display: inline-block;
  background: #dc3545;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 20px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  text-decoration: none;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-logout:hover {
  background: #c82333;
  transform: translateY(-2px);
}

/* Styled Login Button */
.btn-login {
  background: #007BFF;
  color: white;
  padding: 8px 20px;
  border: none;
  border-radius: 20px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-login a {
  text-decoration: none;
  color: white;
}

.btn-login:hover {
  background: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
  .header {
    flex-direction: column;
    align-items: flex-start;
    padding: 10px 1rem;
  }

  .nav {
    flex-direction: column;
    gap: 15px;
    align-items: flex-start;
  }

  .search input[type="text"] {
    width: 100%;
  }

  .user-actions {
    flex-direction: column;
    gap: 10px;
  }
}
</style>


<header class="header">
  <div class="logo">
    <img src="phoenix.png" alt="Phoenix Logo">
  </div>

  <div class="nav">
    <a href="index.php">Home</a>
    <a href="about-us.php">About Us</a>
  </div>

  <div class="user-actions">
    <div class="search">
      <form action="search_results.php" method="GET">
        <input type="text" name="query" id="search-input" placeholder="Search for movies..." required>
      </form>
    </div>

    <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
      <!-- Show user email with person icon and styled Logout button -->
      <div class="user-info">
        <i class="bi bi-person-circle"></i> 
        <span id="welcome-message">
          <?php echo "Hello, " . htmlspecialchars($_SESSION['email']); ?>
        </span>
        <a href="logout.php" class="btn-logout">Logout</a>
      </div>
    <?php else: ?>
      <!-- Show Login button if NOT logged in -->
      <button class="btn-login">
        <a href="login.php">Login</a>
      </button>
    <?php endif; ?>
  </div>
</header>

</body>
</html>
