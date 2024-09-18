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
    $report_id = $_POST['report_id'];
    $reply_message = $_POST['reply_message'];

    // Validate report_id existence in lost_phones table
    $check_sql = "SELECT id FROM lost_phones WHERE id = '$report_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Insert admin reply into database
        $insert_sql = "INSERT INTO admin_replies (report_id, reply_message) VALUES ('$report_id', '$reply_message')";

        if ($conn->query($insert_sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Reply submitted successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error inserting reply: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Invalid report ID.</div>';
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to User Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Reply to User Report
            </div>
            <div class="card-body">
                <form action="reply_user.php" method="post">
                    <div class="form-group">
                        <label for="report_id">Report ID:</label>
                        <select class="form-control" id="report_id" name="report_id" required>
                            <option value="">Select Report ID</option>
                            <?php
                            // Database connection details
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

                            // Query to fetch all report IDs from lost_phones table
                            $sql = "SELECT id FROM lost_phones";
                            $result = $conn->query($sql);

                            // Output options for select dropdown
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['id'] . '</option>';
                                }
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reply_message">Reply Message:</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Reply</button>
                </form>
            </div>
            <a href="admin_dashboard.php" class="btn btn-primary mt-3">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
