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

function generateRandomString($length = 8) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field1 = $conn->real_escape_string($_POST['field1']);
    $field2 = $conn->real_escape_string($_POST['field2']);
    $field3 = $conn->real_escape_string($_POST['field3']);
    $created_at = date('Y-m-d H:i:s');
    $random_string = generateRandomString();

    $sql = "INSERT INTO form_data (field1, field2, field3, created_at, random_string) VALUES ('$field1', '$field2', '$field3', '$created_at', '$random_string')";
    if ($conn->query($sql) === TRUE) {
        echo "Your card created successfully. <a href='card.php?code=$random_string' target='_blank'>View Record</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
