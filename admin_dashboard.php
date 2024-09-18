<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* body { */
            /* position: relative; Ensure the pseudo-element is positioned relative to the body */
            /* background: rgba(0, 0, 0, 0.5); This provides a dark overlay for the body */
            /* font-family: Arial, sans-serif; */
        /* } */
        
        /* body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('./images/phone2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            opacity: 2.0; /* Adjust this value to set the desired opacity */
            /* z-index: -3; Ensure the background image stays behind all content */
        /* } */ 
 body {
            background-image: url('./images/phone2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
        }
        nav {
            background-color: #343a40; /* Background color for the nav bar */
            width: 100%; /* Make nav full width */
        }

        .navbar-nav .nav-link {
            color: #ffffff !important; /* Text color for the nav links */
            font-size: 24px; /* Set the font size for the nav links */
        }

        .nav-item .btn {
            margin-right: 10px; /* Add spacing between buttons */
            margin-top: 10px; /* Add top margin to buttons */
        }

        .container {
            z-index: 1; /* Ensure the container content appears above the pseudo-element background */
            position: relative; /* Relative positioning to layer over the body pseudo-element */
        }
        
        h2 {
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><h2>Admin Dashboard</h2></center>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-secondary nav-link" href="admin_reports.php">User Reports</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary nav-link" href="admin_feedback.php">Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary nav-link" href="admin_notifications.php">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary nav-link" href="send_message_to_security.php">Send Message to Security Agency</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary nav-link" href="add_security_agency.php">Add Security Agency</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary nav-link" href="view_security_replies.php">View Security Replies</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>
