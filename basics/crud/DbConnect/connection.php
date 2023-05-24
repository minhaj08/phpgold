<?php
// Set connection variables
$server = "localhost";
$username = "root";
$password = "";
$dbName = "auth";

// Create a database connection
$con = mysqli_connect($server, $username, $password, $dbName);

// Check for connection success
if ($con->connect_errno) {
    die("Failed to connect to MySQL: " . $con->connect_error);
}

?>
