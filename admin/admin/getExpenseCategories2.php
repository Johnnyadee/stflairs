<?php
//connect to database server and select the particular database
include("../../config.php");

$result = mysqli_query($conn, "SELECT * FROM expenses_cat");
 
echo "<option value=''>..Select Category Here</option>";
while($row = mysqli_fetch_array($result))
  {
        echo '<option value="'.$row['id'].'">' . $row['title'] . "</option>";
  }
 
mysqli_free_result($result);
mysqli_close($conn);


?>