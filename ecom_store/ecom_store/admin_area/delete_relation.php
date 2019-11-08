<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['delete_relation'])) {
   		$delete_id=$_GET['delete_relation'];
   		$delete_relation="delete from bundle_product_relation where rel_id='$delete_id'";
   		$run_delete=mysqli_query($con,$delete_relation);
   		if ($run_delete) {
   			echo "<script>alert('One relation has been deleted')</script>";
   			echo "<script>window.open('index.php?view_relations','_self')</script>";
   		}
         else{
      echo "<script>alert('ERROR')</script>";
   }
   	}
 ?>
