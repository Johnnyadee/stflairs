<?php 
	// start session so that you can use the $_SESSION super global array
	session_start(); 
	include("../../database.php");
	include("../../faircoinachievers_fns.php");
	
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

	//This function returned all the plans
    $customers =  getAllCustomers($conn);
	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Compose and Send Mail</title>
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
		<link rel="icon" href="../../images/favicon.png">

		<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round"> -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
		
		
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">Compose and Send Mail</a>
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
    
    
    <body>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1 style="font-size:15px"><i class="fa fa-edit"></i>Compose and Send Mails</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
          <li class="breadcrumb-item">Compose and Send Mail</li>
        </ul>
      </div>

     <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12">

                <div class="card">
                    
                    <div class="card-body">
                            
                            <div class="">
                          <div class="x-form" style=""> 
                          <form id="mail_sending_form">
                                <div class="form-group">
                                    <label for="fullname"Select Customer:</label>
                                    <select class="form-control" id="username"  name="username">
                                        <option value=""> -Select Customer Name -</option>
                                        <?php 
                                            while($row = mysqli_fetch_array($customers)){
                                                ?>
                                             <option value=<?php  echo $row['email'] ?>> <?php  echo $row['full_name']?> </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="email">Email Address:</label>
                                    <input type="text" class="form-control" id="email"  name="email" readonly>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="email">Enter Mail Subject:</label>
                                    <input type="text" class="form-control" id="subject"  name="subject" >
                                </div>
                                
                                 <div class="form-group">
                                    <label for="message">Enter The Message Here:</label>
                                    <textarea class="form-control" id="message"  name="message" style="height:100px"></textarea>
                                </div>
                                
                              
                                  <button type="button" class="btn btn-info" style="background-color: #011b33; border: solid 1px #011b33" id="sendmail" >Send Mail</button>
                                 
                            </form>
                            </div>
                             </div>
            </div>
            </div>
            </div>
            </div>
            </div>
               

        </div>

              <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="editpersonaldetails.php_files/popper.js"></script>
            <script src="editpersonaldetails.php_files/bootstrap.js"></script>
            <script src="editpersonaldetails.php_files/main.js"></script>
            <!-- The javascript plugin to display page loading on top-->
            <script src="editpersonaldetails.php_files/pace.js"></script>
            <!-- Page specific javascripts-->
             <script type="text/javascript" src="editpersonaldetails.php_files/jquery.js"></script>
            <script type="text/javascript" src="editpersonaldetails.php_files/dataTables.js"></script>
            <script type="text/javascript" src="editpersonaldetails.php_files/chart.js"></script>
            <script src="fetchcustomersajax.js">  </script>
            
            </div>
        </main>
    </body>
</html>
