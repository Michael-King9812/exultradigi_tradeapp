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

include "sell_buy.php";

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
    <li><a href="stock.php" >Stock</a></li>
    <li><a href="crypto.php">Cryptocurrency</a></li>
    <li><a href="indices.php">Indices</a></li>
    <li><a href="cfd.php" class="selected">Commodities</a></li>
    
    
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
  "symbol": "OANDA:BCOUSD",
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
             </form>
                                          </div>
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
                                            $sql= "SELECT * FROM sell_order WHERE email='$email' ORDER BY id DESC ";
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
                        <input type="hidden" name="ordertype" value="buy" >
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Symbol</label>
                        <select name="symbol" class="form-control" >
                        <option value="UKOIL">UKOIL, Crude Oil Brent</option>
                        <option value="USOIL">USOIL, Crude Oil</option>
                        <option value="XNGUSD">XNGUSD, Natural Gas vs US Dollar</option>
                        <option value="XAGAUD">XAGAUD, Silver vs Australian Dollar</option>
                        <option value="XAGEUR">XAGEUR, Silver vs Euro</option>
                        <option value="XAGUSD">XAGUSD, Silver vs US Dollar</option>
                        <option value="XAUAUD">XAUAUD, Gold vs Australian Dollar</option>
                        <option value="XAUCHF">XAUCHF, Gold vs Swiss Franc</option>
                        <option value="XAUEUR">XAUEUR, Gold vs Euro</option>
                        <option value="XAUGBP">XAUGBP, Gold vs Great Britain Pound</option>
                        <option value="XAUJPY">XAUJPY, Gold vs Japanese Yen</option>
                        <option value="XAUUSD">XAUUSD, Gold vs US Dollar</option>
                        <option value="XPDUSD">XPDUSD, Palladium vs US Dollar</option>
                        <option value="XPTUSD">XPTUSD, Platinum vs US Dollar</option>
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
                        <label>Comment</label>
                        <input type="text"  class="form-control" name="comment"  >
                      </div>
                    </div>
                  </div>
                  
                    
                    
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label></label>
                        <input type="submit" name="buy" class="btn btn-block btn-success btn-lg" value="Buy">
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
                        <input type="hidden" name="ordertype" value="sell" >
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Symbol</label>
                        <select name="symbol" class="form-control" >
                        <option value="UKOIL">UKOIL, Crude Oil Brent</option>
                        <option value="USOIL">USOIL, Crude Oil</option>
                        <option value="XNGUSD">XNGUSD, Natural Gas vs US Dollar</option>
                        <option value="XAGAUD">XAGAUD, Silver vs Australian Dollar</option>
                        <option value="XAGEUR">XAGEUR, Silver vs Euro</option>
                        <option value="XAGUSD">XAGUSD, Silver vs US Dollar</option>
                        <option value="XAUAUD">XAUAUD, Gold vs Australian Dollar</option>
                        <option value="XAUCHF">XAUCHF, Gold vs Swiss Franc</option>
                        <option value="XAUEUR">XAUEUR, Gold vs Euro</option>
                        <option value="XAUGBP">XAUGBP, Gold vs Great Britain Pound</option>
                        <option value="XAUJPY">XAUJPY, Gold vs Japanese Yen</option>
                        <option value="XAUUSD">XAUUSD, Gold vs US Dollar</option>
                        <option value="XPDUSD">XPDUSD, Palladium vs US Dollar</option>
                        <option value="XPTUSD">XPTUSD, Platinum vs US Dollar</option>
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
                        <label>Comment</label>
                        <input type="text"  class="form-control" name="comment"  >
                      </div>
                    </div>
                  </div>
                  
                    
                    
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label></label>
                        <input type="submit" name="sell" class="btn btn-block btn-danger btn-lg" value="Sell">
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
