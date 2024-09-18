<?php
include 'db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $matric_number = $_POST['matric_number'];
    $password = $_POST['password'];
    $department = $_POST['department']; // Added department field

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into students table
    $stmt = $conn->prepare("INSERT INTO students (name, email, matric_number, password, department) VALUES (?, ?, ?, ?, ?)");

    // Check if the prepare() function succeeded
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssss", $name, $email, $matric_number, $hashed_password, $department);

    if ($stmt->execute()) {
        echo "Registration successful. Redirecting to login page...";
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Student Registration</h1>
        <form action="student_register.php" method="post">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="matric_number">Matric Number:</label>
                <input type="text" class="form-control" id="matric_number" name="matric_number" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <!-- Add a button to navigate to the home page -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary">Go to Home Page</a>
        </div>
    </div>
</body>
</html>
