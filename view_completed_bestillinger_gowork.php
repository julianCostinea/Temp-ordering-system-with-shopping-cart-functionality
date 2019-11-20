<?php
	session_start(); 
	include("db.php");
	if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
    exit();
  }
  include_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html>

	<head>
		<title>GO:WORK Fuldførte ordrer</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php include_once 'includes/styles.php' ?>
	</head>

<body>
	<?php include_once 'header_gowork.php' ?>
	<div class="container-fluid">
			<div class="card text-white">
				<div class="card-header">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fa fa-money fa-fw"></i> GO:WORK Fuldførte Ordrer 
						</h3>
						<form action="insert_bestilling_gowork.php" method="post">
							<div class="form-group row">
								<select class="form-control col-sm-12 col-md-6" name="insert_client" required>
									<option value="">Select a customer</option>
									<?php				
											$sth = $con->prepare('SELECT account_school, account_code FROM accounts');
											$sth->execute();
											while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
												$account_school = htmlspecialchars($row['account_school']);
												$account_code = htmlspecialchars($row['account_code']);
												echo "<option value=$account_code>$account_school</option>";
											}
										?>
								</select>
								<div class="col-sm-12 icon_div col-md-6">
									<button class="btn btn-sm btn-light icon_link" type="submit" name="insert_bestilling_gowork" style="min-width: 10rem;"><span class="icon_span" style="display: none;"><i class="fas fa-plus-circle"></i> </span> Insert bestilling </button>
								</div>
							</div>
						</form>
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
					<form id="delete_form" method="post" action="delete_bestilling.php">
					<div class="table-responsive" >
						<table class="table table-bordered table-striped text-white text-center" >
							<thead>
								<tr>
									<th><label class="container_checkbox" for="all_orders"><input type="checkbox" id="all_orders" name="all_orders"><span class="checkmark"></span></label></th>
									<th>ID:</th>
									<th>Dato:</th>
									<th>Uge:</th>
									<th>Bestilt af:</th>
									<th>Sendt den:</th>
									<th>Adresse:</th>
									<th>Mødested:</th>
									<th>Vagt Starter:</th>
									<th>Vagt Stopper:</th>
									<th>Tilsyn:</th>
									<th>Fag/Udd:</th>
									<th>Fak:</th>
									<th>Kontakt:</th>
									<th>Form:</th>
								</tr>
							</thead>
							<tbody>
								<?php		
								if (!empty($_GET['search'])) {
										$search_field=$_GET['search'];
										$stmt=$con->prepare('SELECT * FROM completed_orders WHERE order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale');
										$stmt->bindValue(':order_address', '%'.$search_field.'%');
										$stmt->bindValue(':order_school', '%'.$search_field.'%');
										$stmt->bindValue(':order_meeting', '%'.$search_field.'%');
										$stmt->bindValue(':order_fag', '%'.$search_field.'%');
										$stmt->bindValue(':order_fakultet', '%'.$search_field.'%');
										$stmt->bindValue(':order_kontakt', '%'.$search_field.'%');
										$stmt->bindValue(':order_form', '%'.$search_field.'%');
										$stmt->bindValue(':order_lokale', '%'.$search_field.'%');
									}
								else{							
								$stmt = $con->prepare('SELECT * FROM completed_orders ORDER BY order_date');
								}		
								$stmt->execute();
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								$order_id = $row['order_id'];
								$order_uge_nummer = $row['order_uge_nummer'];

								$sql_date = $row['order_date'];
								$created_date=date_create($sql_date);
	  							$order_date=date_format($created_date, 'd-m-Y');

								$order_send_date = $row['order_send_date'];
								$order_address = htmlspecialchars($row['order_address']);
								$order_meeting = htmlspecialchars($row['order_meeting']);
								$order_lokale = htmlspecialchars($row['order_lokale']);
								$order_meeting=$order_meeting . ' ' . $order_lokale;
								$school_code = $row['school_code'];
								$order_start_time = $row['order_start_time'];
								$order_stop_time = $row['order_stop_time'];
								$order_shifts = $row['order_shifts'];
								$order_fag = htmlspecialchars($row['order_fag']);
								$order_fakultet = htmlspecialchars($row['order_fakultet']);
								$order_kontakt = htmlspecialchars($row['order_kontakt']);
								$order_form = $row['order_form'];
								?>
								<tr>
									<td class="checkbox_td">
										<input type="checkbox" name="selected_orders[]" class="selected_orders" value="<?php echo $order_id; ?>">
									</td>
									<td><?php echo $order_id; ?></td>
									<td><?php echo $order_date; ?></td>
									<td><?php echo $order_uge_nummer; ?></td>
									<td>
										<?php				
											$statement = $con->prepare('SELECT account_school FROM accounts WHERE account_code = :school_code');
											$statement->bindParam(':school_code', $school_code);
											$statement->execute();
											$row = $statement->fetch(PDO::FETCH_ASSOC);
											$school_name = $row['account_school'];
											shortenText($school_name);
										?>
									</td>
									<td><?php echo date('j-m-Y', strtotime($order_send_date)); ?></td>
									<td><?php shortenText($order_address); ?></td>
									<td> <?php shortenText($order_meeting); ?> </td>
									<td> <?php echo $order_start_time; ?> </td>
									<td> <?php echo $order_stop_time; ?> </td>
									<td> <?php echo $order_shifts; ?> </td>
									<td> <?php shortenText($order_fag); ?> </td>
									<td> <?php echo $order_fakultet; ?> </td>
									<td> <?php shortenText($order_kontakt); ?> </td>
									<td> <?php echo $order_form; ?> </td>
								</tr>
								<?php } ;?>
							</tbody>
						</table>
						<?php
									$count=$stmt->rowCount();
									if ($count==0) {
										echo "<div class='alert alert-light mt-4 font-weight-bold' role='alert'>
										  Ingen ordre blev fundet!
										</div>";
									}
									$stmt=null;
									$con=null;
									?>
					</div>
					<input type="submit" name="submit" form="delete_form" class="btn btn-sm btn-danger " value="Delete Order(s)">
					</form>
				</div><!-- panel-body Ends -->
			</div><!-- panel panel-default Ends -->
	</div><!-- container fluid ends -->
<?php include_once 'footer.php'; ?>
	<?php include_once 'includes/scripts.php' ?>
</body>
</html>
