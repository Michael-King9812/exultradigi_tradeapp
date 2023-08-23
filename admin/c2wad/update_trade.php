<?php
session_start();


include "../../conn.php";
include "header.php";
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_GET['orderid'])){
	$orderid = $_GET['orderid'];
}else{
	$orderid = '';
}


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}
 
 $sql= "SELECT * FROM sell_order WHERE orderid = '$orderid'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

      
          
          

        }

    if(isset($_POST['update'])){
	
	
      $profit =$link->real_escape_string( $_POST['profit']);
      $orderid =$link->real_escape_string( $_POST['orderid']);
       $loss =$link->real_escape_string( $_POST['loss']);
        $uprofit =$link->real_escape_string( $_POST['uprofit']);
      $email =$link->real_escape_string( $_POST['email']);
       $uloss =$link->real_escape_string( $_POST['uloss']);
       
      if($profit != "" && $loss == ""){
         
          $sql12 = "UPDATE users SET balance = balance + '$profit' WHERE email='$email'";
          mysqli_query($link, $sql12);
          
          $sql3 = "UPDATE sell_order SET profit = profit + '$profit' WHERE orderid='$orderid'";
          
          if (mysqli_query($link, $sql3)) {
              
          $msg = "Trade Profit Updated Successfully!";
          
          }else{
     
          $msg = "Error! Profit not updated, please try again";
      }
         
      }
      
      if($profit == "" && $loss != ""){
         
          $sql3 = "UPDATE sell_order SET loss = loss + '$loss' WHERE orderid='$orderid'";
          
           if (mysqli_query($link, $sql3)) {
          
          $msg = "Trade Loss Updated Successfully!";
           }else{
     
          $msg = "Error! Loss not updated, please try again";
      }
      }
      
      
      if($profit != "" && $loss != ""){
          
          $sql12 = "UPDATE users SET balance = balance + '$profit' WHERE email='$email'";
          mysqli_query($link, $sql12);
          
          $sql3 = "UPDATE sell_order SET profit = profit + '$profit' WHERE orderid='$orderid'";
          
          if (mysqli_query($link, $sql3)) {
              
              
              
               $sql31 = "UPDATE sell_order SET loss = loss + '$loss' WHERE orderid='$orderid'";
          mysqli_query($link, $sql31);
          
          $msg = "Trade Profit And Loss Updated Successfully!";
          
          }else{
     
          $msg = "Error! Trade not updated, please try again";
      }
          
          
      }

   
      
      if($profit == "" && $loss == ""){
     
          $msg = "Please enter trade loss or profit!";
      }
      
      
      
    }


    $sql= "SELECT * FROM sell_order WHERE orderid = '$orderid'";
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


		 <h2 class="text-center">TRADE UPDATE MANAGEMENT</h2>
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
                    
                    
                
                        
                   
                    <form action="update_trade.php?orderid=<?php echo $orderid;?>" method="POST">

                <div  style="margin-top:-280px;" class="">
                  <div class="col-md-12">
                   
                    <div class="table-responsive">
                      
                    <table class="table table-striped table-hover table-md">

                    <tr>
                         
                         <th>Order</th>
                         <th>Profit</th>
                         <th class="text-center">Loss</th>
                         <th style="display:none">EMAIL</th>
                         <th style="display:none">EMAIL</th>
                         <th style="display:none">EMAIL</th>
                       </tr>


                       </div>
                       <div class="form-group row mb-4">
                          <td> <input type="text" name="orderid" class="form-control" value="<?php echo  $orderid ;?>" readonly> </td>
</div>

<div class="form-group row mb-4">
                          <td> <input type="double" name="profit" class="form-control" value=""> </td>
</div>

 <div class="form-group row mb-4">
                          <td> <input type="double" name="loss" class="form-control" value=""> </td>
</div>
 <td style="display:none"><input type="hidden" name="email" value="<?php echo $row['email'];?>"</td>
  <td style="display:none"><input type="hidden" name="uprofit" value="<?php echo $row['profit'];?>"</td>
   <td style="display:none"><input type="hidden" name="uloss" value="<?php echo $row['loss'];?>"</td>



                          </div>
                        </tr>


  <tr>
                         
                          <th></th>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                         
                        </tr>
                        <tr>
                        
                      
                    </div><div class="form-group row mb-4">
                          <td>  </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> </td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> </td>
                          </div>

                          </div>
                        </tr>



                      
                        
                   
                      
                        
                             
                        
                        
                        
                        </br></br>






                       
                        </br></br>
                       
                      

                        <tr>
                          <td>
                        <button  type="submit" name="update" class="btn btn-success btn-icon icon-left"><i class="fa fa-check"></i> Update</button></td>
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

