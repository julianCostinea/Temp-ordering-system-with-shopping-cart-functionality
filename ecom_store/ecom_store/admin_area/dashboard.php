<?php
  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
  }
 ?>
<div class="row mt-1 mx-1">
	<div class="col-lg-12">
		<h1>Dashboard</h1>
		<hr>
	</div>
</div>
<div class="row mx-1">
	<div class="col-lg-3 col-md-6 mb-2">
		<div class="card text-white bg-primary">
			<div class="card-header">
				<div class="row">
					<div class="col-xs-3">
						<i class="fas fa-tasks ml-2"></i>
					</div>
					<div class="col-xs-3 ml-auto mr-2">
						<div class="huge"><?php echo $count_products; ?></div>
						<div>Products</div>
					</div>
				</div>
			</div>
			<a href="index.php?view_products">
				<div class="card-footer bg-white">
					View Details <i class="fas fa-arrow-alt-circle-right"></i>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 mb-2">
		<div class="card text-white bg-success">
			<div class="card-header">
				<div class="row">
					<div class="col-xs-3">
						<i class="fas fa-comments ml-2"></i>
					</div>
					<div class="col-xs-3 ml-auto mr-2">
						<div class="huge"><?php echo $count_customers; ?></div>
						<div>Customers</div>
					</div>
				</div>
			</div>
			<a href="index.php?view_customers" style="color: #5cd85c;">
				<div class="card-footer bg-white">
					View Details <i class="fas fa-arrow-alt-circle-right"></i>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 mb-2">
		<div class="card text-white bg-warning">
			<div class="card-header">
				<div class="row">
					<div class="col-xs-3">
						<i class="fas fa-shopping-cart ml-2"></i>
					</div>
					<div class="col-xs-3 ml-auto mr-2">
						<div class="huge"><?php echo $count_p_categories; ?></div>
						<div>Product Categories</div>
					</div>
				</div>
			</div>
			<a href="index.php?view_p_cats" style="color: #f0ad4e;">
				<div class="card-footer bg-white">
					View Details <i class="fas fa-arrow-alt-circle-right"></i>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 mb-2">
		<div class="card text-white bg-danger">
			<div class="card-header">
				<div class="row">
					<div class="col-xs-3">
						<i class="fas fa-info-circle ml-2"></i>
					</div>
					<div class="col-xs-3 ml-auto mr-2">
						<div class="huge"><?php echo $count_pending_orders; ?></div>
						<div>Orders</div>
					</div>
				</div>
			</div>
			<a href="index.php?view_orders" style="color: #d9534f;">
				<div class="card-footer bg-white">
					View Details <i class="fas fa-arrow-alt-circle-right"></i>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="row mx-1 mt-2">
	<div class="col-md-8 ">
		<div class="card">
			<div class="card-header text-white bg-primary">
				<h3><i class="far fa-money-bill-alt"></i> New orders</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive text-center">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Order No:</th>
								<th>Customer Email</th>
								<th>Invoice No:</th>
								<th>Product ID:</th>
								<th>Product Qty</th>
								<th>Product Size</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_orders="select * from pending_orders order by 1 DESC 
								LIMIT 0, 5 ";
								$run_orders=mysqli_query($con, $get_orders);

								while($row_orders=mysqli_fetch_array($run_orders)){
									$order_id=$row_orders['order_id'];
									$c_id=$row_orders['customer_id'];
									$invoice_no=$row_orders['invoice_no'];
									$product_id=$row_orders['product_id'];
									$qty=$row_orders['qty'];
									$size=$row_orders['size'];
									$order_status=$row_orders['order_status'];
									$i++;
							?>
							<tr> 
								<td><?php echo $i; ?></td>
								<td><?php
									$get_customer="select * from customers where customer_id='$c_id'";
									$run_customer=mysqli_query($con,$get_customer);
									$row_customer=mysqli_fetch_array($run_customer);
									$customer_email=$row_customer['customer_email'];
									echo $customer_email;
								?></td>
								<td><?php echo $invoice_no; ?></td>
								<td><?php echo $product_id; ?></td>
								<td><?php echo $qty; ?></td>
								<td><?php echo $size; ?></td>
								<td><?php echo $order_status; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="text-right">
					<a href="index.php?view_orders"> View All Orders <i class="fas fa-arrow-alt-circle-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body text-left">
				<div class="thumb-info mb-md">
					<img src="admin_images/<?php echo $admin_image; ?>" class="img-fluid rounded">
					<div class="thumb-info-title">
						<span class="thumb-info-inner"><?php echo $admin_name; ?></span> <br>
						<span class="thumb-info-type"><?php echo $admin_job; ?></span>
					</div>
				</div> <br>
				<div class="mb-md">
					<div class="widget-content-expanded">
						<span>Email: </span> <?php echo $admin_email; ?> <br>
						<span>Country: </span> <?php echo $admin_country; ?> <br>
						<span>Contact: </span> <?php echo $admin_contact; ?> <br>
					</div>
					<hr>
					<h5 class="">About</h5>
					<p class="text-muted"><?php echo $admin_about; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>