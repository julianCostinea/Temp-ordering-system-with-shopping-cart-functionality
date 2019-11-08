<?php
	session_start(); 
	include("includes/db.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<!--font awesome fonts !-->
	<link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">
  	<link rel="stylesheet" type="text/css" href="styles/style.css">
  	<link rel="stylesheet" type="text/css" href="styles/login.css">
</head>
<body>
	<div class="container">
		<form class="form-login text-center" action="" method="post">
			<h4 class="form-login-header">Admin Login</h4>
			<input type="text" name="admin_email" placeholder="Email" class="form-control" 
			required>
			<input type="password" name="admin_pass" placeholder="Password" class="form-control" required>
			<button class="btn btn-lg btn-primary" type="submit" name="admin_login"> Log in 
			</button>
		</form>
	</div>
</body>
</html>

<?php
	if (isset($_POST['admin_login'])) {
	 	$admin_email=$_POST['admin_email'];
	 	$admin_pass=$_POST['admin_pass'];
	 	$get_admin="select * from admins where admin_email='$admin_email' AND 
	 	admin_pass='$admin_pass'";
	 	$run_admin=mysqli_query($con, $get_admin);
	 	$count=mysqli_num_rows($run_admin);
	 	if ($count==1) {
	 		$_SESSION['admin_email']=$admin_email;
	 		echo "<script>alert('You are logged in')</script>";
 			echo "<script>window.open('index.php?dashboard','_self')</script>";
	 	}
	 	else{
	 		echo "<script>alert('Wrong Credentials')</script>";
	 	}
	 } 
 ?>