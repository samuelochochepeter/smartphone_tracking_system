<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html"); // Redirect to admin login page if not logged in as admin
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

// Fetch feedback from users
$sql = "SELECT f.id, f.user_id, f.subject, f.message, f.created_at, f.user_id
        FROM feedback f
        JOIN users u ON f.user_id = u.id";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">User Feedback</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>ID</th><th>User Name</th><th>Subject</th><th>Message</th><th>Created At</th></tr></thead>';
            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['user_id']}</td><td>{$row['subject']}</td><td>{$row['message']}</td><td>{$row['created_at']}</td></tr>";
            }
            echo '</tbody></table>';
        } else {
            echo "No feedback found.";
        }
        $conn->close();
        ?>
         <a href="admin_dashboard.php" class="btn btn-primary mt-3">Back to Admin Dashboard</a>
    </div>
</body>
    </div>
</body>
</html>

<?php
}
?>
