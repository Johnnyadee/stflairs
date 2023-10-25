<?php
include("../../config.php");

// Retrieve the current payment method
$current_pm = mysqli_real_escape_string($conn, $_GET['current_pm']);


$result = mysqli_query($conn, "SELECT DISTINCT payment_method FROM sales");

echo "<option value=".$current_pm.">".$current_pm."</option>";
while($row = mysqli_fetch_array($result))
  {
        echo '<option value="'.$row['payment_method'].'">' . $row['payment_method'] . "</option>";
  }
 
mysqli_free_result($result);
mysqli_close($conn);
?>
