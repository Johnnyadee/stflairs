<?php 
	// start session so that you can use the $_SESSION super global array
	session_start(); 
	include("../database.php");
	include("../maxfxt_fns.php");
	
	if(!isset($_SESSION['user_id'])){   
	    header("location:../index.php");
	}
	
	//retrieve the username of the person that logged in
	$username = $_SESSION['user_id'];
	
	//run a query to retrieve all the user details
	$result = mysqli_query($conn,"select * from customer where username='$username'");
	
	//convert the result into a readable form
	$result = mysqli_fetch_array($result);
	
	// get the person's first name
	$fullname = $result['full_name'];
	$username = $result['username'];
	$password = $result['password'];
	$email = $result['email'];
	$bit_account = $result['bit_account'];
	$last_access = $result['lastaccess'];
	$status = $result['t_status'];
	$passport =  $result['passport'];


	//Retrieve the financial statistics and place them on the dashboard
	$result2 = mysqli_query($conn,"select * from financial_statistics where username='$username'");
	if(!$result2){
		echo mysqli_error();
		exit();
	}

	$result2 = mysqli_fetch_array($result2);

	
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
   
    <title>Member Dashboard</title>
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
	<link rel="icon" href="../images/favicon.png">
  
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
  
  <body class="app sidebar-mini rtl  pace-done"><div class="pace  pace-inactive">
	<div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%" data-progress="99">
		<div class="pace-progress-inner"></div>
	</div>
<div class="pace-activity"></div></div>
    <!-- Navbar-->
    <header class="app-header"><a style="font-weight:bold" class="app-header__logo" href="index.php">User Dashboard</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"></i></a>
          
        </li><li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><?php if($passport==''){
		  echo "<i class='fa fa-user fa-lg text-light'></i>";
										} else{ ?>
           <img src="../passport/<?php echo $passport ?>" alt="Image" style="border-radius:50px;" width="30px">
		   <?php  } ?></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="profile.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="changepassword.php"><i class="fa fa-cog fa-lg"></i> Change Password</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>