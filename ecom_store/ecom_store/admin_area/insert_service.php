<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Service</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="service_title" class="col-md-2 col-form-label">Service Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="service_title" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_image" class="col-md-2 col-form-label">Service Image</label>
					    <div class="col-md-6">
					      <input type="file" class="" name="service_image" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_desc" class="col-md-2 col-form-label">Service Description</label>
					    <div class="col-md-6">
					      <textarea name="service_desc" class="form-control" style="resize: none;"></textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_button" class="col-md-2 col-form-label">Service Button</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="service_button" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_url" class="col-md-2 col-form-label">Service URL</label>
					    <div class="col-md-6">
					      <input type="url" class="form-control" name="service_url" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="" class="col-md-2 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="submit" value="Submit" name="submit" class="btn btn-light form-control">
					    </div>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	if (isset($_POST['submit'])) {
		$service_title=$_POST['service_title'];
		$service_desc=$_POST['service_desc'];
		$service_button=$_POST['service_button'];
		$service_url=$_POST['service_url'];
		$service_image=$_FILES['service_image']['name'];
		$tmp_image=$_FILES['service_image']['tmp_name'];


		$select_services="select * from services";
		$run_services=mysqli_query($con,$select_services);
		$count=mysqli_num_rows($run_services);

		if ($count<3) {
			move_uploaded_file($tmp_image, "services_images/$service_image");
			$insert_service="insert into services (service_title,service_image, service_desc, service_button, service_url) values ('$service_title','$service_image', '$service_desc', '$service_button', '$service_url')";
			$run_service=mysqli_query($con,$insert_service);
			if ($run_service) {
			echo "<script>alert('Service has been inserted')</script>";
 			echo "<script>window.open('index.php?view_services','_self')</script>";
 		}
		}
		else{
			echo "<script>alert('Three services are already inserted')</script>";
 			echo "<script>window.open('index.php?view_services','_self')</script>";
		}
 	}
 	}
 ?>