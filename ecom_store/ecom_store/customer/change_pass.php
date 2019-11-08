<h1 align="center">Change Your Password</h1>
<form action="" method="post">
	<div class="form-group ml-2">
		<label>Current Password</label>
		<input type="Password" name="old_pass" class="form-control" required>
	</div>
	<div class="form-group ml-2">
		<label>New Password</label>
		<input type="Password" name="new_pass" class="form-control" required>
	</div>
	<div class="form-group ml-2">
		<label>Confirm New Password</label>
		<input type="password" name="new_pass_again" class="form-control" required>
	</div>
	<div class="text-center">
		<button name="submit" type="submit" class="btn btn-danger mb-2">
			<i class="fa fa-user-md"></i> Change Password
		</button>
	</div>
</form>
<?php 
	if (isset($_POST['submit'])) {
		$c_email=$_SESSION['customer_email'];
		$old_pass=$_POST['old_pass'];
		$new_pass=$_POST['new_pass'];
		$new_pass_again=$_POST['new_pass_again'];
		$sel_old_pass="select * from customers where customer_pass='$old_pass'";
		$run_old_pass=mysqli_query($con, $sel_old_pass);
		$check_old_pass=mysqli_num_rows($run_old_pass);
		if ($check_old_pass==0) {
			echo "<script>alert ('Your current password is wrong')</script>";
			exit();
		}
		if ($new_pass!=$new_pass_again) {
			echo "<script>alert ('Passwords do not match')</script>";
			exit();
		}
		$update_pass="update customers set customer_pass='$new_pass' where customer_email='$c_email'";
		$run_pass=mysqli_query($con, $update_pass);
		if ($run_pass) {
			echo "<script>alert('Password has been changed')</script>";
			echo "<script>window.open('my_account.php?my_orders','_self')</script>";
		}
	}
 ?>