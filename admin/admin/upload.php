<?php

include("../database.php");
$username = $_GET['username'];


$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'tellers/'; // upload directory
 
if($_FILES['ImageFile'])
{
$img = $_FILES['ImageFile']['name'];
$tmp = $_FILES['ImageFile']['tmp_name'];
 
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
 
// can upload same image using rand function
$final_image = rand(000,9999).$img;
 
	// check's valid format
	if(in_array($ext, $valid_extensions)) 
	{ 
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) 
		{
			$result = mysqli_query($conn,"update deposit set teller_img='$final_image' where username='$username' and date_confirmed=''");
			
			if(!$result){
				echo mysqli_error($conn);
				exit;
			}
			
			echo "<script>  window.location='deposit_page.php?username=$username' </script>";
		}
	} 
	else 
	{
		echo 'Invalid Proof of payment';
	}
}
?>