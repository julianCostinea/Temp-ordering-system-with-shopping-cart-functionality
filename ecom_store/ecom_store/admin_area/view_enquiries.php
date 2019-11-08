<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Enquiries</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped text-center black">
							<thead>
							<tr>
								<th>Enquiry ID:</th>
								<th>Enquiry Title</th>
								<th>Delete Enquiry</th>
								<th>Edit Enquiry</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_enquiry="select * from enquiry_types";
								$run_enquiry=mysqli_query($con,$get_enquiry);
								while ($row_enquiry=mysqli_fetch_array($run_enquiry)) {
									$enquiry_id=$row_enquiry['enquiry_id'];
									$enquiry_title=$row_enquiry['enquiry_title'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $enquiry_title; ?></td>
							 	<td><a href="index.php?delete_enquiry=<?php echo $enquiry_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_enquiry=<?php echo $enquiry_id; ?>">
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