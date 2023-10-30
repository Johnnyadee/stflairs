<?php  
	//retrive the user ID the address bar
    session_start();
	$admin_id = $_SESSION['admin_id'];
	include("../../database.php");	
	$result = mysqli_query($conn,"select * from admin where username='$admin_id'");
	if(!$result){
		echo mysqli_error($conn);
		exit();
	}
	$result = mysqli_fetch_array($result);

    $fullname=$result['fullname'];
	
	$id= $_GET['depositid'];
	$result2 = mysqli_query($conn,"select * from deposit where id='$id'");
	if(!$result2){
		echo mysqli_error($conn);
		exit();
	}
	$result2 = mysqli_fetch_array($result2);
	
?>
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

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Admin::Proof Of Payment Page</title>
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


  <body>
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

  <?php  include("sidebar.php"); ?>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1 style="font-size:15px"><i class="fa fa-edit"></i>Preview POP </h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="profile.php">Transaction Details</a></li>
          <li class="breadcrumb-item"> Preview POP</li>
        </ul>
      </div>

            <div class="row">

              <div class="col-lg-12">

                <div class="card">
                    <div class="card-header h3" style="text-align:center">View proof of payment</div>
                     
                    <div class="row">

                        <div class="col-lg-6 col-sm-12">

                            <p style="text-align:center; margin-top:5px"> Transaction details Preview</p>
                            <table class="table table-striped m-3">
                                     
                                    <tbody>
                                    <tr>
                                        <th>Customer Username</th>
                                        <td id='username'><?php  echo $result2['username']?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Transaction Plan</th>
                                        <td><?php echo $result2['plan'] ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Amount:</th>
                                        <td id='amount'>$<?php echo $result2['amount'] ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <th>Date Initiated</th>
                                        <td><?php  echo $result2['date_initiated'] ?> </td>
                                        
                                    </tr>


                                    <tr>
                                        <th>Order Status:</th>
                                        <td> <?php  echo $result2['order_status'] ?></td>
                                        <input type="hidden" id="depositid"  value="<?php echo $result2['id'] ?>"/>
                                    </tr>


                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                                    
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                                
                                
                                                   
                        </div>

                        <div class="col-lg-6">
                                <table class="table table-stripped"> 
                                    <tr>
                                        <td style="text-transform:uppercase; font-size:20px"> POP Image  Preview</td>
                                    </tr>
                                    <tr>
                                        <?php

                                        if($result2['teller_img'] != ""){
                                        ?>

                                        <td><img  src="../../client/tellers/<?php echo $result2['teller_img'] ?>" style="width:300px; height:250px"></td>
                                        
                                        <?php
                                        }
                                        else{
                                            ?>
                                            <td><img  src="../../client/tellers/defaultpop.png" style="width:300px; height:250px"></td>
                                            <?php

                                        }
                                        ?>

                                    </tr>
                                    <tr>
                                        <td style="text-transform:uppercase; font-size:20px"> 
                                        <button class="btn btn-primary" id="confirm" style="color:white; font-weight:bold; text-decoration:none">
									        Confirm Customer Payment 
									    </button>
                                </td>
                                    </tr>

                                </table>
                                
                        </div>
                     </div>
                   
                   
                </div>  

                </div>
               

        </div>

  		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 		<script src="editpersonaldetails.php_files/jquery-3.js"></script>
        <script src="editpersonaldetails.php_files/popper.js"></script>
        <script src="editpersonaldetails.php_files/bootstrap.js"></script>
        <script src="editpersonaldetails.php_files/main.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="editpersonaldetails.php_files/pace.js"></script>
        <!-- Page specific javascripts-->
        <script type="text/javascript" src="property_files/jquery.js"></script>
        <script type="text/javascript" src="editpersonaldetails.php_files/dataTables.js"></script>
        <script type="text/javascript" src="editpersonaldetails.php_files/chart.js"></script>

    <script>
        $(document).ready(function(){
            $('#confirm').on('click',function(){
                var  username = $('#username').html();
                var amount = $('#amount').html();
                var id = $('#depositid').val();

               $.ajax({
                   url:"confirm.php",
                   type:"POST",
                   data:{
                    username:username,
                    amount:amount,
                    id:id
                   },
                   cache:false,
                   success:function(dataResult){
                    alert(dataResult);
                    window.location="alldeposits.php"
                   }

               });

            });
        });
    </script>
 
    <!-- Google analytics script-->
   
		</div>
	</main>
</body>
</html>
