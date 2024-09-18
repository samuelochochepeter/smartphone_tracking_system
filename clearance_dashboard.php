<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Clearance System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Final Year Clearance System</h1>
        
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#student_affairs">Student Affairs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#sports">Sports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#clinic">Clinic</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#hostel">Hostel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#department">Department</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#library">Library</a>
            </li>
            
        </ul>

        <!-- Student Affairs Section -->
        <div id="student_affairs" class="section active mt-4">
            <h3>Student Affairs</h3>
            <form action="download_clearance.php" method="post">
                <div class="form-group">
                    <label for="matric_number">Matric Number:</label>
                    <input type="text" class="form-control" id="matric_number" name="matric_number" required>
                </div>
                <button type="submit" class="btn btn-primary">Download Clearance Form</button>
            </form>
        </div>
        
        <!-- Sports Section -->
        <div id="sports" class="section mt-4">
            <h3>Sports</h3>
            <form action="clearance_update.php" method="post">
                <div class="form-group">
                    <label for="matric_number_sports">Matric Number:</label>
                    <input type="text" class="form-control" id="matric_number_sports" name="matric_number" required>
                </div>
                <input type="hidden" name="current_unit" value="sports">
                <button type="submit" class="btn btn-primary">Clear</button>
            </form>
        </div>
        
        <!-- Clinic Section -->
        <div id="clinic" class="section mt-4">
            <h3>Clinic</h3>
            <form action="clearance_update.php" method="post">
                <div class="form-group">
                    <label for="matric_number_clinic">Matric Number:</label>
                    <input type="text" class="form-control" id="matric_number_clinic" name="matric_number" required>
                </div>
                <input type="hidden" name="current_unit" value="clinic">
                <button type="submit" class="btn btn-primary">Clear</button>
            </form>
        </div>
        
        <!-- Hostel Section -->
        <div id="hostel" class="section mt-4">
            <h3>Hostel</h3>
            <form action="clearance_update.php" method="post">
                <div class="form-group">
                    <label for="matric_number_hostel">Matric Number:</label>
                    <input type="text" class="form-control" id="matric_number_hostel" name="matric_number" required>
                </div>
                <input type="hidden" name="current_unit" value="hostel">
                <button type="submit" class="btn btn-primary">Clear</button>
            </form>
        </div>
        
        <!-- Department Section -->
        <div id="department" class="section mt-4">
            <h3>Department</h3>
            <form action="clearance_update.php" method="post">
                <div class="form-group">
                    <label for="matric_number_department">Matric Number:</label>
                    <input type="text" class="form-control" id="matric_number_department" name="matric_number" required>
                </div>
                <input type="hidden" name="current_unit" value="department">
                <button type="submit" class="btn btn-primary">Clear</button>
            </form>
        </div>
        
        <!-- Library Section -->
        <div id="library" class="section mt-4">
            <h3>Library</h3>
            <form action="clearance_update.php" method="post">
                <div class="form-group">
                    <label for="matric_number_library">Matric Number:</label>
                    <input type="text" class="form-control" id="matric_number_library" name="matric_number" required>
                </div>
                <input type="hidden" name="current_unit" value="library">
                <button type="submit" class="btn btn-primary">Clear</button>
            </form>
        </div>
        
    </div>

    <script>
        $(document).ready(function(){
            $(".nav-link").click(function(){
                $(".nav-link").removeClass("active");
                $(this).addClass("active");

                $(".section").removeClass("active");
                $($(this).attr("href")).addClass("active");
            });
        });
    </script>
</body>
</html>
