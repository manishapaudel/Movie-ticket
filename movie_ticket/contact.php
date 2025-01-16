<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Phoenix Cinemas</title>
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #444;
    }
    header {
      background-color: #007BFF;
      color: #fff;
      padding: 15px;
      text-align: center;
    }
    .container {
      max-width: 900px;
      margin: 50px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #333;
    }
    p {
      font-size: 16px;
      line-height: 1.8;
      text-align: center;
    }
    .contact-card {
      display: flex;
      justify-content: space-around;
      margin-top: 20px;
    }
    .card {
      background: #f4f4f4;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      width: 250px;
      transition: 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    .card h3 {
      color: #007BFF;
      margin-bottom: 10px;
    }
    .card p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <h1>Contact Us</h1>
    <p>We’d love to hear from you! Feel free to get in touch with us for any queries or assistance.</p>
    <div class="contact-card">
      <div class="card">
        <h3>Email</h3>
        <p>support@phoenixcinemas.com</p>
      </div>
      <div class="card">
        <h3>Phone</h3>
        <p>+1 234 567 890</p>
      </div>
      <div class="card">
        <h3>Location</h3>
        <p>123 Phoenix Street, New York, USA</p>
      </div>
    </div>
  </div>
 
</body>
</html>
