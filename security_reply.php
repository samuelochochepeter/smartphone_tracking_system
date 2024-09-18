<?php
session_start();
if (!isset($_SESSION['security_agency_id'])) {
    header("Location: security_login.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_to_security_id = $_POST['admin_to_security_id'];
    $reply_message = $_POST['reply_message'];

    // Sanitize input to prevent SQL injection
    $admin_to_security_id = $conn->real_escape_string($admin_to_security_id);
    $reply_message = $conn->real_escape_string($reply_message);

    // Insert security agency reply into database
    $sql = "INSERT INTO security_replies (admin_to_security_id, reply_message) VALUES ('$admin_to_security_id', '$reply_message')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Reply submitted successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Reply to Admin
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="admin_to_security_id">Admin Message ID:</label>
                        <input type="text" class="form-control" id="admin_to_security_id" name="admin_to_security_id" required>
                    </div>
                    <div class="form-group">
                        <label for="reply_message">Reply Message:</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Reply</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['security_agency_id'])) {
    header("Location: security_login.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_to_security_id = $_POST['admin_to_security_id'];
    $reply_message = $_POST['reply_message'];

    // Sanitize input to prevent SQL injection
    $admin_to_security_id = $conn->real_escape_string($admin_to_security_id);
    $reply_message = $conn->real_escape_string($reply_message);

    // Insert security agency reply into database
    $sql = "INSERT INTO security_replies (admin_to_security_id, reply_message) VALUES ('$admin_to_security_id', '$reply_message')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Reply submitted successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Reply to Admin
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="admin_to_security_id">Admin Message ID:</label>
                        <input type="text" class="form-control" id="admin_to_security_id" name="admin_to_security_id" required>
                    </div>
                    <div class="form-group">
                        <label for="reply_message">Reply Message:</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Reply</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['security_agency_id'])) {
    header("Location: security_login.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_to_security_id = $_POST['admin_to_security_id'];
    $reply_message = $_POST['reply_message'];

    // Sanitize input to prevent SQL injection
    $admin_to_security_id = $conn->real_escape_string($admin_to_security_id);
    $reply_message = $conn->real_escape_string($reply_message);

    // Insert security agency reply into database
    $sql = "INSERT INTO security_replies (admin_to_security_id, reply_message) VALUES ('$admin_to_security_id', '$reply_message')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Reply submitted successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Reply to Admin
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="admin_to_security_id">Admin Message ID:</label>
                        <input type="text" class="form-control" id="admin_to_security_id" name="admin_to_security_id" required>
                    </div>
                    <div class="form-group">
                        <label for="reply_message">Reply Message:</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Reply</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
