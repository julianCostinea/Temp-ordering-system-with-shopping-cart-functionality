<?php
  session_start(); 
  include("db.php");
  if (!isset($_SESSION['client_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
  }
 ?>
<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor\autoload.php';
 ?>
 <?php 
 	$account_email=$_SESSION['client_email'];
 	$stmt = $con->prepare('SELECT account_code FROM accounts WHERE account_email = :account_email');
	 	$stmt->bindParam(':account_email', $account_email);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$account_code = $row['account_code'];
								
  ?>
<!DOCTYPE html>
<html>

	<head>
		<title>Send ordre</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="https://kit.fontawesome.com/ee17b9c6d0.js" crossorigin="anonymous"></script>
		<link href="css/style.css" rel="stylesheet">
	</head>

<body>
	<div class="row"><!-- 2 row Starts -->
		<div class="col-md-12"><!-- col-lg-12 Starts -->
			<div class="card text-white">
				<div class="card-header">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fa fa-money fa-fw"></i> <span style="text-decoration: underline;">GO:WORK Send Bestilling </span>
						</h3>
					</div>
					<div class="text-center float-right icon_div">
						<a href="logout.php" class="btn btn-secondary icon_link" style="min-width: 7rem;"><span class="icon_span" style="display: none;"><i class="fas fa-sign-out-alt"></i> </span> Log out </a>
					</div>
					<div class="text-center float-right mr-3 icon_div">
						<a href="view_aktive_bestillinger.php" class="btn btn-info text-right icon_link" style="min-width: 8.8rem;"> <span class="icon_span" style="display: none;"><i class="fas fa-list"></i> </span>Se alle ordrer  </a>
					</div>
				</div>
				<div class="card-body text-center" style="font-size: 1.2rem">
					<form id="inserbestilling" autocomplete="off" method="post" enctype="multipart/form-data" >
						<div class="row">
							<div class="col-sm-12 col-md-6 text-left"><!-- first column !-->

							<div class="form-group">
							    <label for="order_date" class="">Eksamensdato</label>
							    <div class="">
							      <input type="text" required class="form-control" id="order_date" name="order_date" placeholder="Dato" style="max-width: 70%">
							    </div>
						  	</div>
						  <div class="form-group">
							    <label for="order_address" class="">Adresse</label>
							    <div class="">
							      <select class="form-control" name="order_address" required style="max-width: 70%">
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
						  <div class="form-group">
							    <label for="order_meeting" class="">Mødested</label>
							    <div class="">
							      <select required class="form-control" id="order_meeting" name="order_meeting" style="max-width: 70%">
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
						  <div class="form-group hidden" style="display: none;">
							    <label for="order_lokale" class="">Eksamen Lokale</label>
							    <div class="">
							      <input value="" type="text" class="form-control" id="order_lokale" name="order_lokale" placeholder="Lokale" style="max-width: 70%">
							    </div>
						  </div>
						<div class="form-group">
							    <label for="order_shifts" class="">Antal eksamensvagter</label>
							    <div class="">
							      <input required type="number" class="form-control" min="1" id="order_shifts" name="order_shifts" placeholder="Antal" style="max-width: 70%">
							    </div>
						  </div>
						  <div class="form-group">
							    <label for="order_fag" class="">Fag</label>
							    <div class="">
							      <input type="text" style="max-width: 70%" class="form-control required" id="order_fag" name="order_fag" placeholder="Fag">
							    </div>
						  </div>
						  <div class="form-group">
							    <label for="order_fakultet" class="">Fakultet (Hvis relevant)</label>
							    <div class="">
							      <select class="form-control" id="order_fakultet" name="order_fakultet" style="max-width: 70%">
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
						</div>

						<div class="col-sm-12 col-md-6"> <!-- second column !-->
						  	<div class="form-group text-left">
							    <label for="order_start_time" class="">Vagt Starttidspunkt</label>
							    <div class="">
							      <select required class="form-control" id="order_start_time" name="order_start_time" style="max-width: 70%">
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
						  <div class="form-group text-left">
							    <label for="order_stop_time" class="">Vagt Sluttidspunkt</label>
							    <div class="">
							      <select required class="form-control" id="order_stop_time" name="order_stop_time" style="max-width: 70%">
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
						  <div class="form-group text-left">
							    <label for="order_kontakt" class="">Kontaktperson</label>
							    <div class="">
							      <select required class="form-control" id="order_kontakt" name="order_kontakt" style="max-width: 70%">
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
						  <div class="form-group text-left">
							    <label for="order_form" class="">Eksamensform</label>
							    <div class="" style="border-top: 1px solid gray; max-width: 70%; position: relative; top: -10px;">
							      <!--<select required class="form-control" id="order_form" name="order_form" style="max-width: 70%">
							      	<option value="">Select a form </option>
							      	<option value="Skriftlig">Skriftlig</option>
							      	<option value="Mundtlig">Mundtlig</option>
							      </select>!-->
							      <div class="radio_div mt-2">
								      <label>
								      <input type="radio" name="order_form" value="Mundtlig" class="required">
								      <div>Mundtlig</div>
								      <i class="fas fa-check"></i>
								      </label>
								  </div>
								  <div class="radio_div mt-2">
								      <label>
								      <input type="radio" name="order_form" value="Skriftlig" class="required">
								      <div>Skriftlig</div>
								      <i class="fas fa-check"></i>
								      </label>
								 </div>
							    </div>
						  </div>
						  	<div class="form-group text-left">
							    <label for="order_dokument" class="">Relevante dokumenter (Hvis relevant)</label>
							    <div class="">
							      <input type="file" class="form-control-file" name="order_dokument">
							    </div>
						  </div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-5 mb-3 text-left">
							 <button type="submit" class="form-control btn btn-light" id="submit" name="submit" value="" style="max-width: 85%">Send Bestilling <i class="fas fa-arrow-alt-circle-right"></i></button>
						 </div>
						 <div class="col-sm-12 col-md-1 text-left font-weight-bold" >
						 	Eller
						 </div>
						<div class="col-sm-12 col-md-5 text-left">
							      <button type="submit" class="form-control btn btn-warning" id="kladde" name="kladde"  style="max-width: 85%">Gem som kladde <i class="far fa-save"></i></button>
						  </div>
					</div>
						  <?php $stmt=null; ?>
					</form>
				</div>
			</div>
		</div>
	</div>


	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/insert.js"></script>
</body>
</html>
<?php 
	if (isset($_POST['submit'])) {
		$order_unformatted_date=$_POST['order_date'];
		$created_date=date_create($order_unformatted_date);
		$order_date=date_format($created_date, 'Y-m-d');
		
		$order_address=$_POST['order_address'];
		$order_meeting=$_POST['order_meeting'];
		$order_lokale=$_POST['order_lokale'];
		$order_start_time=$_POST['order_start_time'];
		$order_stop_time=$_POST['order_stop_time'];
		$order_shifts=$_POST['order_shifts'];
		$order_fag=$_POST['order_fag'];
		$order_fakultet=$_POST['order_fakultet'];
		$order_kontakt=$_POST['order_kontakt'];
		$order_form=$_POST['order_form'];
		$order_uge_nummer= date("W", strtotime($order_date));

		$stmt = $con->prepare('SELECT account_school FROM accounts WHERE account_code = :account_code');
	 	$stmt->bindParam(':account_code', $account_code);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$school_name = $row['account_school'];

		$order_dokument=$_FILES['order_dokument']['name'];
		$temp_order_document=$_FILES['order_dokument']['tmp_name'];

		$actual_name=pathinfo($order_dokument, PATHINFO_FILENAME);
		$extension=pathinfo($order_dokument, PATHINFO_EXTENSION);
		$i=1;

		if(!empty($order_dokument)){
		while (file_exists('dokumenter/' . $order_dokument)) {
			$order_dokument=$actual_name .'('.$i. ').' .$extension;
			$i++;
		}}

		move_uploaded_file($temp_order_document, "dokumenter/$order_dokument");


		$stmt=$con->prepare('INSERT INTO orders (order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_dokument, order_school, school_code) VALUES (:order_date, :order_uge_nummer, NOW(),  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_dokument, :order_school, :school_code)');
		$stmt->execute([
			'order_date'=>$order_date,
			'order_uge_nummer'=>$order_uge_nummer,
			'order_address'=>$order_address,
			'order_meeting'=>$order_meeting,
			'order_lokale'=>$order_lokale,
			'order_start_time'=>$order_start_time,
			'order_stop_time'=>$order_stop_time,
			'order_shifts'=>$order_shifts,
			'order_fag'=>$order_fag,
			'order_fakultet'=>$order_fakultet,
			'order_kontakt'=>$order_kontakt,
			'order_form'=>$order_form,
			'order_dokument'=>$order_dokument,
			'order_school'=>$school_name,
			'school_code'=>$account_code
		]);

		

		$count=$stmt->rowCount();

	if ($count>0) {
 		echo "<script>alert('Order has been sent')</script>";
 		$mail=new PHPMailer;
		$mail->SMTPDebug = 0;                               
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();            
		//Set SMTP host name                          
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;                           
		$mail->Username = "julian.costinea@gmail.com";                 
		$mail->Password = "kingstone";                           
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "TLS";                           
		//Set TCP port to connect to 
		$mail->Port = 587;          
		$mail->From="julian.costinea@gmail.com";
		$mail->FromName="GO:WORK Order System";
		$mail->addAddress("job@go-work.dk");
		$mail->isHTML(true);
		$mail->Subject = "A new order has been sent from $school_name.";
		$mail->Body = "$school_name has sent a new order <br>";
		$mail->Body.="Dato: $order_unformatted_date <br>";
		$mail->Body.="Ugenummer: $order_uge_nummer <br>";
		$mail->Body.="Amount of people needed: $order_shifts";
		$mail->Body.="<a href='https://go-work.dk/'><h4>Check it out<h4></a>";

		if(!$mail->send()) 
		{
		    echo "Mailer Error: " . $mail->ErrorInfo;
		    exit();
		} 
		else 
		{
		    echo "Message has been sent successfully";
		}
 		echo "<script>window.open('view_aktive_bestillinger.php','_self')</script>";
 	}
 	else{
 		echo "<script>alert('Could not send order. Try again!')</script>";
 	}
 	}
 	elseif (isset($_POST['kladde'])) {
		$order_unformatted_date=$_POST['order_date'];
		$created_date=date_create($order_unformatted_date);
		$order_date=date_format($created_date, 'Y-m-d');

		$order_address=$_POST['order_address'];
		$order_meeting=$_POST['order_meeting'];
		$order_lokale=$_POST['order_lokale'];
		$order_start_time=$_POST['order_start_time'];
		$order_stop_time=$_POST['order_stop_time'];
		$order_shifts=$_POST['order_shifts'];
		$order_fag=$_POST['order_fag'];
		$order_fakultet=$_POST['order_fakultet'];
		$order_kontakt=$_POST['order_kontakt'];
		$order_form=$_POST['order_form'];
		$order_uge_nummer= date("W", strtotime($order_date));

		$stmt = $con->prepare('SELECT account_school FROM accounts WHERE account_code = :account_code');
	 	$stmt->bindParam(':account_code', $account_code);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$school_name = $row['account_school'];

		$order_dokument=$_FILES['order_dokument']['name'];
		$temp_order_document=$_FILES['order_dokument']['tmp_name'];

		$actual_name=pathinfo($order_dokument, PATHINFO_FILENAME);
		$extension=pathinfo($order_dokument, PATHINFO_EXTENSION);
		$i=1;

		while (file_exists('dokumenter/' . $order_dokument)) {
			$order_dokument=$actual_name .'('.$i. ').' .$extension;
			$i++;
		}

		move_uploaded_file($temp_order_document, "dokumenter/$order_dokument");


		$stmt=$con->prepare('INSERT INTO klader (order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_dokument, order_school, school_code) VALUES (:order_date, :order_uge_nummer, NOW(),  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_dokument, :order_school, :school_code)');
		@$stmt->execute([
			'order_date'=>$order_date,
			'order_address'=>$order_address,
			'order_uge_nummer'=>$order_uge_nummer,
			'order_meeting'=>$order_meeting,
			'order_lokale'=>$order_lokale,
			'order_start_time'=>$order_start_time,
			'order_stop_time'=>$order_stop_time,
			'order_shifts'=>$order_shifts,
			'order_fag'=>$order_fag,
			'order_fakultet'=>$order_fakultet,
			'order_kontakt'=>$order_kontakt,
			'order_form'=>$order_form,
			'order_dokument'=>$order_dokument,
			'order_school'=>$school_name,
			'school_code'=>$account_code
		]);

		

		$count=$stmt->rowCount();

	if ($count>0) {
 		echo "<script>alert('Ordre gemt som kladde.')</script>";
 		echo "<script>window.open('view_kladder.php','_self')</script>";
 	}
 	else{
 		echo "<script>alert('Ordren kunne ikke gemmes!')</script>";
 	}
 }

 	
 ?>
