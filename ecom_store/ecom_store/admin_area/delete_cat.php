<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['delete_cat'])) {
   		$delete_cat_id=$_GET['delete_cat'];
   		$delete_cat="delete from categories where cat_id='$delete_cat_id'";
   		$run_delete=mysqli_query($con,$delete_cat);
   		if ($run_delete) {
   			echo "<script>alert('One Category has been deleted')</script>";
   			echo "<script>window.open('index.php?view_cats','_self')</script>";
   		}
         else{
      echo "<script>alert('ERROR')</script>";
   }
   	}
 ?>
