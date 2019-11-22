<?php
  session_start(); 
  include("db.php");
  if (!isset($_SESSION['client_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
  }
  $sql="SELECT * FROM orders WHERE order_date < CURDATE()";
  $statement = $con->prepare($sql);
  $statement->execute();

  while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
  	$order_id=$row['order_id'];
  	$order_date=$row['order_date'];
  	$order_uge_nummer = $row['order_uge_nummer'];
    $order_send_date = $row['order_send_date'];
    $order_address = htmlspecialchars($row['order_address']);
	$order_meeting = htmlspecialchars($row['order_meeting']);
	$order_lokale = htmlspecialchars($row['order_lokale']);
	$order_start_time = $row['order_start_time'];
    $order_stop_time = $row['order_stop_time'];
	$order_shifts = $row['order_shifts'];
	$order_fag = htmlspecialchars($row['order_fag']);
	$order_fakultet = htmlspecialchars($row['order_fakultet']);
	$order_kontakt = htmlspecialchars($row['order_kontakt']);
	$order_form = $row['order_form'];
	$order_school = $row['order_school'];
	$school_code = $row['school_code'];

	$stmt=$con->prepare('INSERT INTO completed_orders (order_id, order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_school, school_code) VALUES (:order_id, :order_date, :order_uge_nummer, :order_send_date,  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_school, :school_code)');
          $stmt->execute([
          'order_id'=>$order_id,
          'order_date'=>$order_date,
          'order_address'=>$order_address,
          'order_meeting'=>$order_meeting,
          'order_uge_nummer'=>$order_uge_nummer,
          'order_lokale'=>$order_lokale,
          'order_send_date'=>$order_send_date,
          'order_start_time'=>$order_start_time,
          'order_stop_time'=>$order_stop_time,
          'order_shifts'=>$order_shifts,
          'order_fag'=>$order_fag,
          'order_fakultet'=>$order_fakultet,
          'order_kontakt'=>$order_kontakt,
          'order_form'=>$order_form,
          'order_school'=>$order_school,
          'school_code'=>$school_code
        ]);
  }

  $sql="DELETE FROM orders WHERE order_date < CURDATE()";
  $statement = $con->prepare($sql);
  $statement->execute();
 ?>
<?php 
 	$account_email=$_SESSION['client_email'];
 	$stmt = $con->prepare('SELECT account_code, account_fakultet FROM accounts WHERE account_email = :account_email');
 	$stmt->bindParam(':account_email', $account_email);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$account_code = $row['account_code'];	
	$account_fakultet = $row['account_fakultet'];

	include_once 'includes/functions.php';			
  ?>

<!DOCTYPE html>
<html>

	<head>
		<title>Aktive bestillinger</title>
		<link rel="icon" href="dokumenter/color.png" type="image/icon type">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php include_once 'includes/styles.php' ?>
	</head>

<body>
	<?php include_once 'header.php' ?>
		<div class="container-fluid">
			<div class="card text-white">
				<div class="card-header">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fas fa-address-card"></i> Aktive Ordrer
						</h3>
						<?php 
						if(!empty($account_fakultet)){
						if (!isset($_GET['nofilter'])) {
						?>
						<a href="view_aktive_bestillinger.php?nofilter=all" type="button">Vis alle ordrer</a>
						<?php } else{ 
							$original_fakultet=$account_fakultet;
							$account_fakultet=$_GET['nofilter'];
							?>
						<a href="view_aktive_bestillinger.php" type="button">Vis kun FAK: <?php echo $original_fakultet; ?> </a>
						<?php }} ?>
					</div>
					<div class="text-center float-right  mt-1">
						<form method="get" action="view_aktive_bestillinger.php" class="mt-2 search_form">
							<div class="input-group">
								<input type="text" class="form-control" id="search" name="search" placeholder="Search...	">
								<div class="input-group-append">
							    	<button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
							  	</div>
							</div>
						</form>
					</div>	
				</div>
				<div class="card-body">
					<div class="table-responsive" >
						<table class="table table-bordered table-striped text-white text-center" style="table-layout: fixed; width: 100%">
							<thead>
								<tr>
									<th>ID:</th>
									<th> Uge:</th>
									<th>Dato:</th>
									<th>Adresse:</th>
									<th>Mødested:</th>
									<th style="word-wrap: break-word">Vagt Starter:</th>
									<th style="word-wrap: break-word">Vagt Stopper:</th>
									<th>Tilsyn:</th>
									<th>Fag/Udd:</th>
									<th>Fak:</th>
									<th>Kontakt:</th>
									<th>Upload</th>
									<th>Form:</th>
								</tr>
							</thead>
							<tbody>
								<?php

									if (!empty($_GET['search'])) {
										$search_field=$_GET['search'];
										$stmt=$con->prepare('SELECT * FROM orders WHERE school_code = :school_code AND (order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale)');
										$stmt->bindValue(':order_address', '%'.$search_field.'%');
										$stmt->bindValue(':order_school', '%'.$search_field.'%');
										$stmt->bindValue(':order_uge_nummer', '%'.$search_field.'%');
										$stmt->bindValue(':order_meeting', '%'.$search_field.'%');
										$stmt->bindValue(':order_fag', '%'.$search_field.'%');
										$stmt->bindValue(':order_fakultet', '%'.$search_field.'%');
										$stmt->bindValue(':order_kontakt', '%'.$search_field.'%');
										$stmt->bindValue(':order_form', '%'.$search_field.'%');
										$stmt->bindValue(':order_lokale', '%'.$search_field.'%');
										$stmt->bindParam(':school_code', $account_code);
									}
									else{		
									$sql='SELECT * FROM orders WHERE school_code = ?';
									if(!empty($account_fakultet)){
										if ($account_fakultet!='all') {
											$sql.='AND order_fakultet=?';
											$filterfakultet=true;
										}
									}
									$sql.='ORDER BY order_date';
									$stmt = $con->prepare($sql);
								  	$stmt->bindParam(1, $account_code);
								  	if (isset($filterfakultet)) {
								  		$stmt->bindParam(2, $account_fakultet);
								  	}
									}

									$stmt->execute();
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									$order_id = $row['order_id'];
									$sql_date = $row['order_date'];
									$created_date=date_create($sql_date);
									$order_date=date_format($created_date, 'd-m-Y');
									$order_uge_nummer = $row['order_uge_nummer'];
									$order_address = htmlspecialchars($row['order_address']);
									$order_meeting = htmlspecialchars($row['order_meeting']);
									$order_lokale = htmlspecialchars($row['order_lokale']);
									$order_meeting=$order_meeting . ' ' . $order_lokale;
									$order_start_time = $row['order_start_time'];
									$order_stop_time = $row['order_stop_time'];
									$order_shifts = $row['order_shifts'];
									$order_fag = htmlspecialchars($row['order_fag']);
									$order_fakultet = htmlspecialchars($row['order_fakultet']);
									$order_kontakt = htmlspecialchars($row['order_kontakt']);
									$order_form = $row['order_form'];
									$order_dokument = $row['order_dokument'];

									?>
									<tr>
										<td><?php echo $order_id;?></td>
										<td> <?php echo $order_uge_nummer;  ?> </td>
										<td> <?php echo $order_date; ?>  </td>
										<td><?php shortenText($order_address); ?></td>
										<td><?php shortenText($order_meeting); ?></td>
										<td> <?php echo $order_start_time;?> </td>
										<td> <?php echo $order_stop_time;?>  </td>
										<td> <?php echo $order_shifts;?> </td>
										<td><?php shortenText($order_fag); ?></td>
										<td> <?php echo $order_fakultet;?> </td>
										<td><?php shortenText($order_kontakt); ?></td>
										<td>
											<?php if (!empty($order_dokument)) { ?><a target="_blank" href="pdfdokument.php?pdfdokument=<?php echo $order_dokument; ?>&iframe=1">PDF</a>
										<?php } ?>
										</td>
										<td><?php echo $order_form;?></td>
									</tr>
									<?php }; ?>
							</tbody>
						</table>
						<?php
									$count=$stmt->rowCount();
									if ($count==0) {
										echo "<div class='alert alert-light mt-4 font-weight-bold' role='alert'>
										  Der er ingen aktive ordrer lige nu!
										</div>";
									}
									?>
					</div>
				          <?php 
				          $stmt=null;
						  $con=null;
				           ?>
				</div><!-- panel-body Ends -->
			</div><!-- panel panel-default Ends -->
		</div>
			<?php include_once 'footer.php'; ?>
	<?php include_once 'includes/scripts.php'; ?>
</body>
</html>


