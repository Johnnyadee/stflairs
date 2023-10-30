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
   
    <title> Deposit Transaction</title>
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
  
  <body class="app sidebar-mini rtl  pace-done">
	  <div class="pace  pace-inactive">
		<div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%" data-progress="99">
			<div class="pace-progress-inner"></div>
		</div>
		
			<div class="pace-activity"></div>
		</div>

    <!-- Navbar-->
    <header class="app-header">
		<a style="font-weight:bold" class="app-header__logo" href="index.php">Maxfxt user</a>
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
			<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><?php if($passport==''){
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
		<script src="../js/jquery-1.12.4.min.js"> </script>
		
		<script>

		$(document).ready(function(){
				$('#plan').on('change', function(){
					var selected_plan = $('#plan').val();
					if(selected_plan=='monthly'){
						$('#duration').val('One Month');
					}
					else if(selected_plan=='short'){
						$('#duration').val('3 Months');
					}
					else{
						$('#duration').val('9 Months');
					}
				});

				
				$('#amount').on('mouseleave', function(){
					var amtcommadollar = $('#amount').val();
					amountdollar = amtcommadollar.replace(/,/g, "");
					amount = amountdollar.replace(/\$/g,"");
					
					var amount	=	   Number(amount);
					var plan	=		$("#plan").val();
					var interest	= 0.0;
					var expected_amount = 0.0;
					
					if(plan=='monthly'){
						interest = 50;
					}
					else if(plan=='short'){
						interest = 100;
					}
					else{
						interest = 200;
					}

						expected_amount = (interest/100 * amount) + amount;
						formatCurrency($('#returnamt').val(expected_amount), "blur");
				});
				
		});

	</script>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1 style="font-size:15px"><i class="fa fa-edit"></i>Invest Fund</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
          <li class="breadcrumb-item">Client Investment page</li>
        </ul>
      </div>
            <div class="row">

              <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">Invest Fund here</div>
                    <div class="card-body">
                            
                            <div class="">
                          <div class="x-form" style=""> 
                          <form method="POST" class="mt-3" action="processdeposit.php?username=<?php  echo $username ?>">
							 	<div class="form-group">
                                    <label for="fullname">Select Investment Plan:</label>
                                    <select class="form-control" id="plan"  name="plan">
										<option value=""> Select Plan </option>
										<option value="monthly">Monthly</option>
										<option value="short"> Short term </option>
										<option value="long"> Long term </option>
									</select>
                                </div>

								<div class="form-group">
                                    <label for="email">Maturity Duration :</label>
                                    <input type="text" class="form-control" id="duration"  name="duration" >
                                </div>

                                 <div class="form-group">
                                    <label for="email">Amount to Invest :</label>
                                    <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount"  data-type="currency">
                                </div>

                                 <div class="form-group">
                                    <label for="returnamt">Expected Return Amount:</label>
                                    <input type="text" class="form-control" id="returnamt" name="returnamt" />
                                </div>
                                
                              
                                  <button type="submit" class="btn btn-info" style="background-color: #011b33; border: solid 1px #011b33" id="submit" name="submit">Invest</button>
                                 <a href="profile.php" class="btn btn-info"  style="background-color:#011b33; color:#fff; border: solid 1px #011b33">Back</a>
                            </form>
                            </div>
						</div>
				</div>
			</div>
        </div>

  		<!--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
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
	
	<script src="formatcurrency.js"></script>
	<script>
	$("input[data-type='currency']").on({
		keyup: function() {
		formatCurrency($(this));
		},
		blur: function() { 
		formatCurrency($(this), "blur");
		}
	});	
				
	</script>

    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
   
		</div>
	</main>
</body>
</html>
