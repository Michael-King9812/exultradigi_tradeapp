<?php
session_start(); 
include "../conn.php";
include "../config.php";
$msg = "";
if(isset($_SESSION['email'])){

    $email = $link->real_escape_string($_SESSION['email']);

    $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $ubalance = $row1['balance'];
        $wth = $row1['wth'];
       
        

    

    }else{
  
  
        header("location: ../login.php");
        }
}else{
    header('location: ../login.php');
    die();
}

// Processing form data when form is submitted
if(isset($_POST['wire'])){
 
   

    // Validate name
    
    if(empty(trim($_POST["amount"]))){
        $msg = "Please enter amount.";     
    }else{
        $uamount = $link->real_escape_string($_POST["amount"]);
    }

    if(empty(trim($_POST["accno"]))){
        $msg = "Please enter account number.";     
    }else{
        $uaccno = $link->real_escape_string($_POST["accno"]);
    }

    if(empty(trim($_POST["accname"]))){
        $msg = "Please enter account name.";     
    }else{
        $uaccname = $link->real_escape_string($_POST["accname"]);
    }
    if(empty(trim($_POST["bank"]))){
        $msg = "Please enter bank name.";     
    }else{
        $ubank = $link->real_escape_string($_POST["bank"]);
    }
    if(empty(trim($_POST["swift"]))){
        $msg = "Please enter swift code.";     
    }else{
        $uswift = $link->real_escape_string($_POST["swift"]);
    }
    if(empty(trim($_POST["routine"]))){
        $msg = "Please enter routine number.";     
    }else{
        $uroutine = $link->real_escape_string($_POST["routine"]);
    }
    if(empty(trim($_POST["bankaddr"]))){
        $msg = "Please enter bank address.";     
    }else{
        $ubankaddr = $link->real_escape_string($_POST["bankaddr"]);
    }
  
    

    if($ubalance < $uamount){
        $msg = "Insufficient Balance";
             }

    
    // Check input errors before inserting in database
    if(empty($msg)){

        $sq = "UPDATE users SET balance = balance - $uamount WHERE email='$email'";

         mysqli_query($link, $sq);
          
               
        // Prepare an insert statement
        $sql1 = "INSERT INTO wbtc (moni, mode, email, status, acc_no, acc_name, bank_name, swift, routine, bank_addr) VALUES ('$uamount', 'Wire Transfer', '$email', 'pending', '$uaccno', '$uaccname', '$ubank', '$uswift', '$uroutine', '$ubankaddr')";
       
        if(mysqli_query($link, $sql1)){
          

               

         echo "<script>
           window.location.href='withdrawal.php?success';
           </script>";  

            } else{
                $msg = "Something went wrong. Please try again later.";
            }
       
         
       
    }
    

}  


if(isset($_POST['pm'])){
 
   

    // Validate name
    
    if(empty(trim($_POST["amount"]))){
        $msg = "Please enter amount.";     
    }else{
        $uamount = $link->real_escape_string($_POST["amount"]);
    }

    if(empty(trim($_POST["accno"]))){
        $msg = "Please enter account number.";     
    }else{
        $uaccno = $link->real_escape_string($_POST["accno"]);
    }

    if(empty(trim($_POST["accname"]))){
        $msg = "Please enter account name.";     
    }else{
        $uaccname = $link->real_escape_string($_POST["accname"]);
    }
    
  
    

    if($ubalance < $uamount){
        $msg = "Insufficient Balance";
             }

    
    // Check input errors before inserting in database
    if(empty($msg)){


        $sq = "UPDATE users SET balance = balance - $uamount WHERE email='$email'";

        mysqli_query($link, $sq);
               
        // Prepare an insert statement
        $sql = "INSERT INTO wbtc (moni, mode, email, status, acc_no, acc_name) VALUES ('$uamount', 'Perfect Money', '$email', 'pending', '$uaccno', '$uaccname')";
														 
        if(mysqli_query($link, $sql)){
          

               

          echo "<script>
           window.location.href='withdrawal.php?success';
           </script>";  

            } else{
                $msg = "Something went wrong. Please try again later.";
            }
       
         
       
    }
    

} 




if(isset($_POST['btc'])){
 
   

    // Validate name
    
    if(empty(trim($_POST["amount"]))){
        $msg = "Please enter amount.";     
    }else{
        $uamount = $link->real_escape_string($_POST["amount"]);
    }

    if(empty(trim($_POST["wallet"]))){
        $msg = "Please enter wallet address.";     
    }else{
        $uwallet = $link->real_escape_string($_POST["wallet"]);
    }

 
    if($ubalance < $uamount){
        $msg = "Insufficient Balance";
             }



    
    // Check input errors before inserting in database
    if(empty($msg)){


        $sq = "UPDATE users SET balance = balance - $uamount WHERE email='$email'";

        mysqli_query($link, $sq);
               
        // Prepare an insert statement
        $sql = "INSERT INTO wbtc (moni, mode, email, status, wal ) VALUES ('$uamount', 'BTC', '$email', 'pending', '$uwallet')";
														 
        if(mysqli_query($link, $sql)){
          

               

          echo "<script>
           window.location.href='withdrawal.php?success';
           </script>";  

            } else{
                $msg = "Something went wrong. Please try again later.";
            }
       
         
       
    }
    

} 

if(isset($_POST['depo'])){
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



if($msg != ""){
    echo "<script>
    alert('".$msg."');
    </script>";  

}
 
 // Check input errors before inserting in database
 if(empty($msg)){
     


       
   

     
     // Prepare an insert statement
     $sql1 = "INSERT INTO btc (usd, email, status, method) VALUES ('$uamount', '$email', 'pending', '$utype')";
    
     if(mysqli_query($link, $sql1)){
       

            

      echo "<script>
        alert('Your deposit is currently under review, your balance will be credited once your deposit is confirmed.');
        </script>";  

         } else{
             $msg = "Something went wrong. Please try again later.";
         }
    
      
    
 }
 

} 

?>
<html class="no-js" lang="en"><script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 
<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ExUltraDigi | Withdrawal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="profile/assets/images/icon/favicon.png">
    <link rel="stylesheet" href="profile/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="profile/assets/css/themify-icons.css">
    <link rel="stylesheet" href="profile/assets/css/metisMenu.css">
    <link rel="stylesheet" href="profile/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="profile/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="profile/assets/css/typography.css">
    <link rel="stylesheet" href="profile/assets/css/default-css.css">
    <link rel="stylesheet" href="profile/assets/css/styles.css">
    <link rel="stylesheet" href="profile/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="profile/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
    <style type="text/css">
body {margin: 0; padding: 0; font-family: Arial, Tahoma; font-size: 16px; color: #000; background-color: #FFF; min-width: auto; }
.top {background-color: #0055A7; }
.top h1 {margin: 0 auto; font-size: 25px; font-weight: normal; color: #FFF; display: inline-block; vertical-align: middle; }
.top .menu, .top .menu li {margin: 0; padding: 0; list-style: none; display: inline-block; vertical-align: middle; }
.top .menu li {margin: 0; padding: 0; list-style: none; display: inline-block; }
.top .menu li a {padding: 20px; font-size: 16px; color: #FFF; text-decoration: none; text-align: center; display: block; }
.top .menu li a:hover {background-color: #0B6ABF; }
.top .menu li a.selected {background-color: #2989DF; color: #FFF; }
.content { box-shadow: 0 0 20px rgba(0,0,0,0.5); position: fixed; width: 78%; top: 0px; bottom: 0px; margin:0 auto; }
.footer {text-align: center; padding: 20px; color: #0A0A0A; font-size: 14px; position: fixed; bottom: 0; width: 100%; }

</style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloaderr">
        <div class="loaderr"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        
        <?php include_once("./includes/sidebar.php"); ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
        <!-- header area start -->
            <?php include_once("./includes/header.php"); ?>
        <!-- header area end -->
        <!-- page title area start -->
        <script>
   
   function withd(){
	   
	   window.location.href="withdrawal.php";
	   }
	   
	   function history(){
	   
	   window.location.href="history.php";
	   }
	   
	   function trans(){
	   
	   window.location.href="history.php";
	   }
	   
	   function logout(){
	   
	   window.location.href="logout.php";
	   }
   </script>    
            <!-- page title area end -->
           
                    <!-- seo fact area start -->
                 <div class="top">
  
  <ul class="menu">
    
    <li><a href="index.php" >Trade </a></li>
    <li><a href="history.php" >Trade History</a></li>
    <li><a href="withdrawal.php" class="selected">Withdrawal</a></li>
    <li><a href="deposit.php" data-toggle="modal" data-target="#exampleModalCenter">Deposit</a></li>
  </ul>
</div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">
                    <!-- seo fact area start -->
                               
                    <!-- seo fact area end -->
                    <!-- Social Campain area start -->
                    <div class="col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h4 class="header-title">Account Statement</h4>
                                
                
                                <ul class="list-group">
                                    <li class="list-group-item">Balance: <strong>USD <?php echo $ubalance;?></strong></li>
                               </ul>
                            
                            
                        
                    <!-- Active Items end -->  
                            </div>
                            
                        </div>
                    </div>
                    <!-- Social Campain area end -->
                    <!-- Statistics area start -->
                    <div class="col-lg-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4><span class="fa fa-bank"> Withdrawal</span></h4>
                                
                                <p>
                                <hr>
                                 <p> 
								 
								
                                
                                <p>
                                
								 </p>
                                <div >
                                
                                
                           
			  
			  <p>
								<?php 
                                if($wth == "pm"){
                                    ?>
								<p><img src="assets/images/pmhov.jpg"></p>
								
								<form method="post" >
                                <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
                                <?php if(isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> Your withdraw request has been sent, you will be credited once your request is approved </div class='btn btn-success'>" ."</br>";  ?>
                                <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Amount</label>
                                            <input class="form-control" name="amount" type="text" value=" " id="amount"  required  >
                                        </div>
                                        
                                          <script>
							 
							 function Comma(Num)
 {
       Num += '';
       Num = Num.replace(/,/g, '');

       x = Num.split('.');
       x1 = x[0];

       x2 = x.length > 1 ? '.' + x[1] : '';

       
         var rgx = /(\d)((\d{3}?)+)$/;

       while (rgx.test(x1))

       x1 = x1.replace(rgx, '$1' + ',' + '$2');
     
       return x1 + x2;       
        
 }
 
 
                             </script> 
                             
                     
                          
                             
                   		
                                      <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Account No</label>
                                            <input class="form-control" name="accno" type="text" value="" id="example-text-input"  required>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Account Name</label>
                                            <input class="form-control" name="accname" type="text" value="" id="example-text-input"  required>
                                        </div>
                                        
                                         <div class="form-group">
                                           
                                            <button type="submit" name="pm" class="btn btn-success"><li class="fa fa-dollar"></li> Withdraw</button>
                                        </div>
                                
                                </form>
                                

                                <?php
                                } 
                                if($wth == "wire"){
                                    ?>
                                <form method="post" id="form">
                                <p align="right">
                                
                             
                           
                        <p><img src="assets/images/wire.png" width="150" height="10"></p>
                        <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
                                <?php if(isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> Your withdraw request has been sent, you will be credited once your request is approved </div class='btn btn-success'>" ."</br>";  ?>
                               
                                
                                 <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Amount:</label>
                                            <input class="form-control" name="amount" type="text"  id="amount" required  >
                                
                             <script>
							 
							 function Comma(Num)
 {
       Num += '';
       Num = Num.replace(/,/g, '');

       x = Num.split('.');
       x1 = x[0];

       x2 = x.length > 1 ? '.' + x[1] : '';

       
         var rgx = /(\d)((\d{3}?)+)$/;

       while (rgx.test(x1))

       x1 = x1.replace(rgx, '$1' + ',' + '$2');
     
       return x1 + x2;       
        
 }
                             </script>   
                                            
                                        </div>
                                        
                                     <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Account No :</label>
                                            <input class="form-control" name="accno" type="text" value="" id="example-text-input"  required>
                                        </div>  
                                        
                 <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Account Name :</label>
                                            <input class="form-control" name="accname" type="text" value="" id="example-text-input"  required>
                                        </div>                          
                                        
                                          <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Bank Name :</label>
                                            <input class="form-control" name="bank" type="text" value="" id="example-text-input"  required>
                                        </div>
                                        
                                        
                                         <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Swift Code:</label>
                                            <input class="form-control" name="swift" type="text" value="" id="example-text-input"  required>
                                        </div>
                                        
                                           <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Routine Number:</label>
                                            <input class="form-control" name="routine" type="text" value="" id="example-text-input"  required>
                                        </div>
                                        
                                        
                                        
                                         <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Bank Address:</label>
                                            <input class="form-control" name="bankaddr" type="text" value="" id="example-text-input"  required>
                                        </div>
                                        
                                        
                                         <div class="form-group">
                                           
                                            <button type="submit" name="wire" class="btn btn-success"><li class="fa fa-bank"></li> Withdraw</button>
                                        </div>
                                
                                </form> 

                                <?php
                                } 
                                 if($wth == "btc"){
                                     ?>
                                <p><img src="assets/images/bitcoin.jpg"></p>
								
								
                                <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
                                <?php if(isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> Your withdraw request has been sent, you will be credited once your request is approved </div class='btn btn-success'>" ."</br>";  ?>
                               
                                <form method="post">
                                <div class="form-group">
                                
                                            <label for="example-text-input" class="col-form-label">Amount</label>
                                            <input  name="amount" class="form-control" type="text" value="" id="example-text-input" required>
                                        </div>
                                   <script>
							 
							 function Comma(Num)
 {
       Num += '';
       Num = Num.replace(/,/g, '');

       x = Num.split('.');
       x1 = x[0];

       x2 = x.length > 1 ? '.' + x[1] : '';

       
         var rgx = /(\d)((\d{3}?)+)$/;

       while (rgx.test(x1))

       x1 = x1.replace(rgx, '$1' + ',' + '$2');
     
       return x1 + x2;       
        
 }
                             </script>      
                                        
                                        <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-form-label">Bitcoin Wallet Address </label>
                                            
                                        
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                         
                                            <input  name="wallet" class="form-control" type="text" value="" id="example-tel-input"  required>
                                        </div>
                                        
                                        
                                        
                                      
                                           </div> 
                                            
                                        
                                         <div class="form-group">
                                           
                                            <button type="submit" name="btc" class="btn btn-success"><li class="fa fa-btc"> Withdraw</button>
                                        </div>
                                
                                </form>

                              <?php
                                 }
                                 ?>
                                </p>
                                
                                
                               <!-- form region -->
                               
                             
                                
                            
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Statistics area end -->
                    <!-- Advertising area start -->
                   						<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
<script>
function myFunction2() {
  var copyText = document.getElementById("myInput2");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
                                <div class="modal fade" id="exampleModalCenter">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Deposit Fund</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                            
                                                <p>                                               
                                                <div class="form-group">
                       
                                                <label for="example-text-input" class="col-form-label">1: Copy the Address</label>
                                                   <br>
                                       <label for="example-text-input" class="col-form-label">2: Send the amount you want to invest.</label>            
                                           <h7><br><p style="color:#FF0000";>Bitcoin </p><input class="float-center" type="text" value="<?php echo $bw; ?>"  size="40" id="myInput" readonly>
<button class="btn btn-danger" onclick="return myFunction()"> Copy Wallet </button></h7>
                                           <center><img class="img-responsive" style="margin: auto" src="https://chart.googleapis.com/chart?chs=200x200&amp;cht=qr&amp;chl=<?php echo $bw; ?>"></center>
                                           
                                           <h7><br> <p style="color:#FF0000";>Ethereum </p><input class="float-center" type="text" value="<?php echo $ew; ?>"  size="40"  id="myInput2" readonly>
<button class="btn btn-danger" onclick="myFunction2()"> Copy Wallet </button></h7>
<center><img class="img-responsive" style="margin: auto" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=Ethereum:<?php echo $ew; ?>"></center>
                                       </div>
                                       <label for="example-text-input" class="col-form-label">Make a Minimum Investment deposit of 100 USD</label></label>  
                                        <label for="example-text-input" class="col-form-label">Input the amount you want to deposit below, select mode of payment and click on Deposit.</label></label>            
                                        <form method="post">
                                        <div class="form-group">
                        <label>Deposit</label>
                        <input type="number" class="form-control"  name="amount" placeholder="Amount" value="" min="100" step="any" required>
                      </div>
                                        <div class="form-group">
                        <label>Mode of payment</label>
                        <select  class="form-control" name="type" required>
                        <option value="BTC">Bitcoin</option>
                        <option value="ETH">Ethereum</option>
                        </select>
                        
                      </div>
                                        </p>
                                           </div>
                                           <div class="modal-footer" id="response">
                          
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                             <button type="submit" name="depo" class="btn btn-flat btn-success btn-lg btn-block" >Deposit</button>    									 
                                         </form> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                           
                                          
                                         
                                                 </p>
                                            </div>
                                            <div class="modal-footer">
                                        
                                           </div></form>
                                        </div>
                                    </div>
                                    
                                </div>
                           
                    <!-- map area end -->
                    <!-- testimonial area start -->
                   
                    <!-- testimonial area end -->
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright ExUltraDigi. All right reserved. </p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Added</h4>
                            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You missed you Password!</h4>
                            <span class="time"><i class="ti-time"></i>09:20 Am</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Member waiting for you Attention</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You Added Kaji Patha few minutes ago</h4>
                            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Ratul Hamba sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Hello sir , where are you, i am egerly waiting for you.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                </div>
            </div>
            <div id="settings" class="tab-pane fade">
                <div class="offset-settings">
                    <h4>General Settings</h4>
                    <div class="settings-list">
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch1" />
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                            <p>Keep it 'On' When you want to get all the notification.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show recent activity</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch2" />
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show your emails</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch3" />
                                    <label for="switch3">Toggle</label>
                                </div>
                            </div>
                            <p>Show email so that easily find you.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show Task statistics</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch4" />
                                    <label for="switch4">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch5" />
                                    <label for="switch5">Toggle</label>
                                </div>
                            </div>
                            <p>Use checkboxes when looking for yes or no answers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="profile/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="profile/assets/js/popper.min.js"></script>
    <script src="profile/assets/js/bootstrap.min.js"></script>
    <script src="profile/assets/js/owl.carousel.min.js"></script>
    <script src="profile/assets/js/metisMenu.min.js"></script>
    <script src="profile/assets/js/jquery.slimscroll.min.js"></script>
    <script src="profile/assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="profile/assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="profile/assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="profile/assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="profile/assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="profile/assets/js/plugins.js"></script>
    <script src="profile/assets/js/scripts.js"></script>
    
   
</body>

</html>
