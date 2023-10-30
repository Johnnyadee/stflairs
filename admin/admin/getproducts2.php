<?php
//connect to database server and select the particular database
include("../../config.php");

$result = mysqli_query($conn, "SELECT * FROM products");
 
echo "<option value=''>..Select Product Here</option>";
while($row = mysqli_fetch_array($result))
  {
        echo '<option value="'.$row['id'].'">' . $row['name'] . "</option>";
  }
 
mysqli_free_result($result);
mysqli_close($conn);


?>