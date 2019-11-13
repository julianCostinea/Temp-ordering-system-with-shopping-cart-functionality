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

   	if (isset($_GET['edit_kladde'])) {
   		$edit_id=$_GET['edit_kladde'];
   		$stmt = $con->prepare('SELECT * FROM klader WHERE klade_id = :klade_id');
      	$stmt->bindParam(':klade_id', $edit_id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$sql_date = $row['order_date'];
		$created_date=date_create($sql_date);
	  	$order_date=date_format($created_date, 'd-m-Y');

		$order_send_date = $row['order_send_date'];
		$order_address = htmlspecialchars($row['order_address']);
		$order_meeting = htmlspecialchars($row['order_meeting']);
		$order_lokale = htmlspecialchars($row['order_lokale']);
		$order_start_time = $row['order_start_time'];
		$order_school = $row['order_school'];
		$order_stop_time = $row['order_stop_time'];
		$order_shifts = $row['order_shifts'];
		$order_fag = htmlspecialchars($row['order_fag']);
		$order_fakultet = htmlspecialchars($row['order_fakultet']);
		$order_kontakt = htmlspecialchars($row['order_kontakt']);
		$order_form = $row['order_form'];
		$order_original_dokument = htmlspecialchars($row['order_dokument']);
		$school_code = $row['school_code'];
   	}
 ?>
 <!DOCTYPE html>
<html>

	<head>
		<title>Edit kladde</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="https://kit.fontawesome.com/ee17b9c6d0.js" crossorigin="anonymous"></script>
		<link href="css/style.css" rel="stylesheet">
	</head>

<body>
	<?php include_once 'header.php' ?>
  <div class="container" style="min-width: 90%">
	<div class="row"><!-- 2 row Starts -->
		<div class="col-md-12"><!-- col-lg-12 Starts -->
			<div class="card text-white">
				<div class="card-header">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fa fa-money fa-fw"></i> <span style="text-decoration: underline;">Edit kladde</span> &nbsp;&nbsp; Klade ID:  <?php echo $edit_id; ?> 
						</h3>
					</div>
				</div>
				<div class="card-body text-center" style="font-size: 1.2rem">
					<form autocomplete="off" method="post" enctype="multipart/form-data" class="ml-5">
							<div class="form-group row">
							    <label for="order_date" class="col-md-12 col-lg-2 col-form-label">Eksamensdato</label>
							    <div class="col-md-7 col-lg-3">
							      <input type="text" required value="<?php echo $order_date; ?>" class="form-control" id="order_date" name="order_date" placeholder="Dato">
							    </div>
						  	</div>
						  <div class="form-group row">
							    <label for="order_address" class="col-md-12 col-lg-2 col-form-label">Adresse</label>
							    <div class="col-md-7 col-lg-3">
							      <select class="form-control" name="order_address" required>
							      	<option selected value="<?php echo $order_address; ?>"><?php echo $order_address . " (selected)"; ?></option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_address FROM school_info WHERE school_code = :school_code AND school_address != :school_address AND school_address != ''");
							      	$stmt->bindParam(':school_code', $school_code);
							      	$stmt->bindParam(':school_address', $order_address);
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
							      	<option selected value="<?php echo $order_meeting; ?>"><?php echo $order_meeting . " (selected)"; ?></option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_meeting FROM school_info WHERE school_code = :school_code AND school_meeting != :school_meeting AND school_meeting != ''");
							      	$stmt->bindParam(':school_code', $school_code);
							      	$stmt->bindParam(':school_meeting', $order_meeting);
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
							    <label for="order_lokale" class="col-md-12 col-lg-2 col-form-label">Eksamen Lokale</label>
							    <div class="col-md-7 col-lg-3">
							      <input value="<?php echo $order_lokale; ?>" type="text" class="form-control" id="order_lokale" name="order_lokale" placeholder="Lokale">
							    </div>
						  </div>
						<div class="form-group row">
							    <label for="order_shifts" class="col-md-12 col-lg-2 col-form-label">Antal eksamensvagter</label>
							    <div class="col-md-7 col-lg-3">
							      <input required type="number" value="<?php echo $order_shifts; ?>" class="form-control" min="1" id="order_shifts" name="order_shifts" placeholder="Antal">
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_fag" class="col-md-12 col-lg-2 col-form-label">Fag</label>
							    <div class="col-md-7 col-lg-3">
							      <input type="text" value="<?php echo $order_fag; ?>" class="form-control required" id="order_fag" name="order_fag" placeholder="Fag">
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_fakultet" class="col-md-12 col-lg-2 col-form-label">Fakultet (Hvis relevant)</label>
							    <div class="col-md-7 col-lg-3">
							      <select class="form-control" id="order_fakultet" name="order_fakultet" style="max-width: 70%">
							      	<option selected value="<?php echo $order_fakultet; ?>"><?php echo $order_fakultet . " (selected)"; ?></option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_fakultet FROM school_info WHERE school_code = :school_code AND school_fakultet != :school_fakultet AND school_fakultet !='' ORDER BY school_fakultet");
							      	$stmt->bindParam(':school_code', $school_code);
							      	$stmt->bindParam(':school_fakultet', $order_fakultet);
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
							    <label for="order_start_time" class="col-md-12 col-lg-2 col-form-label">Vagt Starttidspunkt</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_start_time" name="order_start_time">
							      	<option selected value="<?php echo $order_start_time; ?>"><?php echo $order_start_time . " (selected)"; ?></option>
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
							    <label for="order_stop_time" class="col-md-12 col-lg-2 col-form-label">Vagt Sluttidspunkt</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_stop_time" name="order_stop_time">
							      	<option selected value="<?php echo $order_stop_time; ?>"><?php echo $order_stop_time . " (selected)"; ?></option>
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
							    <label for="order_kontakt" class="col-md-12 col-lg-2 col-form-label">Kontaktperson</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_kontakt" name="order_kontakt">
							      	<option selected value="<?php echo $order_kontakt; ?>"><?php echo $order_kontakt . " (selected)"; ?></option>
							      	<?php
							      	$stmt = $con->prepare("SELECT school_kontakt FROM school_info WHERE school_code = :school_code AND school_kontakt != :school_kontakt AND school_kontakt !=''");
							      	$stmt->bindParam(':school_code', $school_code);
							      	$stmt->bindParam(':school_kontakt', $order_kontakt);
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
							    <label for="order_form" class="col-md-12 col-lg-2 col-form-label">Eksamensform</label>
							    <div class="col-md-7 col-lg-3">
							      <select required class="form-control" id="order_form" name="order_form">
							      	<?php if ($order_form=="SKR") {
							      		echo '
							      	<option selected value="SKR">Skriftlig</option>
							      	<option value="MDT">Mundtlig</option>
							      	';}
							      		else{
							      			echo '
							      	<option value="SKR">Skriftlig</option>
							      	<option selected value="MDT">Mundtlig</option>
							      	';
							      		}
							      	 ?>
							      </select>
							    </div>
						  </div>
						  <div class="form-group row">
							    <label for="order_dokument" class="col-md-12 col-lg-2 col-form-label">Relevante dokumenter (Hvis relevant)</label>
							    <div class="col-md-7 col-lg-3">
							      <input type="file" class="form-control-file" name="order_dokument" accept="application/pdf">
							      <span class="float-left" style="font-size: 0.6rem">Accepteret filtype: .pdf</span>
							    </div>
						  </div>
						  <div class="text-left" style="font-size: 0.9rem;">
					    	<p class="text-warning">Tidligere upload: <?php echo $order_original_dokument; ?></p>
					    </div>
					<div class="form-group row">
						<label for="submit" class="col-lg-2 col-form-label"></label>
						<div class="col-md-7 col-lg-3 text-left">
							 <button type="submit" class="form-control btn btn-sm btn-warning" id="update" name="update" value="">Opdater Kladde <i class="fas fa-arrow-alt-circle-right"></i></button>
						 </div>
					</div>
					<div class="form-group row">
						<label for="" class="col-lg-2 col-form-label"></label>	 
						<div class="col-md-7 col-lg-3 text-left">
							 <button type="submit" class="form-control btn btn-sm btn-light" id="send_order" name="send_order">Send Ordre <i class="fas fa-plus-circle"></i></button>
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
<?php 
	if (isset($_POST['update'])) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['order_dokument']['tmp_name']);

		$order_unformatted_date=$_POST['order_date'];
		$created_date=date_create($order_unformatted_date);
		$order_date=date_format($created_date, 'Y-m-d');
		
		$order_uge_nummer= date("W", strtotime($order_date));
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

		$order_dokument=$_FILES['order_dokument']['name'];
		$temp_order_document=$_FILES['order_dokument']['tmp_name'];
		if(!empty($order_dokument)){
			if ($mime!=='application/pdf') {
			       die("<script>alert('Man må kun uploade .pdf filer!')</script>");   
			}
		}

		if (empty($order_dokument)) {
			$order_dokument=$order_original_dokument;
		}
		else{
		$actual_name=pathinfo($order_dokument, PATHINFO_FILENAME);
		$extension=pathinfo($order_dokument, PATHINFO_EXTENSION);
		$i=1;

		while (file_exists('dokumenter/' . $order_dokument)) {
			$order_dokument=$actual_name .'('.$i. ').' .$extension;
			$i++;
		}

		move_uploaded_file($temp_order_document, "dokumenter/$order_dokument");
		}


		$stmt=$con->prepare('UPDATE klader SET order_date= :order_date, order_uge_nummer=:order_uge_nummer, order_address= :order_address, order_meeting= :order_meeting, order_lokale= :order_lokale, order_start_time= :order_start_time, order_stop_time= :order_stop_time, order_shifts= :order_shifts, order_fag= :order_fag, order_fakultet= :order_fakultet, order_kontakt= :order_kontakt, order_dokument= :order_dokument, order_form= :order_form WHERE klade_id= :order_id');
		$stmt->execute([
			'order_date'=>$order_date,
			'order_uge_nummer'=>$order_uge_nummer,
			'order_id'=>$edit_id,
			'order_address'=>$order_address,
			'order_meeting'=>$order_meeting,
			'order_lokale'=>$order_lokale,
			'order_start_time'=>$order_start_time,
			'order_stop_time'=>$order_stop_time,
			'order_shifts'=>$order_shifts,
			'order_fag'=>$order_fag,
			'order_fakultet'=>$order_fakultet,
			'order_dokument'=>$order_dokument,
			'order_kontakt'=>$order_kontakt,
			'order_form'=>$order_form
		]);

		

		$count=$stmt->rowCount();

	if ($count>0) {
		echo "<script>alert('Kladden er blevet redigeret.')</script>";
 		echo "<script>window.open('view_kladder.php','_self')</script>";
 	}
 	else{
 		echo "<script>alert('Kladde kunne ikke opdateres. Try again!')</script>";
 	}

 	}

 	elseif (isset($_POST['send_order'])) {
 		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['order_dokument']['tmp_name']);

 		$order_unformatted_date=$_POST['order_date'];
		$created_date=date_create($order_unformatted_date);
		$order_date=date_format($created_date, 'Y-m-d');
		
		$order_uge_nummer= date("W", strtotime($order_date));
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

		$order_dokument=$_FILES['order_dokument']['name'];
		$temp_order_document=$_FILES['order_dokument']['tmp_name'];
		if(!empty($order_dokument)){
			if ($mime!=='application/pdf') {
			       die("<script>alert('Man må kun uploade .pdf filer!')</script>");   
			}
		}

		if (empty($order_dokument)) {
			$order_dokument=$order_original_dokument;
		}
		else{
		$actual_name=pathinfo($order_dokument, PATHINFO_FILENAME);
		$extension=pathinfo($order_dokument, PATHINFO_EXTENSION);
		$i=1;

		while (file_exists('dokumenter/' . $order_dokument)) {
			$order_dokument=$actual_name .'('.$i. ').' .$extension;
			$i++;
		}

		move_uploaded_file($temp_order_document, "dokumenter/$order_dokument");
		}
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
			'order_school'=>$order_school,
			'school_code'=>$school_code
		]);

		$count=$stmt->rowCount();

		if ($count>0) {
 		echo "<script>alert('Order has been sent')</script>";
 		$mail=new PHPMailer;
		$mail->SMTPDebug = 2;                               
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';            
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
		$mail->Subject = "A new order has been sent from $order_school.";
		$mail->Body = "$order_school has sent a new order <br>";
		$mail->Body.="Dato: $order_unformatted_date <br>";
		$mail->Body.="Ugenummer: $order_uge_nummer <br>";
		$mail->Body.="Amount of people needed: $order_shifts";
		$mail->Body.="<a href='https://go-work.dk/'><h4>Check it out<h4></a>";

		if(!$mail->send()) 
		{
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
		    echo "Message has been sent successfully";
		}
 		//echo "<script>window.open('view_kladder.php','_self')</script>";
 	}
 	else{
 		echo "<script>alert('Could not send order. Try again!')</script>";
 		}

 	}
 ?>
