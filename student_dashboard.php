<?php
// student_dashboard.php - Display student dashboard and notifications

include 'db.php';

// Fetch notifications for clinic (example)
$department = 'clinic'; // Set department here
$stmt = $conn->prepare("SELECT message, timestamp FROM notifications WHERE department = ?");
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

// Fetch clearance status or other relevant data for the dashboard
// Example: Fetch student clearance status from another table

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Student Dashboard</h1>
        
        <!-- Display student clearance status -->
        <h3>Unit Clearance Status</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Unit</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Student Affairs</td>
                    <td>No data</td> <!-- Replace with actual data -->
                </tr>
                <tr>
                    <td>Sports</td>
                    <td>No data</td> <!-- Replace with actual data -->
                </tr>
                <tr>
                    <td>Clinic</td>
                    <td>No data</td> <!-- Replace with actual data -->
                </tr>
                <tr>
                    <td>Hostel</td>
                    <td>No data</td> <!-- Replace with actual data -->
                </tr>
                <tr>
                    <td>Department</td>
                    <td>No data</td> <!-- Replace with actual data -->
                </tr>
                <tr>
                    <td>Library</td>
                    <td>No data</td> <!-- Replace with actual data -->
                </tr>
            </tbody>
        </table>
        
        <!-- Display notifications for Clinic -->
        <h3>Clinic Notifications</h3>
        <?php if ($result->num_rows > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Notification</th>
                        <th>Received On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['timestamp']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No notifications at the moment.</p>
        <?php endif; ?>
        
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
