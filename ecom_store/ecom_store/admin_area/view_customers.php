<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Customers</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped text-center black">
							<thead>
								<tr>
									<th>Customer No:</th>
									<th>Customer Name</th>
									<th>Customer Email</th>
									<th>Customer Image</th>
									<th>Customer Country</th>
									<th>Customer City</th>
									<th>Customer Phone Number</th>
									<th>Delete Customer</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i=0;
									$get_customers="select * from customers";
									$run_customers=mysqli_query($con,$get_customers);
									while ($row_customers=mysqli_fetch_array($run_customers)) {
										$customer_id=$row_customers['customer_id'];
										$customer_name=$row_customers['customer_name'];
										$customer_email=$row_customers['customer_email'];
										$customer_image=$row_customers['customer_image'];
										$customer_country=$row_customers['customer_country'];
										$customer_city=$row_customers['customer_city'];
										$customer_contact=$row_customers['customer_contact'];
										$i++;
								 ?>
								 <tr>
								 	<td><?php echo $i; ?></td>
								 	<td><?php echo $customer_name; ?></td>
								 	<td><?php echo $customer_email; ?></td>
								 	<td><img width="70" src="../customer/customer_images/<?php 
								 		echo $customer_image; ?>" ></td>
								 	<td><?php echo $customer_country; ?></td>
								 	<td><?php echo $customer_city; ?></td>
								 	<td><?php echo $customer_contact; ?></td>
								 	<td><a href="index.php?customer_delete=<?php echo $customer_id; ?>">
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