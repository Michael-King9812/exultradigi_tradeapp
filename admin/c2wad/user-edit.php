<?php
session_start();


include "../../conn.php";
include "header.php";
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_GET['email'])){
	$email = $_GET['email'];
}else{
	$email = '';
}


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}
 


  $sql= "SELECT * FROM users WHERE email = '$email'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

      
          
          

        }
				 
          
				  
        
      
      



    if(isset($_POST['edit'])){
	
	
      $emails =$link->real_escape_string( $_POST['email']);
       $fname =$link->real_escape_string( $_POST['fname']);
       $lname =$link->real_escape_string( $_POST['lname']);
        $password =$link->real_escape_string( $_POST['password']);
      $walletbalance =$link->real_escape_string( $_POST['balance']);
      
        $phone =$link->real_escape_string( $_POST['phone']);
          $dob =$link->real_escape_string( $_POST['dob']);


      
          
        
      $sql1 = "UPDATE users SET fname='$fname', lname = '$lname', email='$emails',password='$password', balance='$walletbalance', dob='$dob', phone='$phone' WHERE email='$email'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Account Details Edited Successfully!";
      } else {
          $msg = "Cannot Edit Account! ";
      }
    }


    $sql= "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);

  
      
      

    }

?>



  <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">INVESTORS MANAGEMENT</h2>
		  </br>

</br>
          
          </div>

          <div class="section-body">
              
                  <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
                  <div class="col-lg-12">
                    
       </br>

          </br>
              
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                    
                    
                
                        
                   
                    <form action="user-edit.php?email=<?php echo $email;?>" method="POST">

                <div  style="margin-top:-300px;" class="">
                  <div class="col-md-12">
                   
                    <div class="table-responsive">
                      
                    <table class="table table-striped table-hover table-md">

                    <tr>
                         
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th class="text-center">Email</th>
                         <th class="text-right">Password</th>
                       </tr>


                       </div>
                       <div class="form-group row mb-4">
                          <td> <input type="text" name="fname" class="form-control" value="<?php echo  $row['fname'] ;?>"> </td>
</div>

<div class="form-group row mb-4">
                          <td> <input type="text" name="lname" class="form-control" value="<?php echo  $row['lname'] ;?>"> </td>
</div>

 <div class="form-group row mb-4">
                          <td> <input type="text" name="email" class="form-control" value="<?php echo  $row['email'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" name="password" class="form-control" value="<?php echo $row['password'] ;?>"></td>
                          </div>


                          </div>
                        </tr>






                        <tr>
                         
                          <th>Wallet Balance</th>
                          <th class="text-center">Phone</th>
                          <th class="text-center">Date of Birth</th>
                         
                        </tr>
                        <tr>
                        
                      
                    </div><div class="form-group row mb-4">
                          <td> <input type="text" name="balance"  class="form-control" value="<?php echo $row['balance'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="dob" class="form-control" value="<?php echo $row['dob'] ;?>"></td>
                          </div>

                          </div>
                        </tr>
                        
                        
                   
                      
                        
                             
                        
                        
                        
                        </br></br>






                       
                        </br></br>
                       
                      

                        <tr>
                          <td>
                        <button  type="submit" name="edit" class="btn btn-success btn-icon icon-left"><i class="fa fa-check"></i> Edit User Details</button></td>
                        </tr>

                </form>

                      </table>
                    </div>
                   
                        <hr>
             
              </div>
            </div>
 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
          </div>
        </section>
      </div>
      
    </div>
  </div>

