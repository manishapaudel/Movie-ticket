<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - Phoenix Cinemas</title>
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #444;
    }
    .container {
      max-width: 800px;
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
    ul {
      list-style-type: none;
      padding: 0;
    }
    li {
      margin: 15px 0;
      font-size: 16px;
    }
    li strong {
      color: #007BFF;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <h1>Frequently Asked Questions (FAQ)</h1>
    <ul>
      <li><strong>Q:</strong> What are your ticket prices?<br><strong>A:</strong> Prices vary depending on the time and show. Visit the Show Timings page for details.</li>
      <li><strong>Q:</strong> Do you offer discounts?<br><strong>A:</strong> Yes, discounts are available for students and senior citizens with valid ID proof.</li>
      <li><strong>Q:</strong> Can I cancel or change my booking?<br><strong>A:</strong> Tickets are non-refundable, but you can reschedule if done 24 hours in advance.</li>
    </ul>
  </div>
  
</body>
</html>
