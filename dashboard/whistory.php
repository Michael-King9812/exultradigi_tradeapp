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
   <title>ExUltraDigi | Withdrawal History</title>
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
       <div class="sidebar-menu">
            <div class="sidebar-header">
               <div class="logo">
               
                    <a href="index.php"><img src="assets/images/icon/logo.png" alt="logo"></a>       
                   
               </div>
               
               <div class="badge badge-danger">
                    <h5><span class="badge badge-danger">Balance</span></h5>
                </div>
                
                <div class="badge badge-success">
                    <h5><span class="badge badge-success"><?php echo $ubalance;?>USD</span></h5>
                </div>
            </div>
            <div class="main-menu">
               <div class="menu-inner">
                   <nav>
                   
                       <ul class="metismenu" id="menu">
                       
                       <li> 
                               <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-dashboard"></i><span>Dashboard
                                   </span></a>
                               <ul class="collapse">
                                   <li><a href="index.php">Dashboard</a></li>
                                  
                               </ul>
                           </li>
                          
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
                                   <li><a href="history.php">Trade History</a></li>
                                   
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
           <!-- header area start -->
           <div class="header-area">
               <div class="row align-items-center">
                   <!-- nav and search button -->
                   <div class="col-md-6 col-sm-8 clearfix">
                       <div class="nav-btn pull-left">
                           <span></span>
                           <span></span>
                           <span></span>
                       </div>
                       <div class="search-box pull-left">
                                                 </div>
                   </div>
                   <!-- profile info & task notification -->
                   <div class="col-md-6 col-sm-4 clearfix">
                       <ul class="notification-area pull-right">
                           
                           
                           <li class="dropdown">
                              
                           </li>
                           <li class="dropdown">
                               
                           </li>
                          
                       </ul>
                   </div>
               </div>
           </div>
           <!-- header area end -->
           <!-- page title area start -->
           <!-- page title area end -->
                       
            <div class="top"> 
                <ul class="menu">                
                    <li><a href="index.php" >Forex</a></li>
                    <li><a href="history.php" >Trade History</a></li>
                    <li><a href="withdrawal.php" class="selected">Withdrawal</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter">Deposit</a></li>
                </ul>
            </div>

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
                               <h4><span class="fa fa-history"> Withdrawal History</span></h4>
                                <p> </p>
                               <div >
                               
                                                              
                          <!-- table dark start -->
                   
                              
                                   <div class="table-responsive">
                                       <table class="table text-center">
                                           <thead class="text-uppercase bg-dark">
                                               <tr class="text-white">
                                                   <th scope="col">ID</th>
                                                   <th scope="col">Amount</th>
                                                   <th scope="col">Payment Method</th>
                                                   <th scope="col">Date</th>
                                                   <th scope="col">Status</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            <?php 
                                                $i = 1;
                                                $sql= "SELECT * FROM wbtc WHERE email='$email' ORDER BY id DESC ";
                                                $result = mysqli_query($link,$sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){ 
                                                        
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i;?></th>
                                                    <td> $<?php echo $row['moni'];?></td>
                                                    <td><?php echo $row['mode'];?></td>
                                                    <td><?php echo $row['date'];?></td>
                                                    <td><?php echo $row['status'];?></td>
                                                </tr>
                                            <?php
                                                $i++;       
                                                } } 
                                            ?> 
                                               
                                               
                                               
                                           </tbody>
                                       </table>
                                   </div>
                              
                       
                               
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
                                            </form>  </div>
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
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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