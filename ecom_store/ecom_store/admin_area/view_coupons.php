<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Coupons</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Coupon ID:</th>
								<th>Coupon Title</th>
								<th>Product Title</th>
								<th>Coupon Price</th>
								<th>Coupon Code</th>
								<th>Coupon Limit</th>
								<th>Coupon Used</th>
								<th>Delete Coupon</th>
								<th>Edit Coupon</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_coupons="select * from coupons";
								$run_coupons=mysqli_query($con,$get_coupons);
								while ($row_coupons=mysqli_fetch_array($run_coupons)) {
									$coupon_id=$row_coupons['coupon_id'];
									$product_id=$row_coupons['product_id'];
									$coupon_title=$row_coupons['coupon_title'];
									$coupon_price=$row_coupons['coupon_price'];
									$coupon_code=$row_coupons['coupon_code'];
									$coupon_limit=$row_coupons['coupon_limit'];
									$coupon_used=$row_coupons['coupon_used'];

									$get_products="select * from products where product_id='$product_id'";
									$run_products=mysqli_query($con,$get_products);
									$row_products=mysqli_fetch_array($run_products);
									$product_title=$row_products['product_title'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $coupon_title; ?></td>
							 	<td><?php echo $product_title; ?></td>
							 	<td><?php echo "$". $coupon_price; ?></td>
							 	<td><?php echo $coupon_code; ?></td>
							 	<td><?php echo $coupon_limit; ?></td>
							 	<td><?php echo $coupon_used; ?></td>
							 	<td><a href="index.php?delete_coupon=<?php echo $coupon_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_coupon=<?php echo $coupon_id; ?>">
							 		<i class="far fa-edit"></i> Edit
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