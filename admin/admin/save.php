<?php
// This code updates a production record
include '../../config.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$id    =$_POST['id'];
		$prodid =$_POST['productid'];
		$cement_quantity = $_POST['cement_quantity'];
		$stone_dust_quantity    = $_POST['sd_quantity'];
		$quantity_produced    = $_POST['quantity_produced'];

		$sql = "UPDATE production SET prod_id='$prodid', cement_quantity='$cement_quantity', stone_dust_quantity='$stone_dust_quantity', quantity_produced='$quantity_produced', date_time_updated=now() where id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// This code here adds a new production to the database
if(count($_POST)>0){
	if($_POST['type']==2){

		$proddate = $_POST['datetime'];
		$prodid =$_POST['productid'];
		$cement_quantity = $_POST['cement_quantity'];
		$stone_dust_quantity    = $_POST['sd_quantity'];
		$quantity_produced    = $_POST['quantity_produced'];
		
		$sql = "INSERT INTO production VALUES('','$prodid','$cement_quantity','$stone_dust_quantity','$quantity_produced','$proddate','$proddate')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// This code here updates an expense record
if(count($_POST)>0){
	if($_POST['type']==3){

		$id=$_POST['id'];
		$expense_catid=$_POST['expense_catid'];
		$description =$_POST['description'];
		$amount = $_POST['amount'];
		$date=$_POST['date'];
		
		$sql = "UPDATE expenses SET catid='$expense_catid', description='$description', total_amount='$amount', datetime='$date' WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// // This code records a new expenses into the database
if(count($_POST)>0){
	if($_POST['type']==4){
		$catid = $_POST['expense_catid'];
		$description =$_POST['description'];
		$amount = $_POST['amount'];
		$date    = $_POST['date'];
		
		$sql = "INSERT INTO expenses VALUES('','$catid','$description','$amount','$date')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// The code here updates sales transactions
if(count($_POST)>0){
	if($_POST['type']==5){

		$id=$_POST['id'];
		$description =$_POST['description'];
		$quantity=$_POST['quantity'];
		$total_amount = $_POST['total_amount'];
		$amount_paid = $_POST['amount_paid'];
		$balance=$_POST['balance'];
		$payment_method=$_POST['payment_method'];
		$date_of_payment = $_POST['date'];
		
		$sql = "UPDATE sales SET description='$description', quantity='$quantity', total_amount='$total_amount', amount_paid='$amount_paid', balance='$balance', payment_method='$payment_method',  date_time_created='$date_of_payment', date_time_updated=now() WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// // This code records a new sales into the database
if(count($_POST)>0){
	if($_POST['type']==6){
	
		$customerid = $_POST['customerid'];
		$productid = $_POST['productid'];
		$description =$_POST['description'];
		$quantity=$_POST['quantity'];
		$total_amount = $_POST['total_amount'];
		$amount_paid = $_POST['amount_paid'];
		$balance=$_POST['balance'];
		$payment_method=$_POST['payment_method'];
		$date_of_payment = $_POST['date'];
		
		$sql = "INSERT INTO sales VALUES('','$customerid','$productid','$description','$quantity','$total_amount','$amount_paid','$balance','$payment_method','$date_of_payment',now())";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}


// This section of the save code updates the rawmaterial table of the database
if(count($_POST)>0){
	if($_POST['type']==7){
	    
		$id=$_POST['id'];
		$title=$_POST['title'];
		$quantity=$_POST['quantity'];
		$measureunit=$_POST['measureunit'];

		$sql = "UPDATE rawmaterial SET title='$title', quantity='$quantity', measure_unit='$measureunit', date_time_updated=now() WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// // This code records a new raw material into the database
if(count($_POST)>0){
	if($_POST['type']==8){
		$title =$_POST['title'];
		$quantity=$_POST['quantity'];
		$measureunit = $_POST['measureunit'];
		
		$sql = "INSERT INTO rawmaterial VALUES('','$title','$quantity','$measureunit','newmaterial.jpg',now(),now())";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// This section of the save code updates the rawmaterial table of the database
if(count($_POST)>0){
	if($_POST['type']==9){
	    
		$id=$_POST['id'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$country=$_POST['country'];
		$address=$_POST['address'];
		$city=$_POST['city'];

		$sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', country='$country', address='$address', city='$city', date_time_updated=now() WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}

// // This code records a new raw material into the database
if(count($_POST)>0){
	if($_POST['type']==10){

		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$country=$_POST['country'];
		$address=$_POST['address'];
		$city=$_POST['city'];


		$sql = "INSERT INTO customer VALUES('','$firstname','$lastname','$email','$phone','$country','$address','$city','newcustomer.png',now(),now())";
		if (mysqli_query($conn, $sql)) {
			$query = mysqli_fetch_array(mysqli_query($conn,"select * from customer where id=(SELECT LAST_INSERT_ID())"));
			$customer_id = $query['id'];
			$sql2 = mysqli_query($conn,"INSERT INTO cus_prod_prices VALUES('','$customer_id','1','320',now(),now())");
			$sql3 = mysqli_query($conn,"INSERT INTO cus_prod_prices VALUES('','$customer_id','2','400',now(),now())");
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}

		
		mysqli_close($conn);
	}
}

// // This code records a new upfront payment into the database
if(count($_POST)>0){
	if($_POST['type']==12){

		$customerid=$_POST['customerid'];
		$paymentdescription=$_POST['paymentdescription'];
		$amount=$_POST['amount'];
		$pop_url = "default_pop.png";
		$date=$_POST['date'];
		
		$sql = "INSERT INTO upfrontpayments VALUES('','$customerid','$paymentdescription','$amount','$pop_url','$date','$date')";
		if (mysqli_query($conn, $sql)) {
			
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}

		mysqli_close($conn);
	}
}

//This code updates upfront payment table

if(count($_POST)>0){
	if($_POST['type']==11){
		$id=$_POST['id'];
		$customer_id = $_POST['customerid'];
		$paymentdescription=$_POST['paymentdescription'];
		$totalamount=$_POST['totalamount'];
		$date=$_POST['date'];
		
		$sql = "UPDATE upfrontpayments SET payment_description='$paymentdescription', total_amount='$totalamount', date_time_updated='$date' WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			$error= mysqli_error($conn);
			echo json_encode(array("statusCode"=>201,"error"=>$error));
		}
		mysqli_close($conn);
	}
}


// One Delete code for deleting any selected Entity
if(count($_POST)>0){
	if($_POST['type']==30){
		$id=$_POST['id'];
		$sql = "DELETE FROM `customer` WHERE id= '$id'";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}




?>
