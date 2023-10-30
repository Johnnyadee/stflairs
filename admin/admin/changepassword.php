<?php 
	// start session so that you can use the $_SESSION super global array
	session_start(); 
	include("../../config.php");
	include("../../dreampathway_fns.php");
	
	if(!isset($_SESSION['admin_id'])){   
	    header("location:../index.php");
	}
	
	//retrieve the username of the person that logged in
	$username = $_SESSION['admin_id'];
	
	//run a query to retrieve all the user details
	$result = mysqli_query($conn,"select * from admin where username='$username'");
	
	//convert the result into a readable form
	$result = mysqli_fetch_array($result);
	
	// get the person's first name
	$fullname = $result['fullname'];
	$username = $result['username'];
	$password = $result['password'];


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
		<title>Admin >> Change Password</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Main CSS-->
		<link rel="stylesheet" type="text/css" href="Dashboard_files/main.css">
		<link rel="stylesheet" href="Dashboard_files/datatables.css">
		<!-- Font-icon css-->
		<link rel="stylesheet" type="text/css" href="Dashboard_files/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="Dashboard_files/vue.js"></script>
		<script src="Dashboard_files/vue-router.js"></script>
		<script src="Dashboard_files/axios.js"></script>
		<link rel="icon" href="../../images/icon.png">
		
		<style>
		@media  only screen and (max-width: 480px) {
			.ref
				{
				margin-left:-30px; 
				}
		}
			
			.widget-small .info {
				-webkit-box-flex: 1;
				-ms-flex: 1;
				flex: 1;
				padding: 0 15px;
				-ms-flex-item-align: center;
				align-self: center;
			}
		</style>
  </head>
  
  <body class="app sidebar-mini rtl  pace-done">
	  
	<div class="pace  pace-inactive">
		
		<div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%" data-progress="99">
				<div class="pace-progress-inner"></div>
		</div>
		
		<div class="pace-activity"></div>

		</div>
    <!-- Navbar-->
    <header class="app-header">
		<a style="font-weight:bold" class="app-header__logo" href="index.php">Change Password </a>
      <!-- Sidebar toggle button-->
	  <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"></i></a>
          
        </li>
		<li class="dropdown">
			<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
				<i class='fa fa-user fa-lg text-light'></i>
			</a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="profile.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="changepassword.php"><i class="fa fa-cog fa-lg"></i> Change Password</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>

      <!-- Sidebar menu-->
    <?php include("sidebar.php")?>
 
<style>
.x-form
{
margin: 0 auto; 
width:40%;  max-width: 100%; float:none
}
@media  only screen and (max-width: 480px) {
    
    .x-form
    {
        width:100%;  max-width: 100%; 
    }
}
</style>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1 style="font-size:15px"><i class="fa fa-edit"></i>Change Password</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Change Password</li>
          <li class="breadcrumb-item"><a href="https://sohopropert">Change Password</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12 ">
                  <div class="card">
                    <div class="card-header">Change password</div>
                    <div class="card-body">
                                                                  
                  <div class="x-form" style="">
                <form method="POST" class="mt-3 " action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group ">
                    <label for="current-password">Current password:</label>
                        <input type="password" class="form-control" id="current-password" placeholder="Enter current password" name="password" required="">        
                  </div>
				 

                  <div class="form-group">
                   <label for="new-password">New password:</label>
                                    <input type="password" class="form-control" id="new-password" placeholder="Enter new password" name="new_password" required="">
                  </div>
                  <div class="form-group">
                    <label for="new-password_confirmation">Confirm new password:</label>
                 <input type="password" class="form-control" id="new-password_confirmation" placeholder="Enter confirm new passwoed" name="confirm_password" required="">
                                
                  </div>

                  <div class="">
              <button class="btn btn-primary" type="submit">Submit</button>
            
                
                </div></form>
              </div>
            
            </div>
           
          </div>
        </div>
      </div>
      
    </div></div></div></main>

 <script src="changepassword_files/jquery-3.js"></script>
    <script src="changepassword_files/popper.js"></script>
    <script src="changepassword_files/bootstrap.js"></script>
    <script src="changepassword_files/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="changepassword_files/pace.js"></script>
    <!-- Page specific javascripts-->
       <script type="text/javascript" src="changepassword_files/jquery.js"></script>
    <script type="text/javascript" src="changepassword_files/dataTables.js"></script>
    <script type="text/javascript" src="changepassword_files/chart.js"></script>
    <script type="text/javascript">
      $('#changepassword').addClass("active");
    </script>
    <!-- Google analytics script-->
  </body>
</html>


<?php
 if (count($_POST) > 0) {
 $previous_password = mysqli_query($conn,"select * from admin where username ='$username' ");
 $previous_password = mysqli_fetch_array($previous_password);
 $previous_pass = $previous_password['password']; //this section retrieves the sales_executive's former password
  
 $password     =        $_POST['password'];
 $new_password = 		$_POST['new_password'];
 
 if($password != $previous_pass) {
       echo "<script> alert('Please Enter your former password correctly') </script>";
	   exit;
 } 
 else
 { 
	$confirm_password = $_POST['confirm_password'];
	if($new_password ==$confirm_password)
	{ 
	    $result= mysqli_query($conn, "UPDATE admin set password='$new_password' WHERE username='$username'");
      echo "<script> alert('Password changed successfully') </script>";
	}
	else{
        echo "<script> alert('Password and Confirm-password do not match') </script>";
	}
 }

 } 

?>