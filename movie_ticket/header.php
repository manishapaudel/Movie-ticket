<style>
  /* General Reset */
/* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background-color: #f8f9fa;
  color: #333;
}

/* Header Section */
.header {
  background: #ffffff;
  padding: 10px 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.logo img {
  height: 50px;
  width: auto;
}

.nav {
  display: flex;
  align-items: center;
  gap: 30px;
}

.nav a {
  text-decoration: none;
  color: #333;
  font-size: 1rem;
  font-weight: 500;
  padding: 10px 15px;
  transition: all 0.3s ease;
  position: relative;
}

.nav a:hover {
  color: #007BFF;
  background-color: #f1f1f1;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 123, 255, 0.1);
}

/* Dropdown Menu Styling */
.dropdown {
  position: relative;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #ffffff;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  min-width: 180px;
  border-radius: 5px;
  padding: 10px 0;
  z-index: 1;
  transition: opacity 0.3s ease-in-out;
  opacity: 0;
}

.dropdown-content a {
  color: #333;
  padding: 12px 20px;
  text-decoration: none;
  font-size: 0.9rem;
  display: block;
  transition: background-color 0.3s ease;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
  color: #007BFF;
}

.dropdown:hover .dropdown-content {
  opacity: 1;
}

/* Search and Login Section */
.user-actions {
  display: flex;
  align-items: center;
  gap: 15px;  /* Space between search and login button */
}

.search {
  position: relative;
  display: flex;
  align-items: center;
}

.search input[type="text"] {
  padding: 10px 15px 10px 40px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 30px;
  outline: none;
  width: 220px;
  transition: border-color 0.3s ease;
}

.search input[type="text"]:focus {
  border-color: #007BFF;
}

.search i {
  position: absolute;
  left: 12px;
  color: #999;
  font-size: 18px;
  pointer-events: none;
}

/* Login Button */
.user-actions .btn-login {
  background: #007BFF;
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  font-size: 1rem;
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
    padding: 10px 1rem;
  }

  .nav {
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
  }

  .nav a {
    padding: 8px 10px;
  }

  .dropdown-content {
    position: static;
    box-shadow: none;
    padding: 5px;
    width: 100%;
    opacity: 1;
    display: block;
  }

  .dropdown-content a {
    padding: 8px 15px;
  }

  .search input[type="text"] {
    width: 180px;
  }

  .user-actions {
    flex-direction: column;
    gap: 10px;  /* Stack search and login on small screens */
  }
}


</style>


<header class="header">
  <div class="logo">
    <img src="phoenix.png" alt="Phoenix Logo">
  </div>

  <div class="nav">
    <a href="#">Home</a>
    
    <!-- Show Timings Section with Dropdown -->
    <div class="dropdown">
      <a href="#">Show Timings</a>
      <div class="dropdown-content">
        <a href="#">Morning Shows</a>
        <a href="#">Afternoon Shows</a>
        <a href="#">Evening Shows</a>
        <a href="#">Late Shows</a>
      </div>
    </div>

    <!-- More Section with Dropdown -->
    <div class="dropdown">
      <a href="#">More</a>
      <div class="dropdown-content">
        <a href="contact.html">Contact</a>
        <a href="about-us.html">About Us</a>
        <a href="faq.html">FAQ</a>
        <a href="terms.html">Terms & Conditions</a>
      </div>
    </div>
  </div>

  <div class="user-actions">
    <div class="search">
      <i class="bi bi-search"></i>
      <input type="text" placeholder="Search...">
    </div>
    <div><button class="btn-login"><a href="login.php">Login</a></button></div>
  </div>
</header>
