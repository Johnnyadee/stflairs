<?php
session_start();
include("../config.php");

// Retrieve the username and password

$username  = $_POST['username'];
$password  = $_POST['password'];

//create a query and execute it again the database to confirm the credentials
$result = mysqli_query($conn, "SELECT * FROM admin where username='$username' and password='$password'");
if(mysqli_num_rows($result)>0){
    $_SESSION['admin_id'] =$username; 
    echo "success";
}
else{
    echo "failure";
}
?>