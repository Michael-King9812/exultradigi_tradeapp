<?php
session_start(); 
include "../conn.php";
include "../config.php";

if(isset($_SESSION['email'])){

    $email = $link->real_escape_string($_SESSION['email']);

    $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $ubalance = $row1['balance'];
       
        

    

    }else{
  
  
        header("location: ../login.php");
        }
}else{
    header('location: ../login.php');
    die();
}



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
 
     $sq = "UPDATE users SET balance = balance - $uamount WHERE email='$email'";

     mysqli_query($link, $sq);

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
     $sql1 = "INSERT INTO sell_order (orderid, type, volume, symbol, stop_loss, take_profit, exp_time, status, mode, email) VALUES ('$token', '$utype', '$uamount', '$usymbol', '$usl', '$utp', '$ucomment', 'pending', 'sellsh', '$email')";
    
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
        $sql1 = "INSERT INTO sell_order (orderid, type, volume, symbol, stop_loss, take_profit, exp_time, status, mode, email) VALUES ('$token', '$utype', '$uamount', '$usymbol', '$usl', '$utp', '$ucomment', 'pending', 'buysh', '$email')";
       
        if(mysqli_query($link, $sql1)){
          
   
               
   
         echo "<script>
           alert('Your order has been submitted successfully');
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
<!doctype html>
<html class="no-js" lang="en"><script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ExUltraDigi | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
<link rel="stylesheet" href="asset/css/stockmenu.css">

<link rel="stylesheet" href="asset/css/switch.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                   
					
                <a href="index.php"><img src="assets/images/icon/logo.png" alt="logo"></a>    
                </div>
                  
                                
                
               
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                    
                        <ul class="metismenu" id="menu">
                           
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user-plus"></i><span>My Account
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="profile.php">Edit Profile</a></li>
                                    <li><a href="security.php">Security</a></li>
                                </ul>
                            </li>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-history"></i><span>Transactions</span></a>
                                <ul class="collapse">
                                    <li><a href="history.php">History</a></li>
                                    
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-area-chart"></i><span>MarketPlace</span></a>
                                <ul class="collapse">
                                    <li><a href="index.php">Forex</a></li>
                                    <li><a href="stock.php">Stock</a></li>
                                    <li><a href="crypto.php">Cryptocurrency</a></li>
                                    <li><a href="indices.php">Indices</a></li>
                                    <li><a href="cfd.php">Commodities</a></li>
                                    
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-money"></i><span>Deposit</span></a>
                                <ul class="collapse">
                                    <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter">New Request</a></li>
                                      <li><a href="deposit.php">History</a></li>
                                  
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-bank"></i><span>Withdrawal</span></a>
                                <ul class="collapse">
                                    <li><a href="withdrawal.php">New Request</a></li>
                                      <li><a href="whistory.php">History</a></li>
                                  
                                </ul>
                            </li>
                           
                           
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                                <ul class="collapse">
                                    <li><a href="logout.php">Logout</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        
               
        <!-- main content area start -->
        <div class="main-content">
            
            
            
                                <!-- Button trigger modal -->
                               
                              
            
            
            
            <!-- header area start -->
          
              
            <!-- header area end -->
            <!-- page title area start -->
          
            
                  <div class="top">
  
    
                                            
                                            
                                            
                                             
                                            
  
  <ul class="menu">
    
    <li><a href="index.php" >Forex</a></li>
    <li><a href="stock.php" class="selected">Stock</a></li>
    <li><a href="crypto.php">Cryptocurrency</a></li>
    <li><a href="indices.php">Indices</a></li>
    <li><a href="cfd.php">Commodities</a></li>
    
    
    <li><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">Sell</button></li>
   
   <li ><button class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Buy</button></li>
 
   
   <li> 
   
  
   
   <!-- Rounded switch -->
   
<label class="switch">
  <input  checked="checked"disabled="disabled" name="switch" type="checkbox" id="switch" onClick=" " >
  <span class="slider round"></span>
</label>


 
  
   </li>
   
   <li><button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Deposit</button></li>
   <li> <!-- profile info & task notification -->
                   
                        <ul class="notification-area pull-right">
                        
                         <div class="user-profile pull-right">
                            
                                  <h5>USD <?php echo $ubalance;?></h5>
                                
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                
                                <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                               <a class="dropdown-item" href="#" onClick="withd()">Withdrawal</a>
                                <a class="dropdown-item" href="#" onClick="history()">History</a>
                                <a class="dropdown-item" href="#" onClick="trans()">Transactions</a>
                                <a class="dropdown-item" href="#" onClick="logout()">Log Out</a>
                            </div>
                        </div>
                        
                            
                            
                            <li class="dropdown">
                               
                            </li>
                            <li class="dropdown">
                                
                            </li>
                           
                        </ul>
                    </li>
  </ul>
</div>
     <script>
   
   function withd(){
	   
	   window.location.href="withdrawal.php";
	   }
	   
	   function history(){
	   
	   window.location.href="whistory.php";
	   }
	   
	   function trans(){
	   
	   window.location.href="history.php";
	   }
	   
	   function logout(){
	   
	   window.location.href="logout.php";
	   }
   </script>      
            
<!-- TradingView Widget BEGIN -->

  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": "auto",
  "height": 610,
  "symbol": "NYSE:PFSI",
  "timezone": "Etc/UTC",
  "theme": "Dark",
  "style": "1",
  "locale": "en",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "withdateranges": true,
  "range": "all",
  "allow_symbol_change": true,
  "save_image": false,
  "details": true,
  "hotlist": true,
  "calendar": true,
  "news": [
    "stocktwits",
    "headlines"
  ],
  "studies": [
    "BB@tv-basicstudies",
    "MACD@tv-basicstudies",
    "MF@tv-basicstudies"
  ],
  "container_id": "tradingview_f263f"
}
  );
  </script>

