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

	$allcustomersfin = getAllCustomersFin($conn);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>All Customer's Account Details</title>
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">View All Customer's Account</a>
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
          <li class="breadcrumb-item"><a href="#">List of all Customers</a></li>
        </ul>
      </div>      
      <!-- The end of the top information bar -->
	  
      <div class="row">
        <div class="col-md-12">
          <div class="tile">

            <h3 class="tile-title" style="font-size:14px">List of all Customer's Account Balance<span class="ml-5" style="font-size:14px"> </h3>
                
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
            						<th>Fullname</th>
									<th>Wallet Address</th>	
									<th>Account Balance</th>
									<th>Current Earning</th>
									<th>ACTION</th>		 
            					</tr>
            				</thead>
            				<tbody>
            				
            				<?php 
            				$i =1;
            				while($row=mysqli_fetch_array($allcustomersfin)){ ?>
            				<tr id="<?php echo $row["id"]; ?>">
								
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" class="user_checkbox" data-id="<?php echo $row["id"]; ?>">
										<label for="checkbox2"></label>
									</span>
								</td>

								<td> <?php echo $i ?></td>
            					<td>
            					<?php 
            					        $user_details = getCustomerDetails($conn,$row["username"]);;
            					        echo $user_details['full_name'];
            					?>
            					</td>
								<td><?php  echo $user_details['bit_account'] ?></td>
								
								<td><?php  echo $row['account_bal']?></td>
                                <td><?php  echo getCurrentEarning($conn,$row['username']) ?></td>
								<td width="100px">
									<a href="#editCurrentBalanceModal" class="edit" data-toggle="modal">
										<i class="material-icons update_currentbalance" data-toggle="tooltip"
										data-fullname="<?php echo $user_details['full_name']  ?>"
										data-acctbal-id="<?php echo $row["id"]; ?>"
										data-acctbal ="<?php echo $row["account_bal"]; ?>"
										data-username= "<?php  echo $row['username']; ?>"
										data-earning="<?php echo getCurrentEarning($conn,$row["username"]); ?>"
										title="Edit"></i>
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


    <!--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
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

	<script src="ajax.js"></script>
	<!-- Edit Modal HTML -->
	<div id="editCurrentBalanceModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_acctbal_form">
					<div class="modal-header">						
						<h4 class="modal-title">Update Customer Account Balance</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_acctbal_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Fullname</label>
							<input type="text" id="fullname_u" name="fullname" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Account Balance</label>
							<input type="text" id="acctbal_u" name="acctbal" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Current Earning:</label>
							<input type="text" id="earning_u" name="earning" class="form-control" required>
							
						</div>
						
						<div class="form-group d-none">
							<label>Customer Username:</label>
							<input type="text" id="username_u" name="username" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
					<input type="hidden" value="13" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update_acctbal">Update Account Balance</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script> 
		$(document).ready(function(){
			$('#manageaccounts').addClass("active");
		});
	</script>
	</body>
</html>