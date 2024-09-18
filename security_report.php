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

// Function to fetch reports sent by admin to security agency
function fetchReports($conn, $security_id) {
    $reports = [];
    $sql = "SELECT * FROM admin_to_security WHERE security_agency_id = '$security_id' ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }
    }

    return $reports;
}

// Function to submit reply from security agency to admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply_message'])) {
    $admin_report_id = $_POST['admin_report_id'];
    $reply_message = $_POST['reply_message'];

    // Insert reply into database
    $sql = "INSERT INTO security_to_admin (admin_report_id, security_agency_id, reply_message)
            VALUES ('$admin_report_id', '{$_SESSION['security_id']}', '$reply_message')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Reply submitted successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error submitting reply: ' . $conn->error . '</div>';
    }
}

// Fetch reports sent by admin to security agency
$reports = fetchReports($conn, $_SESSION['security_id']);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Reports</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Reports from Admin
            </div>
            <div class="card-body">
                <!-- Messages from Admin -->
                <h5>Reports from Admin:</h5>
                <?php
                if (!empty($reports)) {
                    foreach ($reports as $report) {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<p>Phone Model: ' . $report['phone_model'] . '</p>';
                        echo '<p>IMEI: ' . $report['imei'] . '</p>';
                        echo '<p>Last Known Location: ' . $report['last_location'] . '</p>';
                        echo '<p>Description: ' . $report['description'] . '</p>';
                        echo '<hr>';
                        echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
                        echo '<input type="hidden" name="admin_report_id" value="' . $report['id'] . '">';
                        echo '<div class="form-group">';
                        echo '<label for="reply_message">Your Reply:</label>';
                        echo '<textarea class="form-control" id="reply_message" name="reply_message" rows="3" required></textarea>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Submit Reply</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No reports from Admin.</p>';
                }
                ?>
                 <a href="security_dashboard.php" class="btn btn-primary mt-3">Back to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
