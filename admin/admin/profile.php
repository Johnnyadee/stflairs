<?php include("header.php")?>

      <!-- Sidebar menu-->
    <?php include("sidebar.php")?>

<style type="text/css">
    .btn-success
    {
        background-color: #25afac;
        border: solid 1px #25afac;

    }
    .modal-header
    {
        height: 30px;
        border-bottom: none;
        background: white;
       color: #53d192;
    }
    .modal-header .close {
    margin-top: -26px;
    color: #53d192;
   
}
.close
{
    opacity: 1;
}
.wizard-card .picture input[type="file"] 
{
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}
    .wizard-card .picture
 {
    width: 106px;
    height: 106px;
    background-color: #999999;
    /* border: 4px solid #CCCCCC; */
    color: #FFFFFF;
    /* border-radius: 50%; */
    margin: 5px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}
.wizard-card .picture-container 
{
    position: relative;
    cursor: pointer;
    text-align: center;
}
.image-container {
  min-height: 100vh;
  background-position: center center;
  background-size: cover;
}
.wizard-card .picture-src {
  width: 100%;
}
.alert-success {
    border-color: none;
}
</style>

<main class="app-content ">
      <div class="app-title">
        <div>
          <h1 style="font-size:15px"><i class="fa fa-dashboard"></i>  User Profile</h1>
        
        </div>
     <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">User Profile</li>
          <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
        </ul>
      </div>
	  <div class="tile mb-4">
    <section class=" container-fluid">

        <p class="mt-5"></p>

       <section class="panel-create mr-5">
                            
                            <div class="panel-body">

                                <div class="container">
                                <div class="row">

            
                            <div class="col-md-2 mb-5 mr-5">

    
	<?php if($passport==''){
		  echo "<i class='fa fa-user fa-lg text-light'></i>";
										} else{ ?>
           <img src="../passport/<?php echo $passport ?>" alt="Image" style="margin-top:28px;" width="120px">
		   <?php  } ?>
  <a href="#" style="color:#53d192; font-size:18px; " data-target="#endorse" data-toggle="modal">Change Image </a>
  
                               
                                     </div>

                                     <div class="col-md-4">
                                    
                                         <p class="title-details mb-4"></p><h3 style="font-size:15px">Personal Details:   <a class="ml-1" href="editpersonaldetails.php"><img src="profile_files/edit.png"></a></h3><p></p>
                                         <hr>
                                         <div class="row">
                                             <div class="col-md-4 mb-1">
                                               Full Name:
                                             </div>
                                             <div class="col-md-7">
                                                  <?php echo $fullname ?>                                                                                       
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-4 mb-1">
                                               User Name: 
                                             </div>
                                             <div class="col-md-7">
                                                      <?php echo $username ?> 
                                                                                          </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-4 mb-1">
                                                Email:
                                             </div>
                                             <div class="col-md-7">
                                                    <?php echo $email ?>
                                             
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-4 mb-1">
                                                Bit Account:
                                             </div>
                                             <div class="col-md-7">
                                                         <?php echo $bit_account ?>
                                                                                          </div>
                                        </div>
                                      
                                    
</div>
                                     

</div>


                        </div></div></section>

    </section>

  </div>


    <!--=====================================
       EDORSE DIALOG FORM
=====================================-->

     <div class="modal fade" id="endorse" tabindex="-1" role="dialog" aria-labelledby="register form" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header modal-color text-white">
           
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- registration form -->
              <div class="d-flex justify-content-md-center mt-2">
              <h1 class="mb-5">Upload profile Image</h1>
            
              </div>
              <div class="d-flex justify-content-md-center">
         
              <div class="picture-container mt-5">
              <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                 <input type="hidden" name="_token" value="zcZnXPdW3TZLRQPwWGKecaSPv6yR6lC4g8zT1m5u">             <div class="picture"><?php if($passport==''){
                                             echo "<i class='fa fa-user fa-lg text-light'></i>";
										} else{ ?>
           <img src="../passport/<?php echo $passport ?>" alt="Image" class="picture-src mb-5" id="wizardPicturePreview" title="" width="200" height="200">
		   <?php  } ?></a>
											  <img src="profile_files/default-avatar.html" class="picture-src mb-5" id="wizardPicturePreview" title="" width="200" height="200">
                          <br>
                            <input type="file" id="wizard-picture" name="image" style="background-color:silver;color: #fff" required="">
                                          </div>
                                          <!--<h6>Choose Passport</h6>-->
                                      </form></div>
              </div>
            
          </div>
        
        
           <div class="d-flex justify-content-md-center mb-5">
            <h5 class="mb-3"><button type="submit" class="btn-support mb-3" id="share" style="margin-left: 3px; font-size: 14px; opacity: 1; background-color: #53d192; padding-right: 10px; padding-left: 10px; padding-bottom: 10px;padding-top: 10px; border: solid 1px #53d192; color: #fff; font-weight: bold;" name="upload">Save Profile Image</button></h5>

            
        
        </div>
          </div>
        </div>
      </div>

<script src="profile_files/jquery_002.js"></script>

<!--=====================================
       EDORSE DIALOG CONFIRMATION
=====================================-->

<script type="text/javascript">
$("#wizard-picture").change(function(){
        readURL(this);
    });
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

</script>

  <!--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
 <script src="profile_files/jquery-3.js"></script>

 
    <script src="profile_files/popper.js"></script>
    <script src="profile_files/bootstrap.js"></script>
    <script src="profile_files/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="profile_files/pace.js"></script>
    <!-- Page specific javascripts-->
       <script type="text/javascript" src="profile_files/jquery.js"></script>
    <script type="text/javascript" src="profile_files/dataTables.js"></script>
    <script type="text/javascript" src="profile_files/chart.js"></script>
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
</main>
</body>
</html>