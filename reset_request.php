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
    $email = $conn->real_escape_string($_POST['email']);

    // Check if email exists in the database
    $sql = "SELECT id, username FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $username = $row['username'];

        // Generate a unique token
        $token = bin2hex(random_bytes(32));
        $token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store token and its expiry time in the database
        $update_sql = "UPDATE users SET reset_token='$token', reset_token_expiry='$token_expiry' WHERE id='$user_id'";
        if ($conn->query($update_sql) === TRUE) {
            // Send reset email (replace with your email sending logic)
            $reset_link = "http://your_domain/reset_password.php?token=$token";
            $email_subject = "Password Reset Request";
            $email_message = "Hello $username,\n\nYou requested a password reset. Please click the link below to reset your password:\n$reset_link\n\nThis link is valid for 1 hour.\n\nIf you did not request this, please ignore this email.\n\nRegards,\nYour App Team";
            // Example using PHP mail function
            mail($email, $email_subject, $email_message);
            echo "Password reset link has been sent to your email.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "User not found with that email.";
    }
}

$conn->close();
?>
