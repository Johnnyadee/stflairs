<?php
//connect to database server and select the particular database
include("../../config.php");

$custid = mysqli_real_escape_string($conn, $_GET['customerid']);

$result = mysqli_query($conn, "SELECT * FROM sales where  customer_id='$custid' and balance>0");

echo "<div class='table-responsive'>
    <table class='table table-hover table-bordered table-striped' id='refrralTable'>
    <thead>
        <tr class='xcrud-th'>
            <th>S/N</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Total Bill</th>
            <th>Amount Paid</th>
            <th>Balance</th>
            <th>Date</th> 
        </tr>

    </thead>
    <tbody>";
    $i =1;
while($row = mysqli_fetch_array($result))
  { 
    $desc = $row['description'];
    $quantity = $row['quantity'];
    $total_amount =$row['total_amount'];
    $amount_paid =$row['amount_paid'];
    $balance = $row['balance'];
    $date = $row['date_time_created'];

echo"
    <tr> 
        <td> $i </td>
        <td> $desc</td>
        <td> $quantity </td>
        <td> $total_amount</td>
        <td> $amount_paid</td>
        <td> $balance</td>
        <td>$date</td>
    </tr> "; 
    $i++;   
  }
  	
echo "</tbody>

</table>

</div>";

mysqli_free_result($result);
mysqli_close($conn);
 
?>