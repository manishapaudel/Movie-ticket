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

/* Dropdown Menu */
.dropdown {
  position: relative;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content {
  display: none;
  position: absolute;
  top: 120%;
  left: 0;
  background: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border: 1px solid #ddd;
  border-radius: 4px;
  overflow: hidden;
  z-index: 10;
  padding: 5px 0;
}

.dropdown-content a {
  color: #333;
  padding: 8px 12px;
  text-decoration: none;
  font-size: 16px;
  display: block;
  transition: background-color 0.3s ease;
}

.dropdown-content a:hover {
  background-color: #f8f9fa;
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

.search i {
  position: absolute;
  left: 10px;
  color: #999;
  font-size: 16px;
  pointer-events: none;
}

/* Login Button */
.user-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.btn-login {
  margin-left: 10px;
  background: #007BFF;
  color: white;
  padding: 8px 20px;
  border: none;
  border-radius: 20px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.user-actions .btn-login a {
  text-decoration: none;
  color: white;
}

.user-actions .btn-login:hover {
  background: #0056b3;
}

/* Mobile Responsiveness */
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

  .dropdown-content {
    position: static;
    box-shadow: none;
    border: none;
    width: 100%;
    display: block;
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

    <div class="dropdown">
      <a href="showtimings.php">Show Timings</a>
      <div class="dropdown-content">
        <a href="showtimings.php#morning">Morning Shows</a>
        <a href="showtimings.php#afternoon">Afternoon Shows</a>
        <a href="showtimings.php#evening">Evening Shows</a>
        <a href="showtimings.php#late">Late Shows</a>
      </div>
    </div>

    <div class="dropdown">
      <a href="more.php">More</a>
      <div class="dropdown-content">
        <a href="contact.php">Contact</a>
        <a href="about-us.php">About Us</a>
        <a href="faq.php">FAQ</a>
        <a href="terms.php">Terms & Conditions</a>
      </div>
    </div>
  </div>

  <div class="user-actions">
  <div class="search">
        <form action="search_results.php" method="GET">
            <input type="text" name="query" id="search-input" placeholder="Search for movies..." required>
            <button type="submit" id="search-button">Search</button>
        </form>
    </div>

    <?php if (isset($_SESSION['email'])): ?>
      <div class="user-info">
        <i class="bi bi-person-circle" style="font-size: 1.5rem; color: #007BFF;"></i>
        <span>Welcome, <?= htmlspecialchars($_SESSION['email']) ?></span>
      </div>
    <?php else: ?>
      <button class="btn-login">
        <a href="login.php">Login</a>
      </button>
    <?php endif; ?>
  </div>
</header>



