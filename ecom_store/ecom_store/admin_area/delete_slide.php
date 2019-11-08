<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['delete_slide'])) {
   		$delete_id=$_GET['delete_slide'];
   		$delete_slider="delete from slider where slide_id='$delete_id'";
   		$run_delete=mysqli_query($con,$delete_slider);
   		if ($run_delete) {
   			echo "<script>alert('One slide has been deleted')</script>";
   			echo "<script>window.open('index.php?view_slides','_self')</script>";
   		}
   	}
 ?>
