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

if (!empty($code)) {
    $sql = "SELECT * FROM form_data WHERE random_string='$code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. "<br>Field1: " . $row["field1"]. "<br>Field2: " . $row["field2"]. "<br>Field3: " . $row["field3"]. "<br>Created At: " . $row["created_at"]. "<br>";
        }
    } else {
        echo "No records found";
    }
} else {
    echo "Invalid code";
}

$conn->close();
?>
