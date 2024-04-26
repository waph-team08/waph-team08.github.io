<?php
$servername = "localhost";
$username = "waph_team08";
$password = 'Pa$$w0rd';
$dbname = "waph_team";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
