<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agency_name = $_POST['agency_name'];
    $agency_email = $_POST['agency_email'];

    // Insert new agency into database
    $sql = "INSERT INTO security_agencies (name, email) VALUES ('$agency_name', '$agency_email')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Security agency added successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error adding agency: ' . $conn->error . '</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Security Agency</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Add Security Agency
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="agency_name">Agency Name:</label>
                        <input type="text" class="form-control" id="agency_name" name="agency_name" required>
                    </div>
                    <div class="form-group">
                        <label for="agency_email">Agency Email:</label>
                        <input type="email" class="form-control" id="agency_email" name="agency_email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Agency</button>
                </form>
            </div>
            <a href="admin_dashboard.php" class="btn btn-primary mt-3">Back to Admin Dashboard</a>
    </div>
</body>
        </div>
    </div>
</body>
</html>
