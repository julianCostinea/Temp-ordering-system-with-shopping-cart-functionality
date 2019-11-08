<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['delete_bundle'])) {
   		$delete_id=$_GET['delete_bundle'];
   		$delete_pro="delete from products where product_id='$delete_id'";
   		$run_delete=mysqli_query($con,$delete_pro);

         $delete_relation="delete from bundle_product_relation where bundle_id='$delete_id'";
         $run_delete_relation=mysqli_query($con,$delete_relation);

   		if ($run_delete_relation) {
   			echo "<script>alert('One bundle has been deleted')</script>";
   			echo "<script>window.open('index.php?view_products','_self')</script>";
   		}
   	}
 ?>
