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
    $userId = $_SESSION['user_id'];
    $phoneModel = $_POST['phoneModel'];
    $imei = $_POST['imei'];
    $lastLocation = $_POST['lastLocation'];
    $description = $_POST['description'];

    $sql = "INSERT INTO lost_phones (user_id, phone_model, imei, last_location, description) VALUES ('$userId', '$phoneModel', '$imei', '$lastLocation', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Report submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Lost Phone</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Report Lost Phone</h2>
        <form action="report_lost_phone.php" method="post">
            <div class="form-group">
                <label for="phoneModel">Phone Model</label>
                <input type="text" class="form-control" id="phoneModel" name="phoneModel" required>
            </div>
            <div class="form-group">
                <label for="imei">IMEI Number</label>
                <input type="text" class="form-control" id="imei" name="imei" required>
            </div>
            <div class="form-group">
                <label for="lastLocation">Last Known Location</label>
                <input type="text" class="form-control" id="lastLocation" name="lastLocation" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Report</button>
            <a href="user_dashboard.php" class="btn btn-link">Back</a>
        </form>
    </div>
</body>
</html>
