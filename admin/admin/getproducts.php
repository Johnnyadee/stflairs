<?php
//connect to database server and select the particular database
include("../../config.php");

$prodid = mysqli_real_escape_string($conn, $_GET['current_product']);
 
$result1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM products where id='$prodid'"));
$result = mysqli_query($conn, "SELECT * FROM products");
 
echo "<option value=".$result1['id'].">".$result1['name']."</option>";
while($row = mysqli_fetch_array($result))
  {
        echo '<option value="'.$row['id'].'">' . $row['name'] . "</option>";
  }
 
mysqli_free_result($result);
mysqli_close($conn);
 
?>