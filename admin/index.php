<?php
    require_once("../stflairs_fns.php");
    require_once("../config.php");
    $org_profile = getOrgProfile($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Engineer Martin, Johnny Ade, and Aneke Telma">
    <title> <?php echo $org_profile['name']  ?>| Admin Sign-in</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/"> -->
	  <link rel="icon" href="../assets/img/logo.png">
    <!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script   src="assets/js/jquery-1.12.4.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
	  body{
			background: url('../assets/img/slide/slide.jpg');
			background-repeat: no-repeat;
			background-size:cover;
		}

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

	  .card{
			font-family: 'Sniglet', cursive;
			font-weight: normal;
			font-family: 'Raleway', sans-serif;
			margin: 0 auto;
			margin-top: 30px;
			width: 500px;
			color: #ff0000;
			text-align: center;
			opacity:0.9;
		}
		.btn-success{
		    background-color:#C72424;;
		    border:1px solid #C72424; ;
		}

    .btn-success:hover{
        background-color:#ff0044;
		    border:1px solid red;
        color:white;
    }

	
    </style>

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center bg-dark">
    <div class="card bg-light">
        
	<form class="form-signin">
		<img class="mb-4" src="../assets/img/logo.png" alt="" width="200px" height="150px">
		<h1 class="h6 mb-3 font-weight-normal">Enter Login Details</h1>

		<!--<label for="inputEmail" class="sr-only">Email address</label>-->
		<input type="email" id="username" class="form-control mb-2" placeholder="Email address" required autofocus name="email">

		<!--<label for="inputPassword" class="sr-only">Password</label>-->
		<input type="password" id="password" class="form-control" placeholder="Password" required name="pass">

		<div class="checkbox mb-3">
			<label> Click <a href="../index.php" class="text-secondary">  Here </a>  to return home </label>
		</div>
		

		<button class="btn btn-lg btn-success btn-block"  type="button" id="login">Sign in</button>
		<p class="mt-5 mb-3 text-muted">&copy;  <?php echo $org_profile['name']  ?> <?php echo date('Y')  ?> </p>
		
	</form>
	</div>

  </body>
</html>
<script>
    $(document).ready(function(){
        $('#login').on('click', function(){

            var username = $('#username').val();
            var password =  $('#password').val();

            if(username !="" && password!=""){

            $.ajax({
                url:"processadminlogin.php",
                type:"POST",
                data:{
                    username:username,
                    password:password
                },
                cache: false,
                success:function(dataResult){
                    if(dataResult=='success'){
                        window.location='admin/';
                    }
                    else{
                        alert("invalid login details");
                    }
                    alert (dataResult);
                }

            });

        }

        });
    });
</script>
