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

	$expenses = getAllExpenses($conn);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>All Expenses Page</title>
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">View All Expenses</a>
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
          <li class="breadcrumb-item"><a href="#">List of all Our Expenses</a></li>
        </ul>
      </div>      
      <!-- The end of the top information bar -->
	  
      <div class="row">
        <div class="col-md-12">
          <div class="tile">

		  	<p class="text-right">
				<button class="btn btn-primary addexpenses" data-toggle="modal" data-target="#addExpenseModal"> Add Expenses</button> 
			</p>
			<p class="font-weight-bold">List of all the expenses we made </p>
                
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
            						<th>Expense Category</th>
            						<th>Description</th>
            						<th>Total</th>	
									<th>Date</th>
									<th>ACTION</th>		 
            					</tr>
            				</thead>
            				<tbody>
            				
            				<?php 
            				$i =1;
            				while($row=mysqli_fetch_array($expenses)){ ?>
            				<tr id="<?php echo $row["id"]; ?>">
								
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" class="user_checkbox" data-id="<?php echo $row["id"]; ?>">
										<label for="checkbox2"></label>
									</span>
								</td>

								<td> <?php echo $i ?></td>
            					<td><?php echo getExpenseTitle($row["catid"], $conn) ?></td>
            					<td><?php  echo $row['description'] ?></td>
            					<td><?php  echo $row['total_amount'] ?></td>
								<td><?php  echo $row['datetime'] ?></td>
								
								<td width="100px">
									<a href="#editExpenseModal" class="" data-toggle="modal">
									<i class="material-icons edit_expenses" data-toggle="tooltip" 
										data-id="<?php echo $row["id"]; ?>"
										data-catid="<?php echo $row["catid"]; ?>"
										data-description="<?php echo $row["description"]; ?>"
										data-totalamount="<?php echo $row["total_amount"]; ?>"
										data-date="<?php echo $row["datetime"]; ?>"
										title="Edit"></i>
									</a>
									&nbsp;&nbsp;
									<a href="#deleteExpenseModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Delete"></i>
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

	<!-- Add Expense Modal  --->
	<div id="addExpenseModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="recordnew_expenseform">
					<div class="modal-header">						
						<h4 class="modal-title">Add Expenses Record</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<div class="modal-body">
						<div class="form-group">
							<label>Select Category:</label>
							<select class="form-control" id="catid" required name="expense_catid"> 
								
							</select>
						</div>
						
						<div class="form-group">
							<label>Description:</label>
							<input type="text" id="description" name="description" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Amount:</label>
							<input type="text" id="amount" name="amount" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Date Recorded:</label>
							<input type="date" id="date" name="date" class="form-control" required>
						</div>
			
					</div>
					<div class="modal-footer">
					<input type="hidden" value="4" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="recordnew_expense">Save Expenses</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End Add Modal HTML -->

	<!-- Edit Modal HTML -->
	<div id="editExpenseModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_expensesform">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Expenses Record</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">

						<input type="hidden" id="id_u" name="id" class="form-control" required>

						<div class="form-group">
							<label>Expense Category:</label>
							<select class="form-control" id="catid_u" required name="expense_catid"> 
								
							</select>
						</div>
						
						<div class="form-group">
							<label>Description:</label>
							<input type="text" id="description_u" name="description" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Amount:</label>
							<input type="text" id="amount_u" name="amount" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Date Recorded:</label>
							<input type="text" id="date_u" name="date" class="form-control" required>
						</div>
			
					</div>
					<div class="modal-footer">
					<input type="hidden" value="3" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update_expenses">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- The Delete Modal HTML -->
	<div id="deleteDonorModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>	
					<div class="modal-header">						
						<h4 class="modal-title">Delete Expense</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete this particular expense ?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
	<script> 
		$(document).ready(function(){
			$('#allcustomers').addClass("active");
		});
	</script>
	
	
	</body>
</html>