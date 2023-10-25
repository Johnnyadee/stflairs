<?php
//connect to database server and select the particular database
include("../../config.php");
include("../../dreampathway_fns.php");

$customerid = mysqli_real_escape_string($conn, $_GET['customerid']);
 
$result = mysqli_query($conn, "SELECT * FROM sales where customer_id='$customerid'");

echo "<div class='table-responsive'>
        <table class='table table-hover table-bordered table-striped' id='refrralTable'>
        <thead>
            <tr class='xcrud-th'>
                <th>Item No</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>";

        $i =1;
        $total_sum =0.0;
        while($row = mysqli_fetch_array($result))
        { 
            $desc = $row['description'];
            $quantity = $row['quantity'];
            $total_amount =$row['total_amount'];
            $date = $row['date_time_created'];
            $rate =number_format(($total_amount/$quantity),2);
            $total_sum =$total_sum + $total_amount; 
        echo"
            <tr> 
                <td> $i </td>
                <td> $desc</td>
                <td> $quantity </td>
                <td> $rate </td>
                <td>" .number_format($total_amount,2)."</td>
                <input type=hidden id=".$row['id']." />
            </tr> "; 
            $i++;   
        }
        echo "<tr> <td colspan=4 style='text-align:right; font-weight:bold'> Total</td> <td>".number_format($total_sum,2)."</td> </tr></tbody>
    </table>
    </div>
    </div>
						
    <div class='form-group'>
        <label>Total Amount In Words</label>
        <input type='text' id='amount' name='amount' class='form-control' value='".numberTowords($total_sum)."'>
    </div>

    <div class='form-group'>
        <label>Supply Status:</label>
        <select id='supply_status' name='supply_status' class='form-control'> 
            <option value='Supplied'> Supplied</option>
            <option value='Supplied'> Supplied</option>
        </select>
    </div>
    ";    
mysqli_free_result($result);
mysqli_close($conn);
 
?>