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
    <title>Admin Replies</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="row mt-3">
            <div class="col-md-12">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">Phone Model: ' . $row['phone_model'] . '</h5>';
                        echo '<p class="card-text">IMEI: ' . $row['imei'] . '</p>';
                        echo '<p class="card-text">Last Location: ' . $row['last_location'] . '</p>';
                        echo '<p class="card-text">Description: ' . $row['description'] . '</p>';
                        
                        // Display admin reply if exists
                        if (!empty($row['reply_message'])) {
                            echo '<hr>';
                            echo '<h6>Admin Reply:</h6>';
                            echo '<p>' . $row['reply_message'] . '</p>';
                            
                        }
                        echo '<a href="user_dashboard.php" class="btn btn-link">Back</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No reports found.</p>';
                }
                
                ?>
                
            </div>
            
        </div>
        
    </div>
</body>
</html>
