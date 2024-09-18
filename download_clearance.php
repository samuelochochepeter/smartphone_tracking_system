<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure student is logged in
    if (!isset($_SESSION['student_id'])) {
        header("Location: login.php");
        exit();
    }

    $student_id = $_SESSION['student_id'];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT s.matric_number, s.name, s.department, c.clearance_status FROM students s LEFT JOIN clearance_forms c ON s.student_id = c.student_id WHERE s.student_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $department = isset($student['department']) ? $student['department'] : 'N/A';
        $clearance_status = isset($student['clearance_status']) ? $student['clearance_status'] : 'not_started';
    } else {
        echo "Student not found.";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Method not allowed.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Clearance Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Clearance Form</h1>
        <p>Matric Number: <?php echo htmlspecialchars($student['matric_number']); ?></p>
        <p>Name: <?php echo htmlspecialchars($student['name']); ?></p>
        <p>Department: <?php echo htmlspecialchars($department); ?></p>
        <p>Clearance Status: <?php echo htmlspecialchars($clearance_status); ?></p>
        <a href="clearance_dashboard.php" class="btn btn-secondary">Go to Home Page</a>
    </div>
</body>
</html>
