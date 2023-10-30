<?php 
	// start session so that you can use the $_SESSION super global array
	session_start(); 
	include("../../config.php");
	include("../../stflairs_fns.php");
	
	if(!isset($_SESSION['admin_id'])){   
	    header("location:../index.php");
	}
	
	//retrieve the admin email address and store it as the username
	$username = $_SESSION['admin_id'];
	
	//run a query to retrieve all the user details
	$result = mysqli_query($conn,"select * from admin where username='$username'");
	
	//convert the result into a readable form
	$result = mysqli_fetch_array($result);
	
	// get the person's first name
	$fullname = $result['fullname'];
	$username = $result['username'];
	$password = $result['password'];
	
	
	// Retrieve total number of categories
	$num_of_categories = getTotalNoOfEntity('category',$conn);
	$num_of_products = getTotalNoOfEntity('product',$conn);

	// $num_of_slides = getTotalNoOfEntity('slide',$conn);
	// $num_of_sales = getStatistics('sales',$conn);

	//get the last three deposit transactions by this particluar user
	$sales = getAllSales($conn);
	//get the last three withdrawal transactions by this particular user
	$expenses  = getAllExpenses($conn);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
		<title>Admin Dashboard</title>
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
		<link rel="icon" href="../../images/logo.png">
		
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">Admin Dashboard</a>
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
     <script src="Dashboard_files/Chart.js" charset="utf-8"></script>
    
	<main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      
      <!-- The Top Information Bar -->
      
      <div class="row">

        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-hashtag fa-3x"></i>
            <div class="info">
                <h5 style="font-size:14px"> No. Of Categories </h5> <h5><?php  echo $num_of_categories ?></h5>        
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-hashtag fa-3x"></i>
            <div class="info">
              <h5 style="font-size:14px">No. Of Products</h5>
              <h5><?php  echo $num_of_products; ?></h5>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h5 style="font-size:14px">Number of Slides</h5>
              <h5><?php echo $num_of_slides; ?></h5>
            </div>
          </div>
        </div>
        
        
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-credit-card fa-3x"></i>
            <div class="info">
              <h5 style="font-size:14px">Bags of Cements</h5> <?php  //echo $total_ref ?> 
              <h5>
				  <?php 
				  	
						echo "20";
					
					?>
			</h5>
            </div>
          </div>
        </div>

		<div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-bank fa-3x"></i>
            <div class="info">
                <h5 style="font-size:14px"> Total Stone Dust1 </h5> <h5><?php  echo $num_of_sales ?></h5>        
            </div>
          </div>
        </div>

		<div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-bank fa-3x"></i>
            <div class="info">
                <h5 style="font-size:14px"> Total Stone Dust2 </h5> <h5><?php  echo $num_of_sales ?></h5>        
            </div>
          </div>
        </div>

		<div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-bank fa-3x"></i>
            <div class="info">
                <h5 style="font-size:14px"> Total Gravel </h5> <h5><?php  echo $num_of_sales ?></h5>        
            </div>
          </div>
        </div>
        
		<div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-bank fa-3x"></i>
            <div class="info">
                <h5 style="font-size:14px"> Total Damages </h5> <h5><?php  echo $num_of_sales ?></h5>        
            </div>
          </div>
        </div>

      </div>
      
      <!-- The end of the top information bar -->
	  
	  <div class="row">
          
		  <div class="col-md-6">
			<div class="tile">
			  <h3 class="tile-title" style="font-size:14px"> Latest Sales Record <span class="ml-5" style="font-size:14px"> </h3>
				  
			  <div class="embed-responsive table-responsive">
			   <!--<h4 class="text-center">Transaction history</h4>-->
				  <div class="table-responsive">
						  <table class="table table-hover table-bordered" id="refrralTable">
							  <thead>
								  <tr class="xcrud-th">
									  <th>S/N</th>
									  <th>Description</th>
									  <th>Quantity </th>
									  <th>Total Amount</th>
									  <th>Payment Method </th>				 				 
									  <th>Date Recorded</th>				 
								  </tr>
							  </thead>
							  <tbody>
							  
							  <?php 
							  $i =1;
							  while($row=mysqli_fetch_array($sales)){ ?>
							  <tr>
								  <td><?php  echo $i ?></td>
								  <td><?php  echo $row['description'] ?></td>
								  <td><?php  echo $row['quantity'] ?></td>
								  <td><?php  echo $row['total_amount'] ?></td>
								  <td><?php  echo $row['payment_method'] ?></td>
								  <td><?php  echo $row['date_time_created'] ?></td>
							  </tr>
							  <?php 
							  $i++;
							  } ?>
							  
							   
							  
							  </tbody>
			  
						  </table>
						  <?php 
							  if(mysqli_num_rows($sales)>0){
								  ?>
								  Click here to <a href="managesales.php" style="text-decoration:none">View all Sales</a>
								  <?php
							  }
							  else{
								  ?>
								  You have no Sales yet....
								  <?php
							  }
							  ?>
						  
				  </div>
			  </div>
			</div>
		  </div>
			
		  <div class="col-md-6">
			<div class="tile">
			  <h3 class="tile-title" style="font-size:14px"> Latest Expenses Record
				  
			  </h3>
				<div class="embed-responsive table-responsive">
				  <div class="table-responsive">
					  <?php
					 
					  ?>
						  <table class="table table-hover table-bordered" id="refrralTable">
							  <thead>
								  <tr class="xcrud-th">
									  <th>S/N</th>
									  <th>Cat</th>
									  <th>Decription</th>	
									  <th>Amount</th>
									  <th>Date of Donation</th>			 
								  </tr>
							  </thead>
							  <tbody>
							  
							  <?php 
							  
							  if(mysqli_num_rows($expenses)>0){
								  $i =1;
							  while($row=mysqli_fetch_array($expenses)){ ?>
							  <tr>
								  <td><?php  echo $i; ?></td>
								  <td> <?php  echo $row['catid'] ?></td>
								  <td> <?php  echo $row['description'] ?></td>
								  <td>$<?php  echo number_format($row['total_amount'],2)?></td>
								  <td>
									  <?php  echo $row['datetime'] ?>
								  </td>
								 
							  </tr>
						  
							  <?php 
							  $i++;
								  } 
  
							  ?>
							  </tbody>
						  </table>
						  Click here to <span class="ml-2" style="font-size:14px"><a href="manageexpenses.php" style="text-decoration:none">View all expenses</a></span>
							  <?php
								  
							  }
							  else{
								  ?>
								  
								  <div class="embed-responsive table-responsive"> 
									  <p>No payment record found!</p>    
								  </div>
								  
							  <?php
							  }
							  
							  ?>
			  
				  </div>
			  </div>
			</div>
		  </div>
		  
		</div>
    </main>
    
	<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script src="Dashboard_files/jquery-3.js"></script>
    <script src="Dashboard_files/popper.js"></script>
    <script src="Dashboard_files/bootstrap.js"></script>
    <script src="Dashboard_files/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="Dashboard_files/pace.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="Dashboard_files/jquery.js"></script>
    <script type="text/javascript" src="Dashboard_files/dataTables.js"></script>
    <script type="text/javascript" src="Dashboard_files/chart.js"></script>

	<script> 
		$(document).ready(function(){
			$('#dashboard').addClass("active");
		});
	</script>
	</body>
</html>