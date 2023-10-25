<?php
//connect to database server and select the particular database
include("../../config.php");

$catid = mysqli_real_escape_string($conn, $_GET['current_cat']);
 
$result1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM expenses_cat where id='$catid'"));
$result = mysqli_query($conn, "SELECT * FROM expenses_cat");
 
echo "<option value=".$result1['id'].">".$result1['title']."</option>";
while($row = mysqli_fetch_array($result))
  {
        echo '<option value="'.$row['id'].'">' . $row['title'] . "</option>";
  }
 
mysqli_free_result($result);
mysqli_close($conn);
 
?>