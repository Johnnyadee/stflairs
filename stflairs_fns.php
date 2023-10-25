<?php
    function getOrgProfile($conn){
        $query = mysqli_query($conn,"select * from org_profile");
        $result = mysqli_fetch_array($query);
        return $result;
    }
    
    function getProductName($prod_id,$conn){
        $query = mysqli_query($conn,"select * from products where id='$prod_id'");
        $result = mysqli_fetch_array($query);
        return $result['name'];
    }
    
    function getProduction($conn){
        $query = mysqli_query($conn,"select * from production");
        return $query;
    }
    
    function getStatistics($entity,$conn){
        $sql = "SELECT * FROM $entity";
		$result = mysqli_query($conn,$sql);
		$num_of_rows = mysqli_num_rows($result);
		return $num_of_rows;  
    }

    // a function that retrieves all the fund donors
    function getAllSales($conn){
        $sql = "SELECT * FROM sales order by id desc limit 3";
        $result = mysqli_query($conn,$sql);
        return $result;
    }
    
    // a function that gets all donations

    function getAllExpenses($conn){
        $sql = "SELECT * FROM expenses order by id desc limit 3";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function getTotalNoOfEntity($entity,$conn){
        $sql = "SELECT * FROM $entity";
		$result = mysqli_query($conn,$sql);

        $total_amount =0.0;
		
        while($row =mysqli_fetch_array($result)){
            $total_amount= $total_amount + $row['total_amount'];
        }

        return $total_amount;
    }

    function getExpenseTitle($catid,$conn){
        $query = mysqli_query($conn,"select * from expenses_cat where id='$catid'");
        $result = mysqli_fetch_array($query);
        return $result['title'];
    }

    // This is function that retrieves all raw materials in an ordered fashion
    function getRawMaterials($conn){
        $result = mysqli_query($conn, "Select * from rawmaterial order by id asc");
        return $result;
    }

    // a function that retrieves all the customers
    function getAllCustomers($conn){
        $sql = "SELECT * FROM customer";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    function getAllDebtors($conn){
        $result = mysqli_query($conn,"select distinct customer_id from sales where balance>0");
        return $result;
    }

    function getCustomerName($conn,$customer_id){
        $result = mysqli_fetch_array(mysqli_query($conn,"select * from customer where id='$customer_id'"));
        return $result['firstname']." ".$result['lastname'];
    }

    function getCustomerImage($conn, $customer_id){
        $result = mysqli_fetch_array(mysqli_query($conn,"select * from customer where id='$customer_id'"));
        return $result['image_url'];
    }
    function getCustomerPhone($conn, $customer_id){
        $result = mysqli_fetch_array(mysqli_query($conn,"select * from customer where id='$customer_id'"));
        return $result['phone'];
    }


    //This function here gets a customers total Debt from the sales table using the customers ID
    function getCustomerTotalDebt($conn, $customer_id){
        $result = mysqli_query($conn, "select * from sales where customer_id='$customer_id'");
        $total_debt = 0.0;
        while($row = mysqli_fetch_array($result)){
            $total_debt =$total_debt + $row['balance'];
        }
        return $total_debt;
    }

    function getAllUpfrontPayments($conn){
        $result = mysqli_query($conn, "select * from upfrontpayments");
        return $result;
    }

    // This function returns the POP image uploaded for an upfront payment
    function getCustomerPOP($conn, $payment_id){
        $result = mysqli_fetch_array(mysqli_query($conn,"select * from upfrontpayments where id='$payment_id'"));
        return $result['pop_image_url'];
    }


    function getAllInvoices($conn){
        $result = mysqli_query($conn, "select * from invoices");
        return $result;
    }

    function isNameExisting($firstname, $conn){
        $query = mysqli_query($conn,"select * from customer where username='$firstname'");
        if(!$query){
            return mysqli_error($conn);
        }
        else{
            //check whether the result returned contains the searched parameter
            if(mysqli_num_rows($query)>0){
                return true;
            }
            else{
                return false;
            }
        }
    }



    function sendConfirmationMail($email,$fullname,$username1,$password,$wallet_address){
        
        $from = 'info@faircoinachievers.com'; 
        $fromName = 'FAIR COIN ACHIEVERS'; 
        $subject = "WELCOME TO FAIR COIN ACHIEVERS PLATFORM"; 
 
        $htmlContent = ' 
            <html> 
            <head> 
                <title> '.$subject.' </title> 
            </head> 
            <body> 
                
                <center><img src='.'"https://faircoinachievers.com/assets/img/logo.png"'.'width=200 height=80 /></center>
                
                <p>Hey, '.$fullname.', welcome to the best Crypto Investment company FAIR COIN ACHIERVERS LTD.</p> 
                <p>I am pleased to introduce you to our Company. FAIR COIN ACHIEVERS is one of the best Crypto investment company. Below are our activities </p>
                
                <ul> 
                    <li> Buying of Crypto Currencies </li>
                    <li> Sales of BTC and other Crypto currencies </li>
                    <li> We also act as brokers for our clients </li>
                    <li> We grow your investment </li>
                </ul>
                
                <p style="font-weight:bold"> Be informed also that we got your registration information as shown below: </p> 
                <p> Your details as captured in our System: </p>
                
                <table cellspacing="0" style="border: 2px solid #00008B; width: 100%;"> 
                    <tr> 
                        <th>Full Name:</th><td>'.$fullname.'</td> 
                    </tr> 
                    <tr style="background-color: #e0e0e0;"> 
                        <th>Email:</th><td>'.$email.'</td> 
                    </tr> 
                    <tr> 
                        <th>Username :</th> <td>'.$username1.'</td> 
                    </tr> 
        
                    <tr style="background-color: #e0e0e0;"> 
                        <th>Password :</th> <td>'.$password.'</td> 
                    </tr> 
                     <tr style="background-color: #e0e0e0;"> 
                        <th>Wallet Address :</th> <td>'.$wallet_address.'</td> 
                    </tr> 
                </table> 
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
        
    }
    
    function sendWithdrawalMail($username, $amount,$conn){
        
        // A query to retrieve the fullname of the person in question
        $client_details =  mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM customer where username='$username'"));
        
        $from = 'info@faircoinachievers.com'; 
        $fromName = 'FAIR COIN ACHIEVERS'; 
        $subject = "WITHDRAWAL REQUEST CONFIRMATION";
        $fullname=  $client_details['full_name'];
        $wallet_address= $client_details['bit_account'];
        $email          = $client_details['email'];
 
        $htmlContent = ' 
            <html> 
            <head> 
                <title> '.$subject.' </title> 
            </head> 
            <body> 
                
                <center><img src='.'"https://faircoinachievers.com/assets/img/logo.png"'.'width=200 height=80 /></center>
                
                <p>Dear, '.$fullname.', </p> 
                <p>Your withdrawal request has been approved.</p>
                
                <p> 
                    '.$amount.' has been sent into your bitcoin acount.
                </p>
                
                <p> 
                    Amount Sent: '.$amount.' <br /> 
                    Payment Type: <b>BITCOIN </b> <br />
                    Payment Status: <b>Approved </b> <br /> 
                    Wallet address: '.$wallet_address.' <br /> 
                </p>
                
                <p> Transaction Batch: <b> '.rand(000000,999999).' </b> </p>
                
                <p style="font-weight:bold"> Referral Commision  </p>
                
                <p> Promote us everywhere and 10 levels commission for your effort 5% - 3% - 1% - 0.5% - 0.5% - 0.5% - 0.5%</p>
                
                <p> 
                    Thanks<br />
                    Fair Coin Achievers Limited
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
        
    }
    
    function getDomain($url){
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
            return strtolower($regs['domain']);
        }
        return FALSE;
    }

    function numberTowords($num)
    {

        $ones = array(
            0 =>"ZERO",
            1 => "One",
            2 => "Two",
            3 => "Three",
            4 => "Four",
            5 => "Five",
            6 => "Six",
            7 => "Seven",
            8 => "Eight",
            9 => "Nine",
            10 => "TEN",
            11 => "ELEVEN",
            12 => "TWELVE",
            13 => "THIRTEEN",
            14 => "FOURTEEN",
            15 => "FIFTEEN",
            16 => "SIXTEEN",
            17 => "SEVENTEEN",
            18 => "EIGHTEEN",
            19 => "NINETEEN",
            "014" => "FOURTEEN"
        );
    
        $tens = array( 
        0 => "Zero",
        1 => "Ten",
        2 => "Twenty",
        3 => "Thirthy", 
        4 => "Forty", 
        5 => "Fifty", 
        6 => "SIXTY", 
        7 => "Seventy", 
        8 => "Eighty", 
        9 => "Ninety" 
        );
    
        $hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
        );
    
    /*limit t0 quadrillion */
    
        //1. The code formats the number to have 1,234,567.98
        $num = number_format($num,2,".",","); 
    
        //2. The code below uses . to divides the number into 2 parts 1. Whole number and decimal number parts
        $num_arr = explode(".",$num); 
    
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
    
        $whole_arr = array_reverse(explode(",",$wholenum));
    
        krsort($whole_arr,1); 

        $rettxt = "";

        foreach($whole_arr as $key => $i){ 
            while(substr($i,0,1)=="0")
                $i=substr($i,1,5);
    
                if($i<20){ 
                    @ $rettxt .= $ones[$i]; 
                }elseif($i < 100){ 
                    if(substr($i,0,1)!="0") $rettxt .= $tens[substr($i,0,1)]; 
                    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
                }else{ 
                    if(substr($i,0,1)!="0") {
                        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                    }
                    //This section determines the middle part of the first 3 digits
                    if(substr($i,1,1)!="0"){
                        $rettxt .= " and ".$tens[substr($i,1,1)]; 
                    }
                    else{
                        $rettxt .= " and ";
                    }
                    if(substr($i,2,1)!="0"){
                        
                        $rettxt .= " ".$ones[substr($i,2,1)]; 
                    }
                } 
                if($key > 0){ 
                    $rettxt .= " ".$hundreds[$key].",";
                    
                }      
        }
    
        if($decnum > 0){
            $rettxt .= " and ";
        if($decnum < 20){
            $rettxt .= $ones[$decnum];
        }elseif($decnum < 100){
            $rettxt .= $tens[substr($decnum,0,1)];
            $rettxt .= " ".$ones[substr($decnum,1,1)];
        }
    }

    
    if(substr($rettxt,strlen($rettxt)-1,1)==","){
        $rettxt = substr($rettxt,0,(strlen($rettxt)-1));  
    } 
    return $rettxt;
    }
    
 ?>
    