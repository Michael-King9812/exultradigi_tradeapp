<?php
session_start(); 
include "../conn.php";

$msg = "";
$wire = "";
$pm = "";
$btc = "";
if(isset($_SESSION['email'])){

    $email = $link->real_escape_string($_SESSION['email']);

    $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $fname = $row1['fname'];
        $lname = $row1['lname'];
        $phone = $row1['phone'];
       
        

    

    }else{
  
  
        header("location: ../login.php");
        }
}else{
    header('location: ../login.php');
    die();
}


// Processing form data when form is submitted

if(isset($_POST['wire'])){


    $sql1 = "UPDATE users SET wth = 'wire' WHERE email = '$email' ";
         
    mysqli_query($link, $sql1);

    $wire = 1;

}

if(isset($_POST['pm'])){


    $sql1 = "UPDATE users SET wth = 'pm' WHERE email = '$email' ";
         
    mysqli_query($link, $sql1);

    $pm = 1;

}

if(isset($_POST['btc'])){


    $sql1 = "UPDATE users SET wth = 'btc' WHERE email = '$email' ";
         
    mysqli_query($link, $sql1);

    $btc = 1;

}




if(isset($_POST['save'])){
 
   

    // Validate name
    if(empty(trim($_POST["dob"]))){
        $msg = "Please enter your date of birth.";     
    } else{
        $udob = $link->real_escape_string($_POST["dob"]);
    }
    if(empty(trim($_POST["phone"]))){
        $msg = "Please enter your telephone.";     
    } else{
        $uphone = $link->real_escape_string($_POST["phone"]);
    }
   

    



    
    // Check input errors before inserting in database
    if(empty($msg)){
        
        
               
        // Prepare an insert statement
        $sql1 = "UPDATE users SET dob = '$udob', phone = '$uphone' WHERE email = '$email' ";
         
        if(mysqli_query($link, $sql1)){
          

               

          echo "<script>
           window.location.href='profile.php?success';
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
    <title>ExUltraDigi | Forex Experts</title>
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
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Edit Profile</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                             <h5>USD <?php echo $ubalance;?></h5><i class="fa fa-angle-down"></i>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onClick="withd()">Withdrawal</a>
                                <a class="dropdown-item" href="#" onClick="history()">History</a>
                                <a class="dropdown-item" href="#" onClick="trans()">Transactions</a>
                                <a class="dropdown-item" href="#" onClick="logout()">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
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
   </script>    <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">
                    <!-- seo fact area start -->
                   
                    <!-- seo fact area end -->
                    <!-- Social Campain area start -->
                    <div class="col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body pb-0">
                               
                            <div class="card-body">
                                <h4 class="header-title">Withdrawal Method</h4>
                                
                                
                                
                                
                                <h4>
                                <?php 
                                if($btc == 1){
                                   echo "<img src='assets/images/bitcoin.jpg'>";
                                }
                                if($pm == 1){
                                    echo "<img src='assets/images/pmhov.jpg'>";
                                }
                                if($wire == 1){
                                   echo "<li class='fa fa-bank'> Bank Transfer</li>";
                                }
                               
                                if($btc == 1 || $wire == 1 || $pm == 1){
                                    echo "<div class='alert alert-success'><strong>Set as default withdrawal method</strong></div>";
                                }
                              ?>
                                
								
								</h4>
                                 
           
           <div id="accordion" role="tablist">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <span class="fa fa-bank"></span> Wire Transfer
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
       <form method="post">
                
                                        
                                        
                                         <div class="form-group">
                                           
                                            <button type="submit" name="wire" class="btn btn-primary mb-3"><li class="fa fa-bank"></li> Set As Default</button>
                                        </div>
                                
                                </form> 
        
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         <span class="fa fa-btc"></span> Bitcoin
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
       <form method="post">
                                
                                         <div class="form-group">
                                           
                                            <button type="submit" name="btc" class="btn btn-primary mb-3"><li class="fa fa-btc"></li> Set As Default</button>
                                        </div>
                                
                                </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         <span class="fa fa-dollar"></span> Perfect Money
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <form method="post">
                                
                                        
                                         <div class="form-group">
                                           
                                            <button type="submit" name="pm" class="btn btn-primary mb-3"><li class="fa fa-dollar"></li> Set As Default</button>
                                        </div>
                                
                                </form>
      </div>
    </div>
  </div>
</div>                     
                                
                                
                                
                                
                               
                            </div>
                       
                   
                        
                    <!-- Active Items end -->  
                            </div>
                        </div>
                    </div>
                    <!-- Social Campain area end -->
                    <!-- Statistics area start -->
                    <div class="col-lg-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4><span class="fa fa-edit"> Edit Profile</span></h4>
                                 <h4> </h4>
                                <div >
                                
                                <form method="post">
                                <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
                                <?php if(isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> Profile updated successfully </div class='btn btn-success'>" ."</br>";  ?>
                                <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Full Name</label>
                                            <input class="form-control" type="text" value="<?php echo $fname." ".$lname; ?>" id="example-text-input" readonly>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-form-label">Date of Birth</label>
                                            <input name="dob" class="form-control" type="date" value="" id="example-datetime-local-input" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="example-tel-input" class="col-form-label">Telephone</label>
                                            <input  name="phone" class="form-control" type="tel" value="<?php echo $phone;?>" id="example-tel-input" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="example-search-input" class="col-form-label">Email Address</label>
                                            <input class="form-control"  readonly type="email" value="<?php echo $email;?>" id="example-search-input">
                                        </div>
                                        
                                      
                                           </div> 
                                            
                                        
                                         <div class="form-group">
                                           
                                            <button type="submit" name="save" class="btn btn-primary mb-3">Save</button>
                                        </div>
                                
                                </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Statistics area end -->
                    <!-- Advertising area start -->
                  
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
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    
 
</body>

</html>
