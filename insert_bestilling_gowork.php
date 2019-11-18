<?php
  session_start(); 
  include("db.php");
  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
 ?>
<?php 
	if (isset($_POST['insert_client'])) {
		$_SESSION['account_code']=$_POST['insert_client'];
		$account_code=$_POST['insert_client'];
	}elseif (isset($_GET['insert_client'])) {
		$_SESSION['account_code']=$_GET['insert_client'];
		$account_code=$_GET['insert_client'];
	}
		$sth = $con->prepare('SELECT account_school FROM accounts WHERE account_code= :account_code');
		$sth->bindParam(':account_code', $account_code);
		$sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		$school_name=$row['account_school'];
		$_SESSION['school_name']=$row['account_school'];
		$_SESSION['account_email']=$row['account_email'];
 ?>
<!DOCTYPE html>
<html>

	<head>
		<title>Send ordre GO:WORK</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="https://kit.fontawesome.com/ee17b9c6d0.js" crossorigin="anonymous"></script>
		<link href="css/style.css" rel="stylesheet">
	</head>

<body>
	<?php include_once 'header_gowork.php' ?>
	<div class="container" style="min-width: 90%">
	<div class="row"><!-- 2 row Starts -->
		<div class="col-md-12"><!-- col-lg-12 Starts -->
			<div class="card text-white">
				<div class="card-header">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fa fa-money fa-fw"></i> <span style="text-decoration: underline;">GO:WORK Send Bestilling på vegne af <?php echo $school_name; ?> </span>
						</h3>
					</div>
				</div>
				<div class="card-body text-center">
					<form autocomplete="off" action="test.php" method="post" enctype="multipart/form-data" class="ml-5">
							<div class="form-group row">
							    <label for="order_date" class="col-md-12 col-lg-2 col-form-label">Eksamensdato</label>
							    <div class="col-md-7 col-lg-3">
							      <input type="text" required class="form-control" id="order_date" name="order_date" placeholder="Dato">
							    </div>
						  	</div>
						  <div class="form-group row">
							    <label for="order_address" class="col-md-12 col-lg-2 col-form-label">Adresse</label>
							    <div class="col-md-7 col-lg-3">
							      <select class="form-control" name="order_address" required>
							      	<option value="">Select an address</option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_address FROM school_info WHERE school_code = :school_code AND school_address != ''");
							      	$stmt->bindParam(':school_code', $account_code);
									$stmt->execute();
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										$order_address =$row['school_address'];
										echo "<option>$order_address</option>";
									}
									?>
							      </select>
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_meeting" class="col-md-12 col-lg-2 col-form-label">Mødested</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_meeting" name="order_meeting">
							      	<option value="">Select a meeting place</option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_meeting FROM school_info WHERE school_code = :school_code AND school_meeting != ''");
							      	$stmt->bindParam(':school_code', $account_code);
									$stmt->execute();
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										$order_meeting = htmlspecialchars($row['school_meeting']);
										echo "<option>$order_meeting</option>";
									}
									?>
							      </select>
							    </div>
						  </div>
						  <div class="form-group hidden row" style="display: none;">
							    <label for="order_lokale" class="col-md-2 col-form-label">Eksamen Lokale</label>
							    <div class="col-md-7 col-lg-3">
							      <input value="" type="text" class="form-control" id="order_lokale" name="order_lokale" placeholder="Lokale">
							    </div>
						  </div>
						<div class="form-group row">
							    <label for="order_shifts" class="col-md-2 col-form-label">Antal eksamensvagter</label>
							    <div class="col-md-7 col-lg-3">
							      <input required type="number" class="form-control" min="1" id="order_shifts" name="order_shifts" placeholder="Antal">
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_fag" class="col-md-2 col-form-label">Fag</label>
							    <div class="col-md-7 col-lg-3">
							      <input type="text" class="form-control required" id="order_fag" name="order_fag" placeholder="Fag">
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_fakultet" class="col-md-2 col-form-label">Fakultet (Hvis relevant)</label>
							    <div class="col-md-7 col-lg-3">
							      <select class="form-control" id="order_fakultet" name="order_fakultet">
							      	<option value="Not Relevant">Select a faculty</option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_fakultet FROM school_info WHERE school_code = :school_code AND school_fakultet !='' ORDER BY school_fakultet");
							      	$stmt->bindParam(':school_code', $account_code);
									$stmt->execute();
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										$order_fakultet = $row['school_fakultet'];
										echo "<option>$order_fakultet</option>";
									}
									?>
							      </select>
							    </div>
						  </div>

						  	<div class="form-group row">
							    <label for="order_start_time" class="col-md-2 col-form-label">Vagt Starttidspunkt</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_start_time" name="order_start_time">
							      	<option value="">Select a starting time </option>
							      	<?php
							      		for ($i=7; $i < 16; $i++) { 
							      			echo "<option>$i:00</option>";
							      			echo "<option>$i:15</option>";
							      			echo "<option>$i:30</option>";
							      			echo "<option>$i:45</option>";
							      		}
									?>
							      </select>
							    </div>
							</div>
						  <div class="form-group row">
							    <label for="order_stop_time" class="col-md-2 col-form-label">Vagt Sluttidspunkt</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_stop_time" name="order_stop_time">
							      	<option value="">Select a finish time </option>
							      	<?php
							      		for ($i=9; $i < 19; $i++) { 
							      			echo "<option>$i:00</option>";
							      			echo "<option>$i:15</option>";
							      			echo "<option>$i:30</option>";
							      			echo "<option>$i:45</option>";
							      		}
									?>
							      </select>
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_kontakt" class="col-md-2 col-form-label">Kontaktperson</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_kontakt" name="order_kontakt">
							      	<option value="">Select a contact</option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_kontakt FROM school_info WHERE school_code = :school_code AND school_kontakt !=''");
							      	$stmt->bindParam(':school_code', $account_code);
									$stmt->execute();
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										$order_kontakt = $row['school_kontakt'];
										echo "<option>$order_kontakt</option>";
									}
									?>
							      </select>
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_form" class="col-md-2 col-form-label">Eksamensform</label>
							    <div class="col-md-7 col-lg-3">
								      <select required class="form-control" id="order_form" name="order_form">
								      	<option value="">Select a form </option>
								      	<option value="SKR">Skriftlig</option>
								      	<option value="MDT">Mundtlig</option>
								      </select>
							    </div>
						  </div>
						  	<div class="form-group row">
							    <label for="order_dokument" class="col-md-2 col-form-label">Relevante dokumenter (Hvis relevant)</label>
							    <div class="col-md-7 col-lg-3">
							      <input type="file" class="form-control-file" name="order_dokument" accept="application/pdf">
							    </div>
						  </div>		
					<div class="form-group row">
						<label for="submit" class="col-md-2 col-form-label"></label>
						<div class="col-md-7 col-lg-3 text-left">
							 <button type="submit" class="form-control btn btn-sm btn-light" id="submit" name="submit" value="">Send Bestilling <i class="fas fa-arrow-alt-circle-right"></i></button>
						 </div>
					</div>
						  <?php $stmt=null; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once 'footer.php'; ?>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/insert.js"></script>
</body>
</html>
