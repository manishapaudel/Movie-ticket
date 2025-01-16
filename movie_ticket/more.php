<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>More - Phoenix Cinemas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }
    header {
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
    .section-header {
      text-align: center;
      margin: 20px 0;
      font-size: 30px;
      font-weight: bold;
      color: #007BFF;
    }
    .more-options {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .more-options ul {
      list-style-type: none;
      padding: 0;
    }
    .more-options ul li {
      margin-bottom: 15px;
    }
    .more-options ul li a {
      text-decoration: none;
      color: #007BFF;
      font-size: 18px;
    }
    .more-options ul li a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="section-header">More Options</div>
  <div class="more-options">
    <ul>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="about-us.php">About Us</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="terms.php">Terms & Conditions</a></li>
    </ul>
  </div> 

</body>
</html>
