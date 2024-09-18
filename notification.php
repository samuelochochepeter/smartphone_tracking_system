<?php
include 'db.php'; // Include your database connection file

// Example data (replace with actual retrieval logic if needed)
$student_id = 1;  // Replace with actual student ID
$department = "sports";

// Insert notification into database
$stmt = $conn->prepare("INSERT INTO notifications (student_id, department) VALUES (?, ?)");
$stmt->bind_param("is", $student_id, $department);

if ($stmt->execute()) {
    echo "Notification sent to clinic.";
} else {
    echo "Failed to send notification: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
