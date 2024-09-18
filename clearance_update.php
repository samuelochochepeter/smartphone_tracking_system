<?php
include 'db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $matric_number = $_POST['matric_number'];
    $current_unit = $_POST['current_unit'];

    // Example of defining clearance status
    $clearance_status = 'cleared';

    // SQL query to update clearance status
    $stmt = $conn->prepare("UPDATE clearance_forms SET clearance_status = ? WHERE matric_number = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $clearance_status, $matric_number);

    if ($stmt->execute()) {
        // Insert notification into notifications table
        $message = "Student with Matric Number: $matric_number has been cleared by $current_unit";
        $timestamp = date('Y-m-d H:i:s');
        $department = ''; // Update this with the appropriate department receiving the notification

        $stmt_notification = $conn->prepare("INSERT INTO notifications (student_id, department, message, timestamp) VALUES (?, ?, ?, ?)");
        if (!$stmt_notification) {
            die("Prepare failed: " . $conn->error);
        }

        // Example student_id assuming it's stored in session or passed from previous steps
        $student_id = 1;

        $stmt_notification->bind_param("isss", $student_id, $department, $message, $timestamp);

        if ($stmt_notification->execute()) {
            echo "Notification sent to $department.";
        } else {
            echo "Failed to send notification: " . $stmt_notification->error;
        }

        $stmt_notification->close();
    } else {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
