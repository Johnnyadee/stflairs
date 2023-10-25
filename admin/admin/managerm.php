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

    $rawmaterials= getRawMaterials($conn);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Manage Raw Materials Page</title>
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
		<a style="font-weight:bold" class="app-header__logo" href="index.php">Manage Raw Materials</a>
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
            <li><a class="dropdown-item" href="changepassword.php"><i class="fa fa-cog fa-lg"></i>Change Password</a></li>
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
          <li class="breadcrumb-item"><a href="#">Nanakhadijat Raw Materials Page</a></li>
        </ul>
      </div>      
      <!-- The end of the top information bar -->
	  <!--  The site's Programme Section  -->
	  <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="row m-1">
				<div class="col-lg-6"> <p class="tile-title" style="font-size:14px; font-weight:bold">List of all Raw Materials <span class="ml-5" style="font-size:14px"> </p></div>
				<div class="col-lg-6 text-right"><button class="btn btn-primary addRawMaterialModal" data-toggle="modal" data-target="#addRawMaterialModal"> Add New Materials</button> </div>
			</div>
                
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
            						<th>Title</th>
									<th>Current Quanity</th>
									<th>Measurement Unit </th>
            						<th>Image</th>
									<th>Date Updated </th>
									<th>ACTION</th>		 
            					</tr>
            				</thead>
            				<tbody>
            				
            				<tr>
								<?php
									$i =1;
									while($row=mysqli_fetch_array($rawmaterials)){ 
								?>
								<tr id="<?php echo $row["id"]; ?>">
								
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" class="user_checkbox" data-id="<?php echo $row["id"]; ?>">
										<label for="checkbox2"></label>
									</span>
								</td>
								<td> <?php  echo $row['id'] ?> </td>
            					<td><?php echo $row["title"] ?></td>
								<td><?php echo $row["quantity"] ?></td>
								<td><?php echo $row["measure_unit"] ?></td>
            					<td> 
									<a href="#updatephotomodal"  data-toggle="modal"> 
									 	<img class="avatar round-img rounded-circle update_image" 
										alt="Programme's Images" 
										src="../../images/rawmaterial/<?php  echo $row['image_url'] ?>" 
										width="80px" height="80px" 
										data-id="<?php echo $row['id'] ?>" /> 
									</a>
								<td><?php echo $row["date_time_updated"] ?></td>
								</td>

								<td width="100px">
									<a href="#editRawMaterialModal" class="" data-toggle="modal">
										<i class="material-icons edit_rawmaterial" data-toggle="tooltip" 
										data-id="<?php echo $row["id"]; ?>"
										data-title="<?php echo $row["title"]; ?>"
										data-quantity="<?php echo $row["quantity"]; ?>"
										data-measureunit="<?php echo $row["measure_unit"]; ?>"
										data-image="<?php echo $row["image_url"]; ?>"
										title="Edit"></i>
									</a>
									&nbsp;&nbsp;
									<a href="#deleteRawMaterialModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Delete"></i>
									</a>
								</td>

            				</tr> 
							<?php
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
						
	<!-- Add Modal HTML -->
	<div id="addRawMaterialModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="recordnew_rawmaterialform">
					<div class="modal-header">						
						<h4 class="modal-title">Add a new Raw Material  </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<div class="modal-body">
						
						<div class="form-group">
							<label>Title:</label>
							<input type="text" class="form-control" id="title" name="title" /> 
						</div>
						
						<div class="form-group">
							<label>Current Quantity:</label>
							<input type="text" id="quantity" name="quantity" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Measurement Unit:</label>
							<input type="text" id="measureunit" name="measureunit" class="form-control" required>
						</div>
	
					</div>

					<div class="modal-footer">
						<input type="hidden" value="8" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="recordnew_rawmaterial">Add New Sales</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- End of Add Modal -->

	<!-- Edit Raw Materials Modal -->
	<div id="editRawMaterialModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_rawmaterialform">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Raw Material </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						
						<div class="form-group">
							<label>Title:</label>
							<input type="text" class="form-control" id="title_u" name="title" /> 
						</div>
						
						<div class="form-group">
							<label>Current Quantity:</label>
							<input type="text" id="quantity_u" name="quantity" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Measurement Unit:</label>
							<input type="text" id="measureunit_u" name="measureunit" class="form-control" required>
						</div>
										
					</div>

					<div class="modal-footer">
						<input type="hidden" value="7" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update_rawmaterial">Update Material</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	<!-- The Delete Modal HTML -->
	<div id="deleteProgrammeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>	
					<div class="modal-header">						
						<h4 class="modal-title">Delete Raw Materials Image</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete this Raw Material ?</p>
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
	
	<!-- The Update Gallery picture Modal HTML -->
	<div id="updatephotomodal" class="modal fade">
		<div class="modal-dialog">
		    
			<div class="modal-content">
				<form method="POST" action="changegallerypix.php" enctype="multipart/form-data">	
					<div class="modal-header">						
						<h4 class="modal-title">Change Raw Material Image</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					
					<div class="modal-body">
					    <div class="row">
					            <div class="col-lg-6 col-md-6 col-sm-12">
					                <input type="hidden" id="id" name="gallery_id" class="form-control">
					                
            						<p>Are you sure you want to update this raw material pix ?</p>
            						<img class="avatar round-img rounded-circle" alt="Customer's passport" id="imgbox" src="" width="100px" height="100px" />
					            </div>
					            <div class="col-lg-6 col-md-6 col-sm-12">
					                <div class="form-group col-md-12">
										<h3>New Raw Materials image</h3>
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
	</div>

	<script> 
		$(document).ready(function(){
			$('#managerm').addClass("active");
		});
	</script>
	</body>
</html>