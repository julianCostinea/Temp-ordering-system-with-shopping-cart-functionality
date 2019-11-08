<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Admins</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped text-center black">
							<thead>
								<tr>
									<th>Admin Name</th>
									<th>Admin Email</th>
									<th>Admin Image</th>
									<th>Admin Country</th>
									<th>Admin Job</th>
									<th>Delete Administrator</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$get_admins="select * from admins";
									$run_admins=mysqli_query($con,$get_admins);
									while ($row_admins=mysqli_fetch_array($run_admins)) {
										$admin_id=$row_admins['admin_id'];
										$admin_name=$row_admins['admin_name'];
										$admin_email=$row_admins['admin_email'];
										$admin_image=$row_admins['admin_image'];
										$admin_country=$row_admins['admin_country'];
										$admin_job=$row_admins['admin_job'];
								 ?>
								 <tr>
								 	<td><?php echo $admin_name; ?></td>
								 	<td><?php echo $admin_email; ?></td>
								 	<td><img width="70" src="admin_images/<?php 
								 		echo $admin_image; ?>" ></td>
								 	<td><?php echo $admin_country; ?></td>
								 	<td><?php echo $admin_job; ?></td>
								 	<td><a href="index.php?user_delete=<?php echo $admin_id; ?>">
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