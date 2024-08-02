<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "carddata"; 
date_default_timezone_set('Asia/Kolkata');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query("SET time_zone = '+05:30';");

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // SQL query to count the number of forms submitted by the user
    $sql = "SELECT created_at, random_string FROM form_data WHERE user_id = ? ORDER BY created_at ASC";
    $stmt = $conn->prepare($sql);
    $form_count = 0;
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($created_at, $random_string);

        $tableRows = "";
        while ($stmt->fetch()) {
            $form_count++;
            $tableRows .= '<tr>';
            $tableRows .= '<td>' . htmlspecialchars($form_count) . '</td>';
            $tableRows .= '<td>' . htmlspecialchars($created_at) . '</td>';
            $tableRows .= '<td><a href="card.php?code=' . urlencode($random_string) . '" target="_blank">View Card</a></td>';
            $tableRows .= '</tr>';
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "User is not logged in.";
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="inc/footer.css">
    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'submit.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        // Append the new row to the table
                        $('#responseMessage tbody').append(data);
                    },
                    error: function() {
                        alert('Error submitting form');
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php require('inc/header.php') ?>
    <br><br><br>
    <section class="header">
        <div class="wrapper">
            <div class="header-grid">
                <div>
                    <h1>Dashboard</h1>
                    <p class="header-total">Welcome, <?php echo $_SESSION['username']; ?></p>
                </div>
            </div>
        </div>
    </section>
    <section class="top-cards">
        <div class="wrapper">
            <div class="grid">
                <article class="card facebook">
                    <p class="card-title">
                        Total Clicks
                    </p>
                    <p class="card-followers">
                        <span class="card-followers-number">000</span>
                        <span class="card-followers-title">Page views</span>
                    </p>
                    <p class="card-today">
                        Coming Soon
                    </p>
                </article>
                <article class="card instagram">
                    <p class="card-title">
                        Card Created
                    </p>
                    <p class="card-followers">
                        <span class="card-followers-number"><?php echo $form_count ?></span>
                        <span class="card-followers-title">Total Cards</span>
                    </p>
                    <p class="card-today">
                        <!-- comming soon -->
                    </p>
                </article>
                <!-- 
                    <article class="card youtube">
                    </article> -->
            </div>
        </div>
    </section>
    <hr>
    <section>
        <div class="container">
            <div class="screen">
                <div class="screen-body">
                    <div class="screen-body-item left">
                        <div class="app-title">
                            <span>CREATED</span>
                            <span>CARDS</span>
                        </div>
                        <div class="createdCardList" id="responseMessage" name="form_all_sub">
                            <table>
                                <thead>
                                    <tr>
                                        <th>S no.</th>
                                        <th>Created Date/Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo isset($tableRows) ? $tableRows : ''; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="app-contact" style="color: red;">Note: We have made changes to our code/database to enhance functionality further. Therefore, your previous link will not be visible anymore, but you can generate a new card. If you have saved your link, it will work properly.</div>
                        <hr>
                        <details style="font-size: 12px; color: red;">
                            <summary>Notice in Hinglish</summary>
                             Humne apne code/database mein changes kiye hain taaki aur bhi zyada functionality mil sake. Isliye, aapka pichhla link ab dikhai nahi dega, lekin aap ek naya card generate kar sakte hain. Agar aapne apna purana link save kiya hai, toh wo sahi tarike se kaam karega.
                        </details>
                        <div class="app-contact">Note : Card Validity only 7 days</div>
                    </div>
                    <div class="screen-body-item">
                        <div class="app-title">
                            <span>CREATE</span>
                            <span>CARD</span>
                        </div>
                        <form id="myForm">
                            <!-- <form action="submit.php" method="POST"> -->
                            <div class="app-form">
                                <div class="app-form-group">
                                    <input class="app-form-control" required name="field0" placeholder="CARD NAME" value="HAPPY BIRTHDAY 🎂">
                                </div>
                                <div class="app-form-group">
                                    <input class="app-form-control" required name="field1" placeholder="NAME">
                                </div>
                                <div class="app-form-group">
                                    <input class="app-form-control" required name="field3" placeholder="YOUR NAME">
                                </div>
                                <div class="app-form-group message">
                                    <input class="app-form-control" required name="field2" placeholder="MESSAGE (MAX LENGTH 255-CHARACTERS)">
                                    <!-- <textarea name="" id="" cols="50" rows="10" placeholder="MESSAGE"></textarea> -->
                                </div>
                                <div class="app-form-group buttons">
                                    <button type="submit" class="app-form-button">CREATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require('inc/footer.php') ?>
    <!-- <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'submit.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage tbody').append(response);
                        $('#myForm')[0].reset(); 
                    }
                });
            });
        });
    </script> -->
    <script src="script.js"></script>
</body>

</html>