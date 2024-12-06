<style>

  /* Header Section */

.header {
  background: #fff;
  color: #fff;
  padding: 1rem 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Logo Section */

.logo {
  display: flex;
  align-items: center;
}

.logo img {
  height: 50px;
  margin-right: 10px;
}

/* Search Section */

.search {
  position: relative;
  display: flex;
  align-items: center;
}

.search input[type="text"] {
  padding: 10px 15px 10px 35px; /* Adjust left padding for icon */
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 20px;
  outline: none;
  width: 200px;
}

.search i {
  position: absolute;
  left: 10px; /* Position icon on the left */
  color: #666;
  font-size: 18px;
  pointer-events: none; /* Prevent icon from blocking input clicks */
}

/*user actions*/

.user-actions {
  display: flex;
  align-items: center;
  gap: 20px; /* Space between search and login button */
}

</style>

<header class="header">
  <div class="logo">
    <img src="phoenix.png" alt="Phoenix Logo">
  </div>
  <div class="nav">
      <a href="#">Home </a>
      <a href="#">Showtimings </a>
      <a href="#">Cinemas </a>
      <a href="#">More </a>
  </div>

  <div class="user-actions">
    <div class="search">
      <i class="bi bi-search"></i>
      <input type="text" placeholder="Search...">
    </div>
    <button class="btn-login">Login</button>
  </div>
</header>



