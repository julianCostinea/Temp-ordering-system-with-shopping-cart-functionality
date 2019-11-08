<?php
  session_start(); 
  include("db.php");
  if (!isset($_SESSION['client_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
  }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>GO:WORK Ordresystem</title>
	<link rel="icon" href="dokumenter/color.png" type="image/icon type">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link href="css/home.css" rel="stylesheet">
</head>
<body>
		<div class="pageHeader">
			<img src="dokumenter/NYlogo250px.png" class="img-fluid ml-4">
			<div class="text-center float-right icon_div mt-3">
				<a href="logout.php" class="btn btn-lg btn-secondary icon_link m-3" style="min-width: 7rem;"> Log out </a>
			</div>
		</div>

		<div class="orderContainer text-center">
		  <a class="orderCard" href="insert_bestilling.php">
		    <div class="card text-dark bg-info mb-3">
			  <div class="card-body">
			    <h5 class="card-title"><i class="fas fa-plus-circle"></i></h5>
			    <p class="card-text">Send Ordre</p>
			  </div>
			</div>
		  </a>		
		</div>

		<div class="call-outs-container text-center">
		  <a class="call-out" href="view_aktive_bestillinger.php">
		    <div class="card text-dark bg-primary mb-3">
			  <div class="card-body">
			    <h5 class="card-title"><i class="fas fa-list"></i></h5>
			    <p class="card-text">Aktive Ordrer</p>
			  </div>
			</div>
		  </a>

		  <a class="call-out" href="view_kladder.php">
			<div class="card text-dark bg-success mb-3">
			  <div class="card-body">
			    <h5 class="card-title"><i class="far fa-save"></i></h5>
			    <p class="card-text">Kladder</p>
			  </div>
			</div>
		  </a>

		  <a class="call-out" href="view_completed_bestillinger.php">
		    <div class="card text-dark bg-danger mb-3">
			  <div class="card-body">
			    <h5 class="card-title"><i class="fas fa-check-square"></i></h5>
			    <p class="card-text">Gamle Bestillinger</p>
			  </div>
			</div>
		  </a>
		</div>

	<footer>
		<div class="center"> <p>&copy; GO:WORK ApS</p></div>
	</footer>
</body>
</html>