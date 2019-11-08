<div class="text-center p-3" >
	<h1>Do you Really Want to Delete Your Account? </h1>
	<form action="" method="post">
		<input type="submit" name="yes" value="Yes, I want to delete my account" class="btn btn-danger">
		<input type="submit" name="no" value="No, I Don't want to delete my acoount" class="btn btn-primary">
	</form>
</div>
<?php
	$c_email=$_SESSION['customer_email']; 
	if (isset($_POST['yes'])) {
		$delete_customer="delete from customers where customer_email='$c_email'";
		$run_delete=mysqli_query($con, $delete_customer);
		if ($run_delete) {
			session_destroy();
			echo "<script>alert ('Account has been deleted.')</script>";
			echo "<script>window.open('../index.php','_self')</script>";
		}
	}
	if (isset($_POST['no'])) {
		echo "<script>window.open('my_account.php?my_orders','_self')</script>";
	}
 ?>