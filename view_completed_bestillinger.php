<?php
  session_start(); 
  include("db.php");
  if (!isset($_SESSION['client_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
  }
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
		<title>Fuldførte bestillinger</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php include_once 'includes/styles.php' ?>
	</head>

<body>
	<div class="row"><!-- 2 row Starts -->
		<div class="col-lg-12"><!-- col-lg-12 Starts -->
			<div class="card text-white">
				<div class="card-header">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fas fa-calendar-check"></i> Fuldførte Ordrer 
						</h3>
						<div class="icon_div" style="display: inline-block;">
							<a href="view_aktive_bestillinger.php" class="btn btn-success icon_link" style="min-width: 12rem;"><span class="icon_span" style="display: none;"><i class="fas fa-address-card"></i> </span> Aktive bestillinger </a>
						</div>
					</div>
					<div class="text-center float-right  mt-1">
						<div class="icon_div" style="display: inline-block;">
							<a href="logout.php" class="btn btn-secondary icon_link" style="min-width: 7rem;"><span class="icon_span" style="display: none;"><i class="fas fa-sign-out-alt"></i> </span> Log out </a>
						</div>
						<div class="icon_div" style="display: inline-block;">
							<a href="view_kladder.php" class="btn btn-warning text-right icon_link" style="min-width: 7.4rem;"> <span class="icon_span" style="display: none;"><i class="fas fa-list"></i></span> Se Klader </a>
						</div>
						<div class="icon_div" style="display: inline-block;">
							<a href="insert_bestilling.php" class="btn btn-dark text-right icon_link" style="min-width: 8rem;"> <span class="icon_span" style="display: none;"><i class="fas fa-plus-circle"></i></span> Opret ordre  </a>
						</div>
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
					<div class="table-responsive" >
						<table class="table table-bordered table-striped text-white text-center" >
							<thead>
								<tr>
									<th>Bestilling ID:</th>
									<th>Eksamen Ugenummer:</th>
									<th>Eksamen Dato:</th>
									<th>Adresse:</th>
									<th>Mødested:</th>
									<th>Vagten Starter:</th>
									<th>Vagten Stopper:</th>
									<th>Antal Tilsyn:</th>
									<th>Fag/Uddanelse:</th>
									<th>Fakultet:</th>
									<th>Kontaktperson:</th>
									<th>Eksamen Form:</th>
								</tr>
							</thead>
							<tbody>
								<?php	
								if (!empty($_GET['search'])) {
										$search_field=$_GET['search'];
										$stmt=$con->prepare('SELECT * FROM completed_orders WHERE school_code = :school_code AND (order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale)' );
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
								$stmt = $con->prepare('SELECT * FROM completed_orders WHERE school_code = :school_code ORDER BY order_date');
						      	$stmt->bindParam(':school_code', $account_code);
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
								$order_start_time = $row['order_start_time'];
								$order_stop_time = $row['order_stop_time'];
								$order_shifts = $row['order_shifts'];
								$order_fag = htmlspecialchars($row['order_fag']);
								$order_fakultet = htmlspecialchars($row['order_fakultet']);
								$order_kontakt = htmlspecialchars($row['order_kontakt']);
								$order_form = $row['order_form'];

								?>
								<tr>
									<td><?php echo $order_id; ?></td>
									<td><?php echo $order_uge_nummer; ?></td>
									<td style="min-width: 6.5rem;"><?php echo $order_date; ?></td>
									<td style="min-width: 11.5rem;"><?php echo $order_address; ?></td>
									<td> <?php echo $order_meeting . ' ' . $order_lokale; ?> </td>
									<td> <?php echo $order_start_time; ?> </td>
									<td> <?php echo $order_stop_time; ?> </td>
									<td> <?php echo $order_shifts; ?> </td>
									<td> <?php echo $order_fag; ?> </td>
									<td> <?php echo $order_fakultet; ?> </td>
									<td style="min-width: 17.5rem;"> <?php echo $order_kontakt; ?> </td>
									<td> <?php echo $order_form; ?> </td>
								</tr>
								<?php }   ?>
							</tbody>
						</table>
						<?php
									$count=$stmt->rowCount();
									if ($count==0) {
										echo "<div class='alert alert-light mt-4 font-weight-bold' role='alert'>
										  Der er ingen aktive ordrer lige nu!
										</div>";
									}
									$stmt=null;
									$con=null;
									?>
					</div>
				</div><!-- panel-body Ends -->
			</div><!-- panel panel-default Ends -->
		</div><!-- col-lg-12 Ends -->
	</div><!-- 2 row Ends -->

	<?php include_once 'includes/scripts.php' ?>
</body>
</html>
