<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric_number = $_POST['matric_number'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM students WHERE matric_number = ?");
    $stmt->bind_param("s", $matric_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        if (password_verify($password, $student['password'])) {
            session_start();
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['name'] = $student['name'];
            $_SESSION['role'] = 'student'; // Add this line to set the role

            header("Location: student_dashboard.php");
            exit();
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Student with matric number '$matric_number' not found.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Student Login</h1>
        <form action="student_login.php" method="post">
            <div class="form-group">
                <label for="matric_number">Matric Number:</label>
                <input type="text" class="form-control" id="matric_number" name="matric_number" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary">Go to Home Page</a>
        </div>
    </div>
</body>
</html>
