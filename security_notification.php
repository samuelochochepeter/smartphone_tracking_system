<?php
session_start();
if (!isset($_SESSION['security_id'])) {
    header("Location: login.html");
    exit();
}

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

// Fetch notifications for security agency
$sql = "SELECT * FROM admin_notifications WHERE security_agency_id = '{$_SESSION['security_id']}' ORDER BY id DESC";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Notifications</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Security Notifications
            </div>
            <div class="card-body">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="alert alert-info" role="alert">';
                        echo '<h5 class="alert-heading">Notification:</h5>';
                        echo '<p>' . $row['notification_message'] . '</p>';
                        echo '<hr>';
                        echo '<p class="mb-0">Sent on: ' . $row['notification_date'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="alert alert-info" role="alert">No notifications found.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
