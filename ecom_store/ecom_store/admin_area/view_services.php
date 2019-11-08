<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Services</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<?php
						$get_services="select * from services";
			          	 $run_services=mysqli_query($con,$get_services);
			          	 while ($row_services=mysqli_fetch_array($run_services)) {
			          	 	$service_id=$row_services['service_id'];
			          	 	$service_title=$row_services['service_title'];
			          	 	$service_image=$row_services['service_image'];
			          	 	$service_desc=substr($row_services['service_desc'],0,120);
			          	 	$service_button=$row_services['service_button'];
			          	 	$service_url=$row_services['service_url'];
					 ?>
					 <div class="col-md-4">
					 	<div class="card text-white bg-primary">
					 		<div class="card-header">
					 			<h3 class="card-title"><?php echo $service_title; ?></h3>
					 		</div>
					 		<div class="card-body bg-light text-dark">
					 			<img class="img-fluid" src="services_images/<?php echo $service_image; ?>">
					 			<br>
					 			<p><?php echo $service_desc; ?></p>
					 		</div>
					 		<div class="card-footer bg-light">
					 			<a class="float-left" href="index.php?delete_service=<?php echo $service_id; ?>"> 
					 				<i class="far fa-trash-alt"></i> Delete </a>
					 			<a class="float-right" href="index.php?edit_service=<?php echo $service_id; ?>"> 
					 				<i class="far fa-edit"></i> Edit </a>
					 		</div>
					 	</div>
					 </div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>