<?php
session_start();

if (!isset($_SESSION['user_id'])) {
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

$user_id = $_SESSION['user_id']; // Assuming you have stored user_id in session after login

// Fetch user reports and admin replies
$sql = "SELECT lp.id, lp.phone_model, lp.imei, lp.last_location, lp.description, ar.reply_message
        FROM lost_phones lp
        LEFT JOIN admin_replies ar ON lp.id = ar.report_id
        WHERE lp.user_id = '$user_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<img>
    <div class="container">
        <h2 class="mt-5">Welcome, <?php echo $_SESSION['user_name']; ?></h2>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="report_lost_phone.php">Report Lost Phone to Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_admin_replies.php">View Admin Replies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_bank.php">Block Your Bank Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feedback.php">Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notifications.php">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </div>
    <img src="./images/imei8.png">
</body>
</html>
