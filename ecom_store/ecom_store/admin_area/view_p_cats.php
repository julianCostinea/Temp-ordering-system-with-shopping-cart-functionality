<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Product Categories</h1>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Product Category ID:</th>
								<th>Product Category Title</th>
								<th>Show Product Category on Top</th>
								<th>Delete Product Category</th>
								<th>Edit Product Category</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_p_cats="select * from product_categories";
								$run_p_cats=mysqli_query($con,$get_p_cats);
								while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
									$p_cat_id=$row_p_cats['p_cat_id'];
									$p_cat_title=$row_p_cats['p_cat_title'];
									$p_cat_top=$row_p_cats['p_cat_top'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $p_cat_title; ?></td>
							 	<td><?php echo $p_cat_top; ?></td>
							 	<td><a href="index.php?delete_p_cat=<?php echo $p_cat_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_p_cat=<?php echo $p_cat_id; ?>">
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