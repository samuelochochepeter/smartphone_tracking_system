<?php include 'header.php'; ?>
<h2>Sport Notifications</h2>

<?php
include 'db.php';

$department = 'Sport';

// Fetch notifications for Sport
$stmt = $conn->prepare("SELECT * FROM notifications WHERE department = ?");
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='alert alert-info'>";
        echo "<strong>Notification:</strong> " . $row['message'] . "<br>";
        echo "<small><i>Received on: " . $row['timestamp'] . "</i></small>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No notifications at the moment.</div>";
}

$stmt->close();
$conn->close();
?>

<?php include 'footer.php'; ?>
