<?php
	session_start(); 
	include("db.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<script src="https://kit.fontawesome.com/ee17b9c6d0.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form class="form-login text-center" action="" method="post">
			<h4 class="form-login-header">Admin Login</h4>
			<input type="text" name="admin_email" placeholder="Email" class="form-control email" 
			required>
			<input type="password" name="admin_pass" id="client_pass" placeholder="Password" class="form-control" required><br>
			<button class="btn btn-lg btn-primary" type="submit" name="admin_login"> Log in 
			</button>
		</form>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>

<?php
	if (isset($_POST['admin_login'])) {
	 	$admin_email=$_POST['admin_email'];
	 	$admin_pass=$_POST['admin_pass'];

	 	$stmt = $con->prepare('SELECT * FROM admins WHERE admin_email = :admin_email');
	 	$stmt->bindParam(':admin_email', $admin_email);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$encrypted_pass = $row['admin_pass'];

		$count=$stmt->rowCount();
	 	if ($count==1) {
	 		if (!password_verify($admin_pass, $encrypted_pass)) {
	 		echo "<script>alert('Wrong Credentials')</script>";
	 		exit();
	 	}
	 		$_SESSION['admin_email']=$admin_email;
 			echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
	 	}
	 	else{
	 		echo "<script>alert('Wrong Credentials')</script>";
	 	}
	 } 
 ?>