<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Timings - Phoenix Cinemas</title>
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
    .show-timings {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .show-timing-section {
      margin-bottom: 20px;
    }
    .show-timing-section h2 {
      font-size: 20px;
      color: #007BFF;
      margin-bottom: 10px;
    }
    .show-timing-section ul {
      list-style-type: none;
      padding: 0;
    }
    .show-timing-section ul li {
      margin-bottom: 5px;
      padding: 5px;
      background: #f4f4f4;
      border-radius: 5px;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="section-header">Show Timings</div>
  <div class="show-timings">
    <div class="show-timing-section">
      <h2>Morning Shows</h2>
      <ul>
        <li>9:00 AM - 11:30 AM</li>
        <li>10:00 AM - 12:00 PM</li>
      </ul>
    </div>
    <div class="show-timing-section">
      <h2>Afternoon Shows</h2>
      <ul>
        <li>12:00 PM - 2:30 PM</li>
        <li>1:00 PM - 3:30 PM</li>
      </ul>
    </div>
    <div class="show-timing-section">
      <h2>Evening Shows</h2>
      <ul>
        <li>4:00 PM - 6:30 PM</li>
        <li>5:00 PM - 7:30 PM</li>
      </ul>
    </div>
    <div class="show-timing-section">
      <h2>Late Shows</h2>
      <ul>
        <li>8:00 PM - 10:30 PM</li>
        <li>9:00 PM - 11:30 PM</li>
      </ul>
    </div>
  </div>
  
</body>
</html>
