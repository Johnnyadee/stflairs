<?php
	// process the data from the user
	//for the selected based on amount
	session_start();
	include("../database.php");

	$username = $_GET['username']; // This field identifies who is investing

	$plan = $_POST['plan'];
	$amountcommadollar = $_POST['amount'];

	//remove comma from the amount
	$amountdollar = str_replace(',', '', $amountcommadollar);
	$amount       = str_replace('$', '',$amountdollar);
	$duration = $_POST['duration'];
	

	date_default_timezone_set("Africa/Lagos");
	$datetime = new DateTime();
	$inidate = $datetime->format('Y-m-d H:i:s');
    
 	$deposit_result = mysqli_query($conn,"insert into deposit values(null,'$username','$plan','$amount','$inidate','','not confirmed','','')");
	if(!$deposit_result){
			echo mysqli_error($conn);
			exit;
	}
	$query = mysqli_query($conn,"update customer set t_status='Yes' where username='$username'");
	
	header("location:deposit_page.php?username=".$username);
	?>