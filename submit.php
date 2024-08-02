<?php
session_start(); // Ensure you start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

date_default_timezone_set('Asia/Kolkata');

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

function generateRandomString($length = 8) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

$conn->query("SET time_zone = '+05:30';");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $field0 = $conn->real_escape_string($_POST['field0']);
    $field1 = $conn->real_escape_string($_POST['field1']);
    $field2 = $conn->real_escape_string($_POST['field2']);
    $field3 = $conn->real_escape_string($_POST['field3']);
    $created_at = date('Y-m-d H:i:s');
    $random_string = generateRandomString();

    $sql = "INSERT INTO form_data (user_id, field0, field1, field2, field3, created_at, random_string) VALUES ('$user_id', '$field0', '$field1', '$field2', '$field3', '$created_at', '$random_string')";

    if ($conn->query($sql) === TRUE) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($form_count) . '</td>';
        echo '<td>' . htmlspecialchars($created_at) . '</td>';
        echo '<td><a href="card.php?code=' . urlencode($random_string) . '" target="_blank">View Card</a></td>';
        echo '</tr>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
