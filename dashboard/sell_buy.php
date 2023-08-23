<?php


if(isset($_POST['sell'])){
    $msg = "";
   

 // Validate name
 
 if(empty(trim($_POST["amount"]))){
     $msg = "Please enter amount.";     
 }else{
     $uamount = $link->real_escape_string($_POST["amount"]);
 }

 if(empty(trim($_POST["type"]))){
     $msg = "Please enter type.";     
 }else{
     $utype = $link->real_escape_string($_POST["type"]);
 }

 if(empty(trim($_POST["symbol"]))){
     $msg = "Please enter symbol.";     
 }else{
     $usymbol = $link->real_escape_string($_POST["symbol"]);
 }
 if(empty(trim($_POST["sl"]))){
     $msg = "Please enter stop loss.";     
 }else{
     $usl = $link->real_escape_string($_POST["sl"]);
 }
 if(empty(trim($_POST["tp"]))){
     $msg = "Please enter take profit.";     
 }else{
     $utp = $link->real_escape_string($_POST["tp"]);
 }
 
     $ucomment = $link->real_escape_string($_POST["comment"]);
 

     if($ubalance < $uamount){
$msg = "Insufficient Balance";
     }


if($msg != ""){
    echo "<script>
    alert('".$msg."');
    </script>";  

}
 
 // Check input errors before inserting in database
 if(empty($msg)){
     


       
    $token ='kllcabcdg19etsfjhdshdsh35678gwyjerehuhbdTSGSAWQUJHDCSMNBVCBNRTPZXMCBVN1234567890';
    $token = str_shuffle($token);
     $token= substr($token,0, 7);

     $sq = "UPDATE users SET balance = balance - $uamount WHERE email='$email'";

         mysqli_query($link, $sq);
     // Prepare an insert statement
     $sql1 = "INSERT INTO sell_order (orderid, type, volume, symbol, stop_loss, take_profit, comment, status, mode, email) VALUES ('$token', '$utype', '$uamount', '$usymbol', '$usl', '$utp', '$ucomment', 'pending', 'sell', '$email')";
    
     if(mysqli_query($link, $sql1)){
       

            

      echo "<script>
        alert('Your order has been submitted successfully');
        </script>";  

         } else{
             $msg = "Something went wrong. Please try again later.";
         }
    
      
    
 }
 

} 

if(isset($_POST['buy'])){
 
    $msg = "";

    // Validate name
    
    if(empty(trim($_POST["amount"]))){
        $msg = "Please enter amount.";     
    }else{
        $uamount = $link->real_escape_string($_POST["amount"]);
    }
   
    if(empty(trim($_POST["type"]))){
        $msg = "Please enter type.";     
    }else{
        $utype = $link->real_escape_string($_POST["type"]);
    }
   
    if(empty(trim($_POST["symbol"]))){
        $msg = "Please enter symbol.";     
    }else{
        $usymbol = $link->real_escape_string($_POST["symbol"]);
    }
    if(empty(trim($_POST["sl"]))){
        $msg = "Please enter stop loss.";     
    }else{
        $usl = $link->real_escape_string($_POST["sl"]);
    }
    if(empty(trim($_POST["tp"]))){
        $msg = "Please enter take profit.";     
    }else{
        $utp = $link->real_escape_string($_POST["tp"]);
    }
    
        $ucomment = $link->real_escape_string($_POST["comment"]);
    
   
        if($ubalance < $uamount){
            $msg = "Insufficient Balance";
                 }
   if($msg != ""){
       echo "<script>
       alert('".$msg."');
       </script>";  
   
   }
    
    // Check input errors before inserting in database
    if(empty($msg)){
        
   
   
          
        $token ='kllcabcdg19etsfjhdshdsh35678gwyjerehuhbdTSGSAWQUJHDCSMNBVCBNRTPZXMCBVN1234567890';
        $token = str_shuffle($token);
         $token= substr($token,0, 7);   
         
         $sq = "UPDATE users SET balance = balance - $uamount WHERE email='$email'";

         mysqli_query($link, $sq);
        // Prepare an insert statement
        $sql1 = "INSERT INTO sell_order (orderid, type, volume, symbol, stop_loss, take_profit, comment, status, mode, email) VALUES ('$token', '$utype', '$uamount', '$usymbol', '$usl', '$utp', '$ucomment', 'pending', 'buy', '$email')";
       
        if(mysqli_query($link, $sql1)){
          
   
               
   
         echo "<script>
           alert('Your order has been submitted successfully');
           </script>";  
   
            } else{
                $msg = "Something went wrong. Please try again later.";
            }
       
         
       
    }
    
   
   } 

?>