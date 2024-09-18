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

// Function to fetch security agencies
function fetchSecurityAgencies($conn) {
    $agencies = [];
    $sql = "SELECT * FROM security_agencies ORDER BY name ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $agencies[] = $row;
        }
    }

    return $agencies;
}

// Function to fetch user reports
function fetchUserReports($conn) {
    $reports = [];
    $sql = "SELECT * FROM lost_phones ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }
    }

    return $reports;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['security_agency_id'], $_POST['report_id'])) {
    $security_agency_id = $_POST['security_agency_id'];
    $report_id = $_POST['report_id'];

    // Fetch report details
    $sql = "SELECT * FROM lost_phones WHERE id = $report_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $report = $result->fetch_assoc();
        $phone_model = $report['phone_model'];
        $imei = $report['imei'];
        $last_location = $report['last_location'];
        $description = $report['description'];

        // Insert message into database
        $sql = "INSERT INTO admin_to_security (security_agency_id, phone_model, imei, last_location, description)
                VALUES ('$security_agency_id', '$phone_model', '$imei', '$last_location', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Message forwarded successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error forwarding message: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Invalid report ID.</div>';
    }
}

// Fetch security agencies and user reports
$agencies = fetchSecurityAgencies($conn);
$reports = fetchUserReports($conn);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forward User Report to Security Agency</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Forward User Report to Security Agency
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="security_agency_id">Security Agency:</label>
                        <select class="form-control" id="security_agency_id" name="security_agency_id" required>
                            <option value="">Select an Agency</option>
                            <?php foreach ($agencies as $agency) : ?>
                                <option value="<?php echo $agency['id']; ?>"><?php echo $agency['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="report_id">User Report:</label>
                        <select class="form-control" id="report_id" name="report_id" required>
                            <option value="">Select a Report</option>
                            <?php foreach ($reports as $report) : ?>
                                <option value="<?php echo $report['id']; ?>">
                                    <?php echo "Report ID: " . $report['id'] . " - " . $report['phone_model']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Forward Report</button>
                </form>
                
            </div>
            <a href="admin_dashboard.php" class="btn btn-primary mt-3">Back to Admin Dashboard</a>
    </div>
</body>
        </div>
    </div>
</body>
</html>
