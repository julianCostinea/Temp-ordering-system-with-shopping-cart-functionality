<?php
  session_start(); 
  include("db.php");
  if (!isset($_SESSION['client_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
  }
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
		<title>Kladder</title>
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
						<i class="fas fa-address-card"></i> Kladder 
						</h3>
						<?php 
						if(!empty($account_fakultet)){
							if (!isset($_GET['filter'])) {
							?>
							<a href="view_kladder.php?filter=all" type="button">Vis alle kladder</a>
							<?php } else{ 
								$original_fakultet=$account_fakultet;
								$account_fakultet=$_GET['filter'];
								?>
							<a href="view_kladder.php" type="button">Vis kun FAK: <?php echo $original_fakultet; ?> </a>
						<?php } } ?>
					</div>
					<div class="text-center float-right  mt-1">
						<form method="get" class="mt-2 search_form">
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
				  <form id="update_kladde" method="post" action="update_kladde.php">
					<div class="table-responsive" >
						<table class="table table-bordered table-striped text-white text-center" >
							<thead>
								<tr>
									<th><input type="checkbox" id="all_orders" name="all_orders"></th>
									<th>ID:</th>
									<th>Dato:</th>
									<th>Uge:</th>
									<th>Adresse:</th>
									<th>Mødested:</th>
									<th>Vagt Start:</th>
									<th>Vagt Stop:</th>
									<th>Tilsyn:</th>
									<th>Fag/Udd:</th>
									<th>Fak:</th>
									<th>Kontakt:</th>
									<th>Upload</th>
									<th>Form:</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php		
								if (!empty($_GET['search'])) {
										$search_field=$_GET['search'];
										$stmt=$con->prepare('SELECT * FROM klader WHERE order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale');
										$stmt->bindValue(':order_address', '%'.$search_field.'%');
										$stmt->bindValue(':order_school', '%'.$search_field.'%');
										$stmt->bindValue(':order_uge_nummer', '%'.$search_field.'%');
										$stmt->bindValue(':order_meeting', '%'.$search_field.'%');
										$stmt->bindValue(':order_fag', '%'.$search_field.'%');
										$stmt->bindValue(':order_fakultet', '%'.$search_field.'%');
										$stmt->bindValue(':order_kontakt', '%'.$search_field.'%');
										$stmt->bindValue(':order_form', '%'.$search_field.'%');
										$stmt->bindValue(':order_lokale', '%'.$search_field.'%');

									}
								else{	
									$sql='SELECT * FROM klader WHERE school_code = ?';
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
								$klade_id = $row['klade_id'];

								$sql_date = $row['order_date'];
								$created_date=date_create($sql_date);
	  							$order_date=date_format($created_date, 'd-m-Y');
	  							
								$order_uge_nummer = $row['order_uge_nummer'];
								$order_address = htmlspecialchars($row['order_address']);
								$order_meeting = htmlspecialchars($row['order_meeting']);
								$order_lokale=htmlspecialchars($row['order_lokale']);
								$order_meeting=$order_meeting . ' ' . $order_lokale;
								$order_start_time = $row['order_start_time'];
								$order_stop_time = $row['order_stop_time'];
								$order_shifts = $row['order_shifts'];
								$order_fag = htmlspecialchars($row['order_fag']);
								$order_fakultet = htmlspecialchars($row['order_fakultet']);
								$order_kontakt = htmlspecialchars($row['order_kontakt']);
								$order_dokument = $row['order_dokument'];
								$order_form = $row['order_form'];

								?>
								<tr>
									<td>
										<input type="checkbox" class="selected_orders" name="selected_orders[]" value="<?php echo $klade_id; ?>">
									</td>
									<td><?php echo $klade_id; ?></td>
									<td><?php echo $order_date; ?></td>
									<td><?php echo $order_uge_nummer; ?></td>
									<td><?php shortenText($order_address); ?></td>
									<td > <?php shortenText($order_meeting); ?> </td>
									<td> <?php echo $order_start_time; ?> </td>
									<td> <?php echo $order_stop_time; ?> </td>
									<td> <?php echo $order_shifts; ?> </td>
									<td><?php shortenText($order_fag); ?></td>
									<td> <?php echo $order_fakultet; ?> </td>
									<td><?php shortenText($order_kontakt); ?></td>
									<td>
											<?php if (!empty($order_dokument)) { ?><a target="_blank" href="pdfdokument.php?pdfdokument=<?php echo $order_dokument; ?>&iframe=1">PDF</a>
										<?php } ?>
									<td> <?php echo $order_form; ?> </td>
									<td>
											<a style="font-weight: bold; padding: 3px; margin-bottom: 3px;" class="text-success" href="edit_kladde.php?edit_kladde=<?php echo $klade_id; ?>"><i class="fas fa-edit"></i>
											</a> 
									</td>
								</tr>
								<?php }   ?>
							</tbody>
						</table>
						<?php
									$count=$stmt->rowCount();
									if ($count==0) {
										echo "<div class='alert alert-light mt-4 font-weight-bold' role='alert'>
										  Der er ingen kladder at vise!
										</div>";
									}

									?>
					</div>
					<input type="submit" name="delete_kladde" class="btn btn-sm btn-danger mt-1" value="Slet Kladde">
					<input type="submit" name="book_kladde" class="btn btn-sm btn-light mt-1" value="Send Til Booking">
				  </form>
				</div><!-- panel-body Ends -->
			</div><!-- panel panel-default Ends -->
		</div>
	<?php include_once 'footer.php'; ?>
	<?php include_once 'includes/scripts.php' ?>
</body>
</html>
