<?php
session_start();

include "../../conn.php";
include "../../config.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET['referred'])){
	$referreds = $_GET['referred'];
}else{
	$referreds = '';
}


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}
if(isset($_POST['approve'])){
	
	$tnx = $_POST['tnx'];
	

		$sql1 = "UPDATE sell_order SET status = 'approved'  WHERE id='$tnx'";
		
		
		
    if (mysqli_query($link, $sql1)) {
      $msg = "Order approved successfully!";
  } else {
      $msg = "Order not approved! ";
  }

}




if(isset($_POST['delete'])){
	
	$tnx = $_POST['tnx'];
	
$sql = "DELETE FROM sell_order WHERE id='$tnx'";

if (mysqli_query($link, $sql)) {
    $msg = "Order deleted successfully!";
} else {
    $msg = "Order not deleted! ";
}
}

if(isset($_POST['complete'])){
	
	$tnx = $_POST['tnx'];
	
$sql = "UPDATE sell_order SET status = 'complete' WHERE id='$tnx'";

if (mysqli_query($link, $sql)) {
    $msg = "Order completed successfully!";
} else {
    $msg = "Order not completed! ";
}
}



include 'header.php';





?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  

  <link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.jqueryui.min.css">



  

  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="">
 
  
    
    



  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.jqueryui.min.js"></script>
   
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
  

     
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   <style>
 
	
   </style>


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">TRADE MANAGEMENT</h2>
		  </br>

</br>
 <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
		    </br>

<div class="col-md-12 col-sm-12 col-sx-12">
               <div class="table-responsive">
                     <table class="display"  id="example">

					<thead>

						<tr class="info">
						<th>Email</th>
                        <th>Order</th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
							<th>Type</th>
              <th>Volume</th>
                               <th>Symbol</th>
							 
							 
							
							 
							<th>Stop Loss</th>
                                <th>Take Profit</th>
                               
                                  <th>Comment</th>
                                 
                                <th>Expiry Date</th>
                                <th>Profit</th>
                                <th>Loss</th>
                                <th> Mode </th>
                                <th>Status</th>
                                <th>Date</th>
                                  <th>Action</th>
                                  <th>Action</th>
                                  <th>Action</th>
                                  <th>Action</th>
								
                                

						</tr>
					</thead>


					<tbody>
					<?php $sql= "SELECT * FROM sell_order ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   



$row['status'];
   
   
if(isset($row['status']) &&  $row['status']== 'approved'){
	
	
	$sec = 'Approved &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-check" ></i>';

}else{
$sec ='Pending &nbsp;&nbsp;<i class="fa  fa-refresh" style=" font-size:20px;color:red"></i>';

}


				  ?>

						<tr class="primary">
						<form action="trade.php" method="post">
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['orderid'];?></td>
							
							<td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="usd" value="<?php echo $row['volume'];?>"> </td>
							
							<td style="display:none;"><input type="hidden" name="tnx" value="<?php echo $row['id'];?>"> </td>
							<td><?php echo $row['type'];?>  </td>
              <td>$<?php echo $row['volume'];?>  </td>
              <td><?php echo $row['symbol'];?>  </td>
              <td><?php echo $row['stop_loss'];?>  </td>
              <td><?php echo $row['take_profit'];?>  </td>
              <td><?php echo $row['comment'];?>  </td>
              <td><?php echo $row['exp_time'];?>  </td>
              <td><?php echo $row['profit'];?>  </td>
              <td><?php echo $row['loss'];?>  </td>
              <td><?php 
              if($row['mode'] == "sell"){
              echo "Sell by Market";
                }
                if($row['mode'] == "buy"){
              echo "Buy by Market";
                }
                if($row['mode'] == "sellsh"){
              echo "Sell Shares";
                }
                if($row['mode'] == "buysh"){
              echo "Buy Shares";
                }
              
              
              ?>  </td>
              <td><?php echo $row['status'];?>  </td>
              <td><?php echo $row['date'];?>  </td>
					
			  
                            <td><button class="btn btn-success" type="submit" name="approve"><span class="glyphicon glyphicon-check"> Approve</span></button></td>
                            

							<td><button class="btn btn-info" type="submit" name="complete"><span class="glyphicon glyphicon-check"> Complete</span></button></td>
						 <td> <a href="update_trade.php?orderid=<?php echo $row['orderid']?>"> 
                                            <button type="button" name="edit" style="width:100%" class="btn btn-primary"><span class="fa fa-check">-Update </span></button></a></td>
							<td><button class="btn btn-danger" type="submit" name="delete"><span class="glyphicon glyphicon-check"> Delete</span></button></td>
							
   
</form>

						</tr>
					  <?php
 }
			  }
			  ?>
					</tbody>



				</table>
</div>
          </div>

		  </div>
          <!-- /top tiles -->

          </div>

                



    </body>
              </div>
            </div>


              </div>


          <br />







    </body>
              </div>
            </div>





          </section>

   </div>
  </div>
</div>


  </body>
</html>
    
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
       
    } );
    

    table.buttons().container()
        .insertBefore( '#example_filter' );

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-12:eq(0)' );
} );
</script>






<script>
$(document).ready(function () {
        $('#table')
                .dataTable({
                    "responsive": true,
                    
                });

				
    });



				</script>


