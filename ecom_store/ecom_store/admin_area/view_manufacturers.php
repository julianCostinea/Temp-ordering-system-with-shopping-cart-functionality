<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Manufacturers</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped text-center black">
							<thead>
								<tr>
									<th>Manufacturer ID:</th>
									<th>Manufacturer Name</th>
									<th>Delete Manufacturer</th>
									<th>Edit Manufacturer</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i=0;
								  	$get_manufacturer="select * from manufacturers";
								  	$run_manufacturer=mysqli_query($con,$get_manufacturer);
								  	while ($row_manufacturer=mysqli_fetch_array($run_manufacturer)) {
								  		$manufacturer_id=$row_manufacturer['manufacturer_id'];
								  		$manufacturer_title=$row_manufacturer['manufacturer_title'];
										$i++;
								 ?>
								 <tr>
								 	<td><?php echo $i; ?></td>
								 	<td><?php echo $manufacturer_title; ?></td>
								 	<td><a href="index.php?delete_manufacturer=<?php echo $manufacturer_id; ?>">
								 		<i class="far fa-trash-alt"></i> Delete
								 	</a></td>
 						 			<td><a class="" href="index.php?edit_manufacturer=<?php echo $manufacturer_id; ?>"> 
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