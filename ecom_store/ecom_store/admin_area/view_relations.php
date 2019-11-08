<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Relations</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Relation ID:</th>
								<th>Relation Title</th>
								<th>Relation Product</th>
								<th>Relation Bundle</th>
								<th>Delete Relation</th>
								<th>Edit Relation</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_relations="select * from bundle_product_relation";
								$run_relations=mysqli_query($con,$get_relations);
								while ($row_relations=mysqli_fetch_array($run_relations)) {
									$rel_id=$row_relations['rel_id'];
									$rel_title=$row_relations['rel_title'];
									$product_id=$row_relations['product_id'];
									$bundle_id=$row_relations['bundle_id'];

									$get_products="select * from products where product_id='$product_id'";
									$run_products=mysqli_query($con,$get_products);
									$row_products=mysqli_fetch_array($run_products);
									$product_title=$row_products['product_title'];

									$get_bundles="select * from products where product_id='$bundle_id'";
									$run_bundles=mysqli_query($con,$get_bundles);
									$row_bundles=mysqli_fetch_array($run_bundles);
									$bundle_title=$row_bundles['product_title'];
									$i++;
							 ?>
								 <tr>
								 	<td><?php echo $i; ?></td>
								 	<td><?php echo $rel_title; ?></td>
								 	<td><?php echo $product_title; ?></td>
								 	<td><?php echo $bundle_title; ?></td>
								 	<td><a href="index.php?delete_relation=<?php echo $rel_id; ?>">
								 		<i class="far fa-trash-alt"></i> Delete
								 	</a></td>
								 	<td><a href="index.php?edit_relation=<?php echo $rel_id; ?>">
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
</div>