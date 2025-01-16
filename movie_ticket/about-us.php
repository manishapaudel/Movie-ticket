<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Phoenix Cinemas</title>
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #444;
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
      color: #007BFF;
    }
    .about-content {
      display: flex;
      gap: 20px;
      align-items: center;
    }
    .about-content img {
      max-width: 300px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .about-text {
      flex: 1;
    }
    .about-text p {
      font-size: 16px;
      line-height: 1.8;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <h1>About Us</h1>
    <div class="about-content">
      <img src="phoenix.png" alt="Cinema">
      <div class="about-text">
        <p>Welcome to Phoenix Cinemas, your ultimate destination for entertainment and relaxation. We provide a luxurious cinema experience, featuring state-of-the-art theaters, premium sound systems, and unmatched comfort.</p>
        <p>Our mission is to deliver unforgettable moments through movies, creating memories that last a lifetime. Visit us and experience the magic of cinema like never before.</p>
      </div>
    </div>
  </div>
 
</body>
</html>
