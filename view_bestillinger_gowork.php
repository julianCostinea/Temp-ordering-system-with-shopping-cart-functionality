<?php
	session_start(); 
	include("db.php");
	if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
?>
<?php if (isset($_GET['amount'])) {
				$amount=$_GET['amount'];
				if ($amount=='Alle') {
						$amount=2000;
					}	
			}
			else{
				$amount=2;
			}	
	?>
<!DOCTYPE html>
<html>

	<head>
		<title>GO:WORK Aktive ordrer</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php include_once 'includes/styles.php' ?>
	</head>

<body>
	<?php include_once 'header_gowork.php' ?>
	<div class="row"><!-- 2 row Starts -->
		<div class="col-lg-12"><!-- col-lg-12 Starts -->
			<div class="card text-white">
				<div class="card-header ">
					<div class="float-left">
						<h3 class="card-title">
						<i class="fa fa-money fa-fw"></i> GO:WORK Aktive Ordrer 
						</h3>
						<form action="insert_bestilling_gowork.php" method="post" style="display: inline-block;">
							<div class="form-group row">
								<select class="form-control col-sm-12 col-md-6" name="insert_client" required>
									<option value="">Select a customer</option>
									<?php				
											$sth = $con->prepare('SELECT account_school, account_code FROM accounts ORDER BY account_school');
											$sth->execute();
											while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
												$account_school = htmlspecialchars($row['account_school']);
												$account_code = htmlspecialchars($row['account_code']);
												echo "<option value=$account_code>$account_school</option>";
											}
										?>
								</select>
								<div class="col-sm-12 icon_div col-md-6">
									<button class="btn btn-light icon_link" type="submit" name="insert_bestilling_gowork" style="min-width: 10rem;"><span class="icon_span" style="display: none;"><i class="fas fa-plus-circle"></i> </span> Insert bestilling </button>
								</div>
							</div>
						</form>
						<div class="select_tag">
							Show
							<select name="amount_per_page" id="amount_per_page">
								<option <?php if ($amount==2) {
									echo 'selected';
								}  ?> >2</option>
								<option <?php if ($amount==50) {
									echo 'selected';
								}  ?>>50</option>
								<option <?php if ($amount==100) {
									echo 'selected';
								}  ?>>100</option>
								<option <?php if ($amount==2000) {
									echo 'selected';
								}  ?>>Alle</option>
							</select>
							results per page.
						</div>
					</div>
					<div class="text-center float-right  mt-1">
						<div class="icon_div" style="display: inline-block;">
							<a href="admin_logout.php" class="btn btn-secondary icon_link" style="min-width: 7rem;"><span class="icon_span" style="display: none;"><i class="fas fa-sign-out-alt"></i> </span> Log out </a>
						</div>
						<div class="icon_div" style="display: inline-block;">
							<a href="view_completed_bestillinger_gowork.php" class="btn btn-warning text-right icon_link" style="min-width: 13.4rem;"> <span class="icon_span" style="display: none;"><i class="fas fa-list"></i></span> Se Fuldførte Bestillinger </a>
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
					<form method="post" action="process_order.php">
						<div class="table-responsive" >
							<table class="table table-bordered table-striped text-white text-center mb-2" >
								<thead>
									<tr>
										<th><label class="container_checkbox" for="all_orders"><input type="checkbox" id="all_orders" name="all_orders"><span class="checkmark"></span></label></th>
										<th>ID:</th>
										<th>Eksamen Dato:</th>
										<th class="selectable_th">Uge:</th>
										<th>Bestilt af:</th>
										<th>Bestilt den:</th>
										<th>Adresse:</th>
										<th>Mødested:</th>
										<th>Vagten Starter:</th>
										<th>Vagten Stopper:</th>
										<th>Tilsyn:</th>
										<th>Fag:</th>
										<th>Fak/Uddanelse:</th>
										<th>Kontaktperson:</th>
										<th>Form:</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$page=1;
						            if (isset($_GET['page'])) {
						            	$page=$_GET['page'];
						            }					
						            $start_from=($page-1) * $amount;

									if (!empty($_GET['search'])) {
										$search_field=$_GET['search'];
										$stmt=$con->prepare('SELECT * FROM orders WHERE order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale LIMIT :start_from, :amount');
										$stmt->bindValue(':order_address', '%'.$search_field.'%');
										$stmt->bindValue(':order_school', '%'.$search_field.'%');
										$stmt->bindValue(':order_uge_nummer', '%'.$search_field.'%');
										$stmt->bindValue(':order_meeting', '%'.$search_field.'%');
										$stmt->bindValue(':order_fag', '%'.$search_field.'%');
										$stmt->bindValue(':order_fakultet', '%'.$search_field.'%');
										$stmt->bindValue(':order_kontakt', '%'.$search_field.'%');
										$stmt->bindValue(':order_form', '%'.$search_field.'%');
										$stmt->bindValue(':order_lokale', '%'.$search_field.'%');
										$stmt->bindParam(':start_from',$start_from, PDO::PARAM_INT);
										$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
									}
									else{		
									$stmt = $con->prepare('SELECT * FROM orders ORDER BY order_date LIMIT ?, ?');
									$stmt->bindParam(1, $start_from, PDO::PARAM_INT);
									$stmt->bindParam(2, $amount, PDO::PARAM_INT);
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
									$school_code = $row['school_code'];
									$order_start_time = $row['order_start_time'];
									$order_stop_time = $row['order_stop_time'];
									$order_shifts = $row['order_shifts'];
									$order_fag = htmlspecialchars($row['order_fag']);
									$order_fakultet = htmlspecialchars($row['order_fakultet']);
									$order_kontakt = htmlspecialchars($row['order_kontakt']);
									$short_kontakt=substr($order_kontakt, 0,20);
									$long_kontakt=substr($order_kontakt, 20);
									$order_form = $row['order_form'];

									?>
									<tr>
										<td style="min-width: 3rem;" class="checkbox_td">				
												<input type="checkbox" class="selected_orders" name="selected_orders[]" value="<?php echo $order_id; ?>">
										</td>
										<td><?php echo $order_id; ?></td>
										<td style="min-width: 6.5rem;"><?php echo $order_date; ?></td>
										<td><?php echo $order_uge_nummer; ?></td>
										<td style="max-width: 6.5rem;">
											<?php				
												$statement = $con->prepare('SELECT account_school FROM accounts WHERE account_code = :school_code');
												$statement->bindParam(':school_code', $school_code);
												$statement->execute();
												$row = $statement->fetch(PDO::FETCH_ASSOC);
												$school_name = $row['account_school'];
												echo $school_name;
											?>
										</td>
										<td style="min-width: 6.5rem;"><?php echo date('j-m-Y', strtotime($order_send_date)); ?></td>
										<td><?php echo $order_address; ?></td>
										<td style="min-width: 6.5rem;"> <?php echo $order_meeting . ' ' . $order_lokale; ?> </td>
										<td> <?php echo $order_start_time; ?> </td>
										<td> <?php echo $order_stop_time; ?> </td>
										<td> <?php echo $order_shifts; ?> </td>
										<td style="min-width: 6.5rem;"> <?php echo $order_fag; ?> </td>
										<td> <?php echo $order_fakultet; ?> </td>
										<td> <span class='kontakt'><span class='short_text'><?php echo $short_kontakt;?> </span><span class='hidden'> <?php echo $long_kontakt;?></span></span></td>
										<td> <?php echo $order_form; ?> </td>
										<td>
											<a style="font-weight: bold; padding: 3px; margin-bottom: 3px;" class="text-success" href="edit_bestilling.php?edit_bestilling=<?php echo $order_id; ?>">EDIT <i class="fas fa-edit"></i>
											</a>
										</td>
									</tr>
									<?php }; ?>
								</tbody>
							</table>
							<?php
									$count=$stmt->rowCount();
									if ($count==0) {
										echo "<div class='alert alert-light mt-4 font-weight-bold' role='alert'>
										  Ingen ordre blev fundet!
										</div>";
									}
									?>
						</div>
							<input type="submit" name="submit" class="btn btn-sm btn-light mt-1" value="Mark As Complete">
							<a href="export.php" class="btn btn-dark btn-sm mt-1" style="padding: 0.3rem">Export all</a>
							<input type="submit" name="export" class="btn btn-sm btn-dark mt-1" value="Export selected">
							<input type="submit" name="delete" class="btn btn-sm btn-light mt-1" value="Delete order">
						</form>
					<div class="d-flex mr-5">
				        <ul class="pagination mt-4">

				          <?php 
				            if (empty($_GET['search'])) {
				            $stmt = $con->prepare('SELECT * FROM orders ORDER BY order_date');
							}
							else{
								$stmt=$con->prepare('SELECT * FROM orders WHERE order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale');
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
						    $stmt->execute();
						    $total_records=$stmt->rowCount();
				            $total_pages=ceil($total_records/$amount);

				            	
				            $page_link="<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='view_bestillinger_gowork.php?page=1&amount=$amount";
				            if (!empty($search_field)) {
				            	$page_link.="&search=$search_field";
				            }
				            $page_link.="'>";

				              echo $page_link. 'First Page'. "</a></li>";
				              for($i=max(1, $page-2);$i<=min($page+2,$total_pages);$i++){
				              	if ($i==$page) {
				              		echo "
				                <li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link active'>". $i . "</a></li>
				                ";
				              	}else{
				              	$page_link="<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='view_bestillinger_gowork.php?page=$i&amount=$amount";
				              	if (!empty($search_field)) {
				            	$page_link.="&search=$search_field";
					            }
					            $page_link.="'>";
				                echo $page_link . $i . "</a></li>
				                ";
				            	}  
				            };
					            $page_link="<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='view_bestillinger_gowork.php?page=$total_pages&amount=$amount";
					            if (!empty($search_field)) {
					            	$page_link.="&search=$search_field";
					            }
					            $page_link.="'>";
				              echo $page_link . 'Last Page' . "</a></li>
				              ";
				          	
				          $stmt=null;
						  $con=null;
				           ?>
				        </ul>
				    </div>
				</div><!-- panel-body Ends -->
			</div><!-- panel panel-default Ends -->
		</div><!-- col-lg-12 Ends -->
	</div><!-- 2 row Ends -->

	<?php include_once 'includes/scripts_gowork.php' ?>
</body>
</html>
