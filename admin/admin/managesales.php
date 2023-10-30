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

	$sales = getAllSales($conn);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>All Sales Page</title>
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">View All Sales </a>
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
          <li class="breadcrumb-item"><a href="#">List of all Sales</a></li>
        </ul>
      </div>      
      <!-- The end of the top information bar -->
	  
      <div class="row">
        <div class="col-md-12">
          <div class="tile">

			<div class="row m-1">
				<div class="col-lg-6"> <p class="tile-title" style="font-size:14px; font-weight:bold">List of all Sales <span class="ml-5" style="font-size:14px"> </p></div>
				<div class="col-lg-6 text-right"><button class="btn btn-primary load_customers" data-toggle="modal" data-target="#addSalesModal"> Add Sales</button> </div>
			</div>
            
                
            <div class="embed-responsive table-responsive">
             <!--<h4 class="text-center">Transaction history</h4>-->
                <div class="table-responsive">
            			<table class="table table-hover table-bordered table-striped" id="refrralTable">
            				<thead>
                            <tr class="xcrud-th">
									  <th>S/N</th>
									  <th>Description</th>
									  <th>Quantity</th>	
									  <th>Amount Paid</th>
									  <th>Balance</th>
									  <th>Payment Method</th>
									  <th>Date of Payment</th>		
                                      <td>Action</td>		 
								  </tr>
            				</thead>
            				<tbody>
            				
            				<?php 
            				$i =1;
            				while($row=mysqli_fetch_array($sales)){ ?>
            				<tr id="<?php echo $row["id"]; ?>">
								
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" class="user_checkbox" data-id="<?php echo $row["id"]; ?>">
										<label for="checkbox2"><?php echo $row["id"]; ?>  </label>
									</span>
								</td>
								  <td>
									  <?php  echo $row['description'] ?>
								  </td>
								  <td>
									  <?php  echo $row['quantity'] ?>
								  </td>
								  <td>N<?php  echo number_format($row['total_amount'],2)?></td>
								  <td>
									  N<?php  echo number_format($row['balance'],2)?>
								  </td>
								  <td>
									  <?php  echo $row['payment_method'] ?>
								  </td>
								  <td>
									  <?php  echo $row['date_time_created'] ?>
								  </td>

								<td width="100px">
									<a href="#editSalesModal" class="" data-toggle="modal">
										<i class="material-icons edit_sales" data-toggle="tooltip" 
										data-id="<?php echo $row["id"]; ?>"
										data-description="<?php echo $row["description"]; ?>"
										data-quantity="<?php echo $row["quantity"]; ?>"
										data-amount="<?php echo $row["total_amount"]; ?>"
										data-amountpaid="<?php echo $row["amount_paid"]; ?>"
										data-balance="<?php echo $row["balance"]; ?>"
										data-paymentmethod="<?php echo $row["payment_method"]; ?>"
										data-date="<?php echo $row["date_time_created"]; ?>"
										title="Edit"></i>
									</a>
									&nbsp;&nbsp;
									<a href="#deleteSalesModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal">
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

	<!-- Add Modal HTML -->
	<div id="addSalesModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="recordnew_salesform">
					<div class="modal-header">						
						<h4 class="modal-title">Add New Sales </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<div class="modal-body">

						<div class="form-group">
							<label>Select Customer:</label>
							<select  id="customerid" name="customerid" class="form-control" required>
							
							</select>
						</div>

						<div class="form-group">
							<label>Select Product:</label>
							<select  id="productid" name="productid" class="form-control" required>
							
							</select>
						</div>
						
						<div class="form-group">
							<label>Description:</label>
							<input type="text" class="form-control" id="description" name="description" /> 
						</div>
						
						<div class="form-group">
							<label>Quantity Sold:</label>
							<input type="text" id="quantity" name="quantity" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Total Amount:</label>
							<input type="text" id="amount" name="total_amount" class="form-control calc" required>
						</div>
						<div class="form-group">
							<label>Amount Paid :</label>
							<input type="text" id="amountpaid" name="amount_paid" class="form-control calc" required>
						</div>

						<div class="form-group">
							<label>Balance:</label>
							<input type="text" id="balance" name="balance" class="form-control" required readonly>
						</div>

						<div class="form-group">
							<label>Payment Method:</label>
							<select  id="payment_method2" name="payment_method" class="form-control" required>
								<option value="None"> -Select Payment Method-</option>
								<option value="Credit Sales"> Credit Sales </option>
								<option value="Cash"> Cash </option>
								<option value="Bank Transfer"> Bank Transfer </option>
								<option value="Mobile Transfer"> POS Transfer </option>
								<option value="Cheque"> Cheque </option>
							</select>
						</div>

						<div class="form-group">
							<label> Sales Date:</label>
							<input type="date" id="date" name="date" class="form-control" required>
						</div>
										
					</div>

					<div class="modal-footer">
						<input type="hidden" value="6" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="recordnew_sales">Add New Sales</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<!-- End of Add Modal -->

	<!-- Edit Modal HTML -->
	<div id="editSalesModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_salesform">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Sales Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						
						<div class="form-group">
							<label>Description:</label>
							<input type="text" class="form-control" id="description_u" name="description" /> 
						</div>
						
						<div class="form-group">
							<label>Quantity Sold:</label>
							<input type="text" id="quantity_u" name="quantity" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Total Amount:</label>
							<input type="text" id="amount_u" name="total_amount" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Amount Received:</label>
							<input type="text" id="amountpaid_u" name="amount_paid" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Balance:</label>
							<input type="text" id="balance_u" name="balance" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Payment Method:</label>
							<select  id="payment_method" name="payment_method" class="form-control" required>
							
							</select>
						</div>

						<div class="form-group">
							<label>Change Date:</label>
							<input type="text" id="date_u" name="date" class="form-control" required>
						</div>
										
					</div>

					<div class="modal-footer">
						<input type="hidden" value="5" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update_sales">Update Sales</button>
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
						<h4 class="modal-title">Delete Sales</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete this sales ?</p>
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
			$('#managesales').addClass("active");
		});
	</script>
	
	
	</body>
</html>