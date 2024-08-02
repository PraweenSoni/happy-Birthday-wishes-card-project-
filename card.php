<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carddata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$code = isset($_GET['code']) ? $conn->real_escape_string($_GET['code']) : '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Greeting Card</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <h2>Click this card</h2>
  <div class="body">
    <div class="birthdayCard">
      <div class="cardFront">
      <?php

        if (!empty($code)) {
        $sql = "SELECT * FROM form_data WHERE random_string='$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        echo "<h3 id='title' class='happy'>" . htmlspecialchars($row["field0"]) . "</h3>";
        ?>
        <!-- <h3 class="happy">HAPPY BIRTH 🎂</h3> -->
        <div class="balloons">
          <div class="balloonOne"></div>
          <div class="balloonTwo"></div>
          <div class="balloonThree"></div>
          <div class="balloonFour"></div>
        </div>
      </div>
      <div class="cardInside">
        <!-- <h3 class="back">HAPPY BIRTHDAY 🎂</h3> -->
        <?php
              echo "<h3 id='title' class='back'>" . htmlspecialchars($row["field0"]) . "</h3>";
              // echo "<h2>ID: " . htmlspecialchars($row["id"]) . "</h2>";
              // echo "<p><strong>Field3:</strong> " . htmlspecialchars($row["field3"]) . "</p>";
              echo "<p id='title'>" . htmlspecialchars($row["field1"]) . "</p>";
              echo "<p id='desc'>" . htmlspecialchars($row["field2"]) . "</p>";
              echo "<p id='name' class='name'>" . htmlspecialchars($row["field3"]) . "</p>";
              // echo "<p><strong>Created At:</strong> " . htmlspecialchars($row["created_at"]) . "</p>";
            }
          } else {
            echo "<p>Wrong URL! Please Check URL.</p>";
          }
        } else {
          echo "<p>Invalid URL</p>";
        }

        $conn->close();
        ?>
      </div>
    </div>
  </div>
  <footer>Create Your Card <a href="http://wishcard.free.nf"> Click here...</a>
    <!-- <script src="script.js"></script> -->
</body>

</html>