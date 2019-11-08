<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['delete_icon'])) {
   		$delete_id=$_GET['delete_icon'];
   		$delete_icon="delete from icons where icon_id='$delete_id'";
   		$run_delete=mysqli_query($con,$delete_icon);
   		if ($run_delete) {
   			echo "<script>alert('One Icon has been deleted')</script>";
   			echo "<script>window.open('index.php?view_icons','_self')</script>";
   		}
         else{
      echo "<script>alert('ERROR')</script>";
   }
   	}
 ?>
