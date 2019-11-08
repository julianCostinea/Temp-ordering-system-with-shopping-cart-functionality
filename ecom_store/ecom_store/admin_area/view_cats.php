<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Categories</h1>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Category ID:</th>
								<th>Category Title</th>
								<th>Delete Category</th>
								<th>Edit Category</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_cats="select * from categories";
								$run_cats=mysqli_query($con,$get_cats);
								while ($row_cats=mysqli_fetch_array($run_cats)) {
									$cat_id=$row_cats['cat_id'];
									$cat_title=$row_cats['cat_title'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $cat_title; ?></td>
							 	<td><a href="index.php?delete_cat=<?php echo $cat_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">
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