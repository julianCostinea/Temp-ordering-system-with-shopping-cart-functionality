<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['payment_delete'])) {
   		$delete_id=$_GET['payment_delete'];
   		$delete_payment="delete from payments where payment_id='$delete_id'";
   		$run_delete=mysqli_query($con,$delete_payment);
   		if ($run_delete) {
   			echo "<script>alert('One payment has been deleted')</script>";
   			echo "<script>window.open('index.php?view_payments','_self')</script>";
   		}
         else{
      echo "<script>alert('ERROR')</script>";
   }
   	}
 ?>
