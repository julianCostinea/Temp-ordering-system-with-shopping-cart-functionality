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

	if (isset($_GET['amount'])) {
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
									<th style="word-wrap: break-word">Vagten Starter:</th>
									<th style="word-wrap: break-word">Vagten Stopper:</th>
									<th>Tilsyn:</th>
									<th>Fag/Udd:</th>
									<th>Fak:</th>
									<th>Kontakt:</th>
									<th>Form:</th>
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
										$stmt=$con->prepare('SELECT * FROM orders WHERE school_code = :school_code AND (order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale) LIMIT :start_from, :amount');
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
										$stmt->bindParam(':start_from',$start_from, PDO::PARAM_INT);
										$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
									}
									else{		
									

									$stmt = $con->prepare('SELECT * FROM orders WHERE school_code = ? ORDER BY order_date LIMIT ?, ?');
								  	$stmt->bindParam(1, $account_code);
								  	$stmt->bindParam(2, $start_from, PDO::PARAM_INT);
									$stmt->bindParam(3, $amount, PDO::PARAM_INT);
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
									$short_kontakt=substr($order_kontakt, 0,20);
									$long_kontakt=substr($order_kontakt, 20);
									$order_form = $row['order_form'];

									?>
									<tr>
										<td><?php echo $order_id;?></td>
										<td> <?php echo $order_uge_nummer;  ?> </td>
										<td> <?php echo $order_date; ?>  </td>
										<td><?php echo $order_address; ?>  </td>
										<td> <?php echo $order_meeting . ' ' . $order_lokale;?>   </td>
										<td> <?php echo $order_start_time;?> </td>
										<td> <?php echo $order_stop_time;?>  </td>
										<td> <?php echo $order_shifts;?> </td>
										<td> <?php echo $order_fag;?> </td>
										<td> <?php echo $order_fakultet;?> </td>
										<td> <span class='kontakt'><span class='short_text'><?php echo $short_kontakt;?> </span><span class='hidden'> <?php echo $long_kontakt;?></span></span></td>
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
					<div class="d-flex mr-5">
				        <ul class="pagination">
				          <?php 
                        if($amount!==2000){    
				            if (empty($_GET['search'])) {
				            $stmt = $con->prepare('SELECT * FROM orders WHERE school_code = ? ORDER BY order_date');
						    $stmt->bindParam(1, $account_code);
							}
							else{
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
						    $stmt->execute();
						    $total_records=$stmt->rowCount();
				            $total_pages=ceil($total_records/$amount);

				            $page_link="<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='view_aktive_bestillinger.php?page=1&amount=$amount";
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
				              	$page_link="<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='view_aktive_bestillinger.php?page=$i&amount=$amount";
				              	if (!empty($search_field)) {
				            	$page_link.="&search=$search_field";
					            }
					            $page_link.="'>";
				                echo $page_link . $i . "</a></li>
				                ";
				            	}  
				            };
				                $page_link="<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='view_aktive_bestillinger.php?page=$total_pages&amount=$amount";
					            if (!empty($search_field)) {
					            	$page_link.="&search=$search_field";
					            }
					            $page_link.="'>";
				              echo $page_link . 'Last Page' . "</a></li>
				              ";
				          $stmt=null;
						  $con=null;
                        }
				           ?>
				        </ul>
				    </div>
				</div><!-- panel-body Ends -->
			</div><!-- panel panel-default Ends -->
		</div>
			<?php include_once 'footer.php'; ?>
	<?php include_once 'includes/scripts.php'; ?>
</body>
</html>


