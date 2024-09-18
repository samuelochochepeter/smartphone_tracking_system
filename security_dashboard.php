<?php
session_start();
if (!isset($_SESSION['security_id'])) {
    header("Location: security_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Agency Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Security Agency Dashboard</h2>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="security_report.php">Admin Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="security_notification.php">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </div>
    <img src="./images/police2.jpg " width="100%">
</body>
</html>
