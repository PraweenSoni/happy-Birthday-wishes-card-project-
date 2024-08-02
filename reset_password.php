<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carddata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);

    // Check if token exists in the database and is valid
    $sql = "SELECT id FROM users WHERE reset_token='$token' AND reset_token_expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Token is valid, allow user to reset password
        $user_id = $result->fetch_assoc()['id'];
        echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reset Password</title>
    </head>
    <body>
        <h1>Reset Your Password</h1>
        <form action='reset_password_process.php' method='post'>
        <input type='hidden' name='user_id' value='$user_id'>
        <label for='password'>New Password:</label>
        <input type='password' id='password' name='password' required><br><br>
        <input type='submit' value='Reset Password'>
    </form>
    </body>
    </html>";
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Token not provided.";
}

$conn->close();
