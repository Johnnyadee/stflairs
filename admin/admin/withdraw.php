
<?php include("header.php")?>

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

<main class="app-content">
      <div class="app-title">
        <div>
          <h1 style="font-size:15px"><i class="fa fa-edit"></i>Your Withdrawal Details</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="withdraw.php">Your Withdrawal Details</a></li>
          <li class="breadcrumb-item">Your Withdrawal Details</li>
        </ul>
      </div>
     <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header"> Withdrawal Request Page</div>
                    <div class="card-body">
                            
                            <div class="">
                          <div class="x-form" style=""> 
    <form method="POST" class="mt-3" action="<?php echo $_SERVER['PHP_SELF'] ?>">
	              <?php 
							$bal_query = mysqli_query($conn,"select * from financial_statistics where username='$username'"); 
							$bal_query = mysqli_fetch_array($bal_query);
		    	 ?>
                             <input type="hidden" name="_token" value="10JpTYqFTmGdh6hXX0qYpZZjRwNdZgt04uB4nsb9">                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                  <input type="text" class="form-control" id="amount"  name="amount" value="<?php echo $bal_query['account_bal']; ?>">
								   <input type="hidden" name="username" value="<?php echo $username ?>">
                                </div>
                                 <div class="form-group">
                                    <label for="bit_address">Wallet Address:</label>
									<?php 
											$bitacct = mysqli_query($conn,"select * from customer where username='$username'"); 
											$bitacct = mysqli_fetch_array($bitacct);
                                    ?>
                                    <input type="text" class="form-control" id="bit_address" name="bit_address" value="<?php echo $bitacct['bit_account']; ?>">
                                </div>
                            
                                
                              
        <button type="submit" class="btn btn-info" style="background-color: #011b33; border: solid 1px #011b33" id="submit" type="submit" name="submit">Save Changes</button>
                                 <a href="profile.php" class="btn btn-info"  style="background-color:#011b33; color:#fff; border: solid 1px #011b33">Back</a>
                            </form>
                            </div>
                             </div>
</div>
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
       <script type="text/javascript" src="editpersonaldetails.php_files/jquery.js"></script>
    <script type="text/javascript" src="editpersonaldetails.php_files/dataTables.js"></script>
    <script type="text/javascript" src="editpersonaldetails.php_files/chart.js"></script>
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
   


 


</div></main>
</body>
</html>
<?php
if (count($_POST) > 0) {
    $amount = $_POST['amount'];
	$r_status = 'Not Serviced Yet';
	$username = $_POST['username'];

				
				//insert form data in the database
				$result= mysqli_query($conn, "insert into withdraw values ('$amount','$r_status', '$username', now()  WHERE id='$username')");
			    echo "<script> alert('successfully changed') </script>";
				//echo $insert?'ok':'err';
			
		
}
?>