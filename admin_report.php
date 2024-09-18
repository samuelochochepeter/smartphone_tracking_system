<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartphone_tracking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $reply_message = $_POST['reply_message'];

    // Insert reply into database
    $sql = "INSERT INTO admin_replies (user_id, reply_message) VALUES ('$user_id', '$reply_message')";

    if ($conn->query($sql) === TRUE) {
        echo "Reply submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
