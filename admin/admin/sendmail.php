 <?php
 
    $from = 'info@faircoinachievers.com'; 
    $fromName = 'FAIR COIN ACHIEVERS'; 
    $subject = $_POST['subject'];
    $message=  $_POST['message'];
    $email  =  $_POST['email'];
    
 
    $htmlContent = ' 
        <html> 
        <head> 
            <title> '.$subject.' </title> 
            <style>
                body{
                    background-color:#011b33;
                    color:white;
                }
            </style>
        </head> 
        <body> 
            
            <center><img src='.'"https://faircoinachievers.com/assets/img/logo.png"'.'width=200 height=80 /></center>
            
            <p>
                '.$message.'
            </p>
            
            
        </body> 
        </html>'; 

    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
     
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    $headers .= 'Cc: info@faircoinachievers.com' . "\r\n"; 
 
    // Send email 
    if(mail($email, $subject, $htmlContent, $headers)){ 
        echo json_encode(array("statusCode"=>200));
    }else{ 
        echo json_encode(array("statusCode"=>201));
    }
        
?>