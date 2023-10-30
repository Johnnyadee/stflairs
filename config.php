<?php
$hostname  = "localhost";
$user     = "root";
$pass     = "";
$databasename = "stflairsdb";
// Create connection
$conn = mysqli_connect($hostname, $user, $pass,$databasename);
// Check connection
if (!$conn) {
    die("Unable to Connect database: " . mysqli_connect_error());
}
?>
