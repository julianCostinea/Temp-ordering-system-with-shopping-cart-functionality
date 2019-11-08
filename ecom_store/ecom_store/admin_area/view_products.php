<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Products</h1>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Product no:</th>
								<th>Product Title</th>
								<th>Product Image</th>
								<th>Product Price</th>
								<th>Times Sold</th>
								<th>Product Keywords</th>
								<th>Product Date</th>
								<th>Product Delete</th>
								<th>Product Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_products="select * from products where status='product'";
								$run_products=mysqli_query($con,$get_products);
								while ($row_products=mysqli_fetch_array($run_products)) {
									$pro_id=$row_products['product_id'];
									$pro_title=$row_products['product_title'];
									$pro_price=$row_products['product_price'];
									$pro_image=$row_products['product_img1'];
									$pro_keywords=$row_products['product_keywords'];
									$pro_date=$row_products['date'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $pro_title; ?></td>
							 	<td><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"></td>
							 	<td><?php echo $pro_price; ?></td>
							 	<td><?php 
							 		$get_sold="select * from pending_orders where product_id='$pro_id'";
							 		$run_sold=mysqli_query($con,$get_sold);
							 		$count_sold=mysqli_num_rows($run_sold);
							 		echo $count_sold;
							 		?>
							 	</td>
							 	<td><?php echo $pro_keywords; ?></td>
							 	<td><?php echo $pro_date; ?></td>
							 	<td><a href="index.php?delete_product=<?php echo $pro_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_product=<?php echo $pro_id; ?>">
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