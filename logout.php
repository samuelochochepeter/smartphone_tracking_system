<?php
<<<<<<< HEAD
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or index page
header("Location: index.html");
exit;
=======
session_start();
session_unset();
session_destroy();
header("Location: Student_login.php");
exit();
>>>>>>> 48471266d55383bab68e18cbb09a07d3f55c0e00
?>
