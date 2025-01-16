<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms & Conditions - Phoenix Cinemas</title>
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
    p {
      font-size: 16px;
      line-height: 1.8;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      margin: 10px 0;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <h1>Terms & Conditions</h1>
    <ul>
      <li>1. Tickets once purchased cannot be refunded.</li>
      <li>2. Entry to the theater is allowed only with a valid ticket.</li>
      <li>3. No outside food or drinks are allowed inside the theater premises.</li>
    </ul>
  </div>
 
</body>
</html>
