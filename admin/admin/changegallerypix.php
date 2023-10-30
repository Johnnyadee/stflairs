<?php 
if(!empty($_FILES)){ 
    // Include the database configuration file 
    require '../../config.php';
    

    // File path configuration 
    $uploadDir = "../../images/gallery/"; 
    $fileName = rand(000000,9999).basename($_FILES['file']['name']); 
    $uploadFilePath = $uploadDir.$fileName; 
    
    $gallery_id = $_POST['gallery_id'];
    
    $sourceFile = $_FILES['file']['tmp_name'];
    list($width, $height, $type, $attr) = getimagesize($sourceFile);
    $filetype = image_type_to_extension($type, true);

    // Upload file to server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)){ 
        // update the file information in the database 
        $insert = mysqli_query($conn,"update gallery set image_url='$fileName' where id='$gallery_id'");
    } 
    
    header("location:managegallery.php");
} 
?>