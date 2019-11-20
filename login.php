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
	<?php include_once 'header_login.php' ?>
	<div class="container">
		<form class="form-login text-center" action="" method="post">
			<h4 class="form-login-header">Velkommen til GO:WORKs Bestilling System</h4>
			<div class="form-group row">
			    <label for="client_email" class="col-md-3 col-form-label">Username</label>
			    <div class="col-md-9">
			      <input type="text" required class="form-control" id="client_email" name="client_email">
			    </div>
			</div>
			<div class="form-group row">
			    <label for="client_pass" class="col-md-3 col-form-label">Password</label>
			    <div class="col-md-9">
			      <input type="password" required class="form-control" id="client_pass" name="client_pass">
			    </div>
			</div>
			<button class="btn btn-md btn-primary" type="submit" name="client_login"> Log in 
			</button>
		</form>
	</div>
	<?php include_once 'footer.php'; ?>	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>

<?php
	if (isset($_POST['client_login'])) {
	 	$client_email=$_POST['client_email'];
	 	$client_pass=$_POST['client_pass'];

	 	$stmt = $con->prepare('SELECT * FROM accounts WHERE account_email = :account_email');
	 	$stmt->bindParam(':account_email', $client_email);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$encrypted_pass = $row['account_pass'];

		$count=$stmt->rowCount();
	 	if ($count==1) {
	 		if (!password_verify($client_pass, $encrypted_pass)) {
	 		echo "<script>alert('Wrong Credentials')</script>";
	 		exit();
	 	}
	 		$_SESSION['client_email']=$client_email;
 			echo "<script>window.open('insert_bestilling.php','_self')</script>";
	 	}
	 	else{
	 		echo "<script>alert('Wrong Credentials')</script>";
	 	}
	 } 
 ?>