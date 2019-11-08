<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Icons</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Icon ID:</th>
								<th>Icon Title</th>
								<th>Icon Product</th>
								<th>Icon Image</th>
								<th>Delete Coupon</th>
								<th>Edit Coupon</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_icons="select * from icons";
								$run_icons=mysqli_query($con,$get_icons);
								while ($row_icons=mysqli_fetch_array($run_icons)) {
									$icon_id=$row_icons['icon_id'];
									$icon_title=$row_icons['icon_title'];
									$product_id=$row_icons['icon_product'];
									$icon_image=$row_icons['icon_image'];

									$get_products="select * from products where product_id='$product_id'";
									$run_products=mysqli_query($con,$get_products);
									$row_products=mysqli_fetch_array($run_products);
									$product_title=$row_products['product_title'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $icon_title; ?></td>
							 	<td><?php echo $product_title; ?></td>
							 	<td><img src="icon_images/<?php echo $icon_image; ?>" width="50" height="50"></td>
							 	<td><a href="index.php?delete_icon=<?php echo $icon_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_icon=<?php echo $icon_id; ?>">
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