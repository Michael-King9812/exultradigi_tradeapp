<?php
session_start();


include "../../conn.php";
include "../../config.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}






if(isset($_POST['uset'])){

 
    $bname = $_POST['bname'];
    
    $email = $_POST['email'];
   
    $title = $_POST['title'];
    
    $sql = "UPDATE settings SET  bname='$bname', email='$email', title='$title' ";
    
    
    if(mysqli_query($link, $sql)){

       $msg = "Settings Updated!";
     }else{
       
       $msg = "Settings Not Updated!";
     }
 }
 
 

include "header.php";






    ?>

    
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">




<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">CONFIGURATION</h2>
		  </br>

        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>

     <form class="form-horizontal" action="settings.php" method="POST" enctype="multipart/form-data" >

           <legend> <?php echo $name;?> Settings </legend>
		   
		 

        <div class="form-group">
        <input type="text" name="bname" placeholder="Name" value="<?php echo $name;?>"  class="form-control">
        </div>
        
        
        
        
      
        <div class="form-group">
        <input type="text" name="email" placeholder="email" value="<?php echo $emaila;?>"  class="form-control">
        </div>
   
      
        
     <div class="form-group">
        <input type="text" name="title" placeholder="title" value="<?php echo $title;?>"  class="form-control">
        </div>

       
     

        
        
     

      
      
	  
	 

    <button style="" type="submit" class="btn btn-success" name="uset" > <i class="fa fa-send"></i>&nbsp; Update Settings </button>

    </form>


    </div>
   </div>

   </div>
  </div>
  </section>
</div>

