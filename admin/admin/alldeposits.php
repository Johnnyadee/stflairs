
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

	$alldeposits = getAllDepositTransactions($conn);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>All Deposit Transactions</title>
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">View All Depsit Transaction</a>
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

<?php include("sidebar.php")?>
	<meta name="csrf-token" content="zcZnXPdW3TZLRQPwWGKecaSPv6yR6lC4g8zT1m5u">

	 <style type="text/css">
		.xcrud-list {
		min-width: 95%;
		width: auto;
		display: table !important;
		margin-bottom: 3px;
		table-layout: fixed;
	}

	table {
		border-collapse: collapse;
		border-spacing: 0
		}
		.table > thead > tr > th {
		vertical-align: bottom;
		border-bottom: 2px solid #dddddd;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		padding: 5px;
		line-height: 1.42857143;
		vertical-align: top;
		border-top: 1px solid #F0F0F0;
		}
		.xcrud-th th {

		background: #efefef;
		white-space: nowrap;
	   font-size: 16px;
	   font-weight: bold;

	}
	th {
		text-align: left;
	}
	.btn-warning {
		color: #ffffff;
		background-color: #fbb450;
		border-color: #faa937;
	}
	.btn-xcrud, .btn-group-sm > .btn {

		padding: 0px 5px;
		font-size: 15px;
		line-height: 1.5;
		-webkit-border-radius: 0;
		border-radius: 0;

	}
	.btn-danger {

		color: #ffffff;
		background-color: #ee5f5b;
		border-color: #ec4844;

	}
	.btn-warning {

		color: #ffffff;
		background-color: #fbb450;
		border-color: #faa937;

	}
	.btn-danger {

		color: #ffffff;
		background-color: #ee5f5b;
		border-color: #ec4844;

	}

	</style>

<main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">List of all Deposit Transactions</a></li>
        </ul>
      </div>      
      <!-- The end of the top information bar -->
	  
      <div class="row">
        <div class="col-md-12">
          <div class="tile">

            <h3 class="tile-title" style="font-size:14px">List of all Deposit Transactions<span class="ml-5" style="font-size:14px"> </h3>
                
            <div class="embed-responsive table-responsive">
             <!--<h4 class="text-center">Transaction history</h4>-->
                <div class="table-responsive">
            			<table class="table table-hover table-bordered table-striped" id="refrralTable">
            				<thead>
            					<tr class="xcrud-th">
									<th>
										<span class="custom-checkbox">
											<input type="checkbox" id="selectAll">
											<label for="selectAll"></label>
										</span>
									</th>
									<th>S/N</th>
            						<th>Plan</th>
            						<th>Amount</th>
            						<th>Transaction Status</th>
            						<th>Proof of Payment</th>		 
            					</tr>
            				</thead>
            				<tbody>
            				
            				<?php 
            				$i =1;
            				while($row=mysqli_fetch_array($alldeposits)){ ?>
            				<tr id="<?php echo $row["id"]; ?>">
								
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" class="user_checkbox" data-id="<?php echo $row["id"]; ?>">
										<label for="checkbox2"></label>
									</span>
								</td>

								<td> <?php echo $i ?></td>
            					<td><?php echo $row["plan"] ?></td>
            					<td><?php  echo $row['amount'] ?></td>
            					<td><?php  echo $row['order_status'] ?></td>
								<td>
									<a href="viewpop.php?depositid=<?php echo $row['id'] ?>" class="btn btn-primary" style="color:white; font-weight:bold; text-decoration:none">
									 View POP 
									</a>
								</td>

            				</tr>
            				<?php 
            				$i++;
            				} ?>
            				
            				
            				</tbody>
            
            			</table>
            			
                </div>
            </div>
          </div>
        </div>
                  
      </div>
    </main>
		


			
	
			  
		<script src="paymentlog_files/jquery_002.js"></script>
			
		<script>
		$(document).ready(function(){
		 $('#refrralTable').dataTable();
		});


		  <!--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
		 <script src="paymentlog_files/jquery-3.js"></script>

		 
			<script src="paymentlog_files/popper.js"></script>
			<script src="paymentlog_files/bootstrap.js"></script>
			<script src="paymentlog_files/main.js"></script>
			<!-- The javascript plugin to display page loading on top-->
			<script src="paymentlog_files/pace.js"></script>
			<!-- Page specific javascripts-->
			   <script type="text/javascript" src="paymentlog_files/jquery.js"></script>
			<script type="text/javascript" src="paymentlog_files/dataTables.js"></script>

			<script type="text/javascript" src="paymentlog_files/chart.js"></script>
			
			<script>
				$('#alldeposits').addClass("active");
			</script>
			
			<!-- Google analytics script-->
		</main>
	</body>
</html>