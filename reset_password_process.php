<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $conn->real_escape_string($_POST['user_id']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $update_sql = "UPDATE users SET password='$password', reset_token=NULL, reset_token_expiry=NULL WHERE id='$user_id'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Password reset successfully. <a href='login.html'>Login</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
