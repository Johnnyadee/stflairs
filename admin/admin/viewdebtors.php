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

	$debtors = getAllDebtors($conn);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>View Debtors of Nanakhadijat</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Main CSS-->
		<link rel="stylesheet" type="text/css" href="Dashboard_files/main.css">
		<link rel="stylesheet" href="Dashboard_files/datatables.css">
		<!-- Font-icon css-->
		<link rel="stylesheet" type="text/css" href="Dashboard_files/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

			#viewDebtDetailModal .modal-dialog{

				min-width:800px;

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
		<a style="font-weight:bold" class="app-header__logo" href="viewdebtors.php">Debtors Page</a>
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
          <li class="breadcrumb-item"><a href="#">Nanakhadijat Debtors Page</a></li>
        </ul>
      </div>      
      <!-- The end of the top information bar -->
	  
	  <!--  The site's Programme Section  -->
	  <div class="row">
        <div class="col-md-12">
          <div class="tile">

            <h3 class="tile-title" style="font-size:14px">Below are List of our debtors <span class="ml-5" style="font-size:14px"> </h3>
                
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
            						<th>Customer Name</th>
            						<th>Image</th>
									<th>Phone</th>
            						<th>Total Amount</th>
									<th>ACTION</th>		 
            					</tr>
            				</thead>
            				<tbody>
            				
            				<tr>
								<?php
									$i =1;
									while($row=mysqli_fetch_array($debtors)){ 
									
								?>
								<tr id="<?php echo $i ?>">
								
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" class="user_checkbox" data-id="<?php echo $row["id"]; ?>">
										<label for="checkbox2"></label>
									</span>
								</td>
								<td> <?php  echo $i ?> </td>
            					<td><?php echo getCustomerName($conn,$row["customer_id"]) ?></td>
            					<td>
									<a href="#"  data-toggle="modal"> 
										<img class="avatar round-img rounded-circle update_image" 
											alt="Projects's Images" 
											src="../../images/customerpix/<?php  echo getCustomerImage($conn,$row['customer_id']) ?>" 
											width="50px" height="50px" 
											data-id="<?php echo $row['id'] ?>" 
										/>  </td>
									</a>
								</td>
								<td><?php echo getCustomerPhone($conn,$row["customer_id"]) ?></td>
								<td><?php  echo getCustomerTotalDebt($conn,$row['customer_id']) ?></td>
								
								<td width="100px">
									<button 
										class="btn btn-primary view_debt_details" data-toggle="modal" data-target="#viewDebtDetailModal" 
										 data-customername="<?php echo getCustomerName($conn,$row["customer_id"])  ?>"
										 data-customerid ="<?php echo $row['customer_id'] ?>"
										>View details
									</button>
								</td>

            				</tr> 
							<?php
							$i++;
									}
							?>         				
            				
            				</tbody>
            
            			</table>
            			
                </div>
            </div>
          </div>
        </div>
                  
      </div>
      
     
      
      
    </main>


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
    <!--<script type="text/javascript" src="Dashboard_files/chart.js"></script>-->

	<script src="ajax.js"></script>


	<!-- Edit Website and Org Profile HTML -->
	<div id="viewDebtDetailModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form id="update_project_form">
					<div class="modal-header">						
						<h4 class="modal-title" id="titledata">List of Credit Sales By  </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						
						<div class="form-group" id="debt_view_list">
							
						</div>

					</div>
					<div class="modal-footer">
					<input type="hidden" value="7" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<!-- <button type="button" class="btn btn-info" id="update_project"></button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	
		
	<!-- The Update Programme picture Modal HTML -->
	<!-- <div id="updatephotomodal" class="modal fade">
		<div class="modal-dialog">
		    
			<div class="modal-content">
				<form method="POST" action="changeprojectpix.php" enctype="multipart/form-data">	
					<div class="modal-header">						
						<h4 class="modal-title">Change Project Image</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					
					<div class="modal-body">
					    <div class="row">
					            <div class="col-lg-6 col-md-6 col-sm-12">
					                <input type="hidden" id="id" name="project_id" class="form-control">
					                
            						<p>Are you sure you want to update this Project pix ?</p>
            						<img class="avatar round-img" alt="Customer's passport" id="imgbox" src="" width="140px" height="100px" />
					            </div>
					            <div class="col-lg-6 col-md-6 col-sm-12">
					                <div class="form-group col-md-12">
										<h3>New Project image</h3>
										<input id="fileupload" type="file" name="file" />
									
									</div>
									
					            </div>
					            
					    </div>
	
					</div>
					
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-danger"> Upload </button>
					</div>
				</form>
			</div>
		</div>
	</div> -->

	<script> 
		$(document).ready(function(){
			$('#viewdebtors').addClass("active");
		});
	</script>
	</body>
</html>