<!-- TradingView Widget END -->




            
             
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
             </form></div>
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
                      
                    
            
                    
                                                    
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="text-uppercase bg-dark">
                                                <tr class="text-white">
                                                    <th scope="col">Order</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Type</th>
                                                    
                                                    <th scope="col">Symbol</th>
                                                    <th scope="col">Volume</th>
                                                    <th scope="col">S/L</th>
                                                    <th scope="col">T/P</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-uppercase bg-dark">
                                            <?php 
                                            $sql= "SELECT * FROM sell_order WHERE (email='$email' AND mode = 'sellsh') OR (email='$email' AND mode = 'buysh') ORDER BY id DESC ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){ 

                    ?>
                                                <tr class="text-white">
                                                                                                    <th scope="row"><?php echo $row['orderid'];?></th>
                                                    <td><?php echo $row['date'];?></td>
                                                    <td><?php echo $row['type'];?></td>
                                                    <td><?php echo $row['symbol'];?></td>
                                                    <td><?php echo $row['volume'];?></td>
                                                    <td><?php echo $row['stop_loss'];?></td>
                                                    <td><?php echo $row['take_profit'];?></td>
                                                    <td><?php echo $row['status'];?></td>
                                                   
                                                    
                                                </tr>
                                               <?php
                  } } 
                  ?> 
                                                
                                                
                                            </tbody>
                                        </table>   
                        
                           
                                 
                <!-- sales report area end -->
                <!-- overview area start -->
               
                    </div>
                   
                </div>
                <!-- overview area end -->
                <!-- market value area start -->
               
                <!-- market value area end -->
                <!-- row area start -->
              
                <!-- row area end -->
               
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        
           <!-- Large modal -->
                               
                                <div class="modal fade bd-example-modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                       
                                       
                                               <form method="post" action="">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Volume</label>
                        <input type="number" class="form-control"  name="amount" placeholder="Amount" value="" step="any" required>
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Type</label>
                        <select  class="form-control" name="type" >
                        <option value="Market Execution">Market Execution</option>
                        <option value="Pending Order">Pending Order</option>
                        </select>
                        
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Stock</label>
                        <select name="symbol" class="form-control" >
                        <option value="AAPL">Apple Inc</option>
                        <option value="ABBV">AbbVie Inc</option>
                        <option value="ABT">Abbott Laboratories</option>
                        <option value="ADBE">Adobe Inc</option>
                        <option value="ADP">Automatic Data Processing, Inc</option>
                        <option value="AMD">Advance Micro Devices, Inc</option>
                        <option value="AMGN">Amgen Inc</option>
                        <option value="AMT">American Tower Corporation (REIT)</option>
                        <option value="AMZN">Amazon.com Inc</option>
                        <option value="ATVI">Activision Blizzard, Inc</option>
                        <option value="AVGO">Broadcom Inc</option>
                        <option value="BABA">Alibaba Group Holding Limited</option>
                        <option value="BAC">Bank of America Corpooration</option>
                        <option value="BA">Boeing Company</option>
                        <option value="BIIB">Biogen Inc</option>
                        <option value="BMY">Bristol-Myers Squibb Company</option>
                        <option value="CHTR">Charter Communications, Inc</option>
                        <option value="CMCSA">Comcast Communication</option>
                        <option value="CME">CME Group Inc</option>
                        <option value="COST">Costco Wholesale Corporation</option>
                        <option value="CSCO">Cisco Systems, Inc</option>
                        <option value="CSX">CSX Corporation</option>
                        <option value="CVS">CVS Health Corporation</option>
                        <option value="CT">Citigroup Inc</option>
                        <option value="EA">Electronic Arts Inc</option>
                        <option value="EBAY">eBay Inc</option>
                        <option value="EQIX">Equinix, Inc</option>
                        <option value="FB">Facebook, Inc</option>
                        <option value="FM">Ford Motor Company</option>
                        <option value="GILD">Gilead Sciences, Inc</option>
                        <option value="GOOGLE">Alphabet Inc</option>
                        <option value="HD">Home Depot, Inc</option>
                        <option value="IBM">International Business Machines Corporation</option>
                        <option value="INTC">Intel Corporation</option>
                        <option value="INTU">Intuit Inc</option>
                        <option value="ISRG">Intuitive Surgical, Inc</option>
                        <option value="JNJ">Johnson & Johnson</option>
                        <option value="JPM">J P Morgan Chase & Co</option>
                        <option value="KO">Coca-Cola Company</option>
                        <option value="LIN">Linde plc</option>
                        <option value="LLY">Eli Lilly and Company</option>
                        <option value="LMT">Lockhead Martin Corporation</option>
                        <option value="MA">Mastercard Incorporated</option>
                        <option value="MCD">McDonalds Corporation</option>
                        <option value="MDLZ">Mondelez International, Inc</option>
                        <option value="META">Meta Platforms, Inc</option>
                        <option value="MMM">3M Company</option>
                        <option value="MO">Altria Group, Inc</option>
                        <option value="MRK">Merck & Company, Inc</option>
                        <option value="MSFT">Microsoft Corporation</option>
                        <option value="MS">Morgan Stanley</option>
                        <option value="NFLX">Netflix, Inc</option>
                        <option value="NKE">Nike, Inc</option>
                        <option value="NVDA">NVIDIA Corporation</option>
                        <option value="ORCL">Oracle Corporation</option>
                        <option value="PEP">PepsiCo, Inc</option>
                        <option value="PFE">Pfizer, Inc</option>
                        <option value="PG">Procter & Gamble Company</option>
                        <option value="PM">Philip Morris International inc</option>
                        <option value="PYPL">Paypal Holdings, inc</option>
                        <option value="REGN">Regeneron Pharmaceuticals, inc</option>
                        <option value="SBUX">Starbucks Corporation</option>
                        <option value="TMO">Thermo Fisher Scientific Inc</option>
                        <option value="TMUS">T-Mobile US, Inc</option>
                        <option value="TSLA">Tesla Inc</option>
                        <option value="T">AT&T Inc</option>
                        <option value="UNH">UnitedHealth Group Incorprorated</option>
                        <option value="UPS">United Parcel Service, Inc</option>
                        <option value="VRTX">Vertex Pharmaceuticals Incorporated</option>
                        <option value="VRZ">Verizon Communications Inc</option>
                        <option value="VS">Visa Inc</option>
                        <option value="WFC">Wells Fargo & Company</option>
                        <option value="WMT">Walmart Inc</option>
                        <option value="XOM">Exxon Mobil Corporation</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Stop Loss</label>
                        <input type="number" name="sl" class="form-control"  min="0" value="0.0000" step="any" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>Take Profit</label>
                        <input type="number" name="tp" class="form-control"  min="0" value="0.0000"  step="any" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Expire Date</label>
                        <select  class="form-control" name="comment" >
                        <option value="1 Day">1 Day</option>
                        <option value="5 Days">5 Days</option>
                        <option value="1 Month">1 Month</option>
                        <option value="3 Months">3 Months</option>
                        <option value="6 Months">6 Months</option>
                        <option value="1 Year">1 Year</option>
                        <option value="5 Years">5 Years</option>
                        
                        </select>  
                      </div>
                    </div>
                  </div>
                  
                    
                    
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label></label>
                        <input type="submit" name="buy" class="btn btn-block btn-success btn-lg" value="Buy Stocks">
                      </div>
                    </div>
                  </div>
                </form> 
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Large modal modal end -->
        <!-- footer area start-->
     
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    
    
    <!-- Button trigger modal -->
                               
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalLong">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                
                                                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Volume</label>
                        <input type="number" class="form-control"  name="amount" placeholder="Amount" value="" step="any" required>
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Type</label>
                        <select  class="form-control" name="type" >
                        <option value="Market Execution">Market Execution</option>
                        <option value="Pending Order">Pending Order</option>
                        </select>
                        
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Stock</label>
                        <select name="symbol" class="form-control" >
                        <option value="AAPL">Apple Inc</option>
                        <option value="ABBV">AbbVie Inc</option>
                        <option value="ABT">Abbott Laboratories</option>
                        <option value="ADBE">Adobe Inc</option>
                        <option value="ADP">Automatic Data Processing, Inc</option>
                        <option value="AMD">Advance Micro Devices, Inc</option>
                        <option value="AMGN">Amgen Inc</option>
                        <option value="AMT">American Tower Corporation (REIT)</option>
                        <option value="AMZN">Amazon.com Inc</option>
                        <option value="ATVI">Activision Blizzard, Inc</option>
                        <option value="AVGO">Broadcom Inc</option>
                        <option value="BABA">Alibaba Group Holding Limited</option>
                        <option value="BAC">Bank of America Corpooration</option>
                        <option value="BA">Boeing Company</option>
                        <option value="BIIB">Biogen Inc</option>
                        <option value="BMY">Bristol-Myers Squibb Company</option>
                        <option value="CHTR">Charter Communications, Inc</option>
                        <option value="CMCSA">Comcast Communication</option>
                        <option value="CME">CME Group Inc</option>
                        <option value="COST">Costco Wholesale Corporation</option>
                        <option value="CSCO">Cisco Systems, Inc</option>
                        <option value="CSX">CSX Corporation</option>
                        <option value="CVS">CVS Health Corporation</option>
                        <option value="CT">Citigroup Inc</option>
                        <option value="EA">Electronic Arts Inc</option>
                        <option value="EBAY">eBay Inc</option>
                        <option value="EQIX">Equinix, Inc</option>
                        <option value="FB">Facebook, Inc</option>
                        <option value="FM">Ford Motor Company</option>
                        <option value="GILD">Gilead Sciences, Inc</option>
                        <option value="GOOGLE">Alphabet Inc</option>
                        <option value="HD">Home Depot, Inc</option>
                        <option value="IBM">International Business Machines Corporation</option>
                        <option value="INTC">Intel Corporation</option>
                        <option value="INTU">Intuit Inc</option>
                        <option value="ISRG">Intuitive Surgical, Inc</option>
                        <option value="JNJ">Johnson & Johnson</option>
                        <option value="JPM">J P Morgan Chase & Co</option>
                        <option value="KO">Coca-Cola Company</option>
                        <option value="LIN">Linde plc</option>
                        <option value="LLY">Eli Lilly and Company</option>
                        <option value="LMT">Lockhead Martin Corporation</option>
                        <option value="MA">Mastercard Incorporated</option>
                        <option value="MCD">McDonalds Corporation</option>
                        <option value="MDLZ">Mondelez International, Inc</option>
                        <option value="META">Meta Platforms, Inc</option>
                        <option value="MMM">3M Company</option>
                        <option value="MO">Altria Group, Inc</option>
                        <option value="MRK">Merck & Company, Inc</option>
                        <option value="MSFT">Microsoft Corporation</option>
                        <option value="MS">Morgan Stanley</option>
                        <option value="NFLX">Netflix, Inc</option>
                        <option value="NKE">Nike, Inc</option>
                        <option value="NVDA">NVIDIA Corporation</option>
                        <option value="ORCL">Oracle Corporation</option>
                        <option value="PEP">PepsiCo, Inc</option>
                        <option value="PFE">Pfizer, Inc</option>
                        <option value="PG">Procter & Gamble Company</option>
                        <option value="PM">Philip Morris International inc</option>
                        <option value="PYPL">Paypal Holdings, inc</option>
                        <option value="REGN">Regeneron Pharmaceuticals, inc</option>
                        <option value="SBUX">Starbucks Corporation</option>
                        <option value="TMO">Thermo Fisher Scientific Inc</option>
                        <option value="TMUS">T-Mobile US, Inc</option>
                        <option value="TSLA">Tesla Inc</option>
                        <option value="T">AT&T Inc</option>
                        <option value="UNH">UnitedHealth Group Incorprorated</option>
                        <option value="UPS">United Parcel Service, Inc</option>
                        <option value="VRTX">Vertex Pharmaceuticals Incorporated</option>
                        <option value="VRZ">Verizon Communications Inc</option>
                        <option value="VS">Visa Inc</option>
                        <option value="WFC">Wells Fargo & Company</option>
                        <option value="WMT">Walmart Inc</option>
                        <option value="XOM">Exxon Mobil Corporation</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Stop Loss</label>
                        <input type="number" name="sl" class="form-control"  min="0" value="0.0000" step="any"  required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>Take Profit</label>
                        <input type="number" name="tp" class="form-control"  min="0" value="0.0000" step="any" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Expire Date</label>
                        <select  class="form-control" name="comment" >
                        <option value="1 Day">1 Day</option>
                        <option value="5 Days">5 Days</option>
                        <option value="1 Month">1 Month</option>
                        <option value="3 Months">3 Months</option>
                        <option value="6 Months">6 Months</option>
                        <option value="1 Year">1 Year</option>
                        <option value="5 Years">5 Years</option>
                        
                        </select>  
                      </div>
                    </div>
                  </div>
                  
                    
                    
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label></label>
                        <input type="submit" name="sell" class="btn btn-block btn-danger btn-lg" value="Sell Stocks">
                      </div>
                    </div>
                  </div>
                </form>     
                                                
                                           
                                     
                                                
                                                
                                                 
                                                
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Sell Modal End -->
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
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    
  
</body>

</html>
