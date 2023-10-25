<?php
//connect to database server and select the particular database
include("../../config.php");

$prodid = mysqli_real_escape_string($conn, $_GET['productid']);
$custid = mysqli_real_escape_string($conn, $_GET['customerid']);
$quantity = mysqli_real_escape_string($conn, $_GET['quantity']);

$result = mysqli_query($conn, "SELECT * FROM cus_prod_prices where product_id='$prodid' and customer_id='$custid'");
if(!$result){
    echo 'error';
}
else{

    $unit_price = mysqli_fetch_array($result);
    if($unit_price['price']>0){
        echo $unit_price['price'] * $quantity;
    }
    else{
        echo "error";
    }
}
mysqli_free_result($result);
mysqli_close($conn);
 
?>