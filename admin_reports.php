<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
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

$sql = "SELECT * FROM lost_phones";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reports</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">User Reports</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Phone Model</th>
                    <th>IMEI</th>
                    <th>Last Known Location</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['phone_model'] . "</td>";
                        echo "<td>" . $row['imei'] . "</td>";
                        echo "<td>" . $row['last_location'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td><a href='reply_user.php?report_id=" . $row['id'] . "' class='btn btn-primary'>Reply</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No reports found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="admin_dashboard.php" class="btn btn-primary mt-3">Back to Admin Dashboard</a>
    </div>
</body>
    </div>
</body>
</html>

<?php
$conn->close();
?>
