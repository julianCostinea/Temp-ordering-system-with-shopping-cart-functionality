<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Payments</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped text-center black">
							<thead>
								<tr>
									<th>Payment No:</th>
									<th>Invoice No:</th>
									<th>Amount Paid</th>
									<th>Payment Method</th>
									<th>Reference No:</th>
									<th>Payment Code</th>
									<th>Payment Date</th>
									<th>Delete payment</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i=0;
									$get_payments="select * from payments";
									$run_payments=mysqli_query($con,$get_payments);
									while ($row_payments=mysqli_fetch_array($run_payments)) {
										$payment_id=$row_payments['payment_id'];
										$invoice_no=$row_payments['invoice_no'];
										$amount=$row_payments['amount'];
										$payment_mode=$row_payments['payment_mode'];
										$ref_no=$row_payments['ref_no'];
										$code=$row_payments['code'];
										$payment_date=$row_payments['payment_date'];
										$i++;
								 ?>
								 <tr>
								 	<td><?php echo $i; ?></td>
								 	<td><?php echo $invoice_no; ?></td>
								 	<td>$<?php echo $amount; ?></td>
								 	<td><?php echo $payment_mode; ?></td>
								 	<td><?php echo $ref_no; ?></td>
								 	<td><?php echo $code; ?></td>
								 	<td><?php echo $payment_date; ?></td>
								 	<td><a href="index.php?payment_delete=<?php echo $payment_id; ?>">
								 		<i class="far fa-trash-alt"></i> Delete
								 	</a></td>
								 </tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>