<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php 
	if (isset($_GET['edit_service'])) {
		$edit_id=$_GET['edit_service'];
		$get_edit="select * from services where service_id='$edit_id'";
		$run_edit=mysqli_query($con,$get_edit);
		$row_services=mysqli_fetch_array($run_edit);
		$service_title=$row_services['service_title'];
  	 	$service_img=$row_services['service_image'];
  	 	$service_desc=substr($row_services['service_desc'],0,120);
  	 	$service_button=$row_services['service_button'];
  	 	$service_url=$row_services['service_url'];
	}
?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Service</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="service_title" class="col-md-2 col-form-label">Service Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="service_title" value="<?php echo $service_title; ?>" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_image" class="col-md-2 col-form-label">Service Image</label>
					    <div class="col-md-6">
					      <input type="file" class="" name="service_image"> <br><br>
					      <img width="70" height="70" src="services_images/<?php echo $service_img; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_desc" class="col-md-2 col-form-label">Service Description</label>
					    <div class="col-md-6">
					      <textarea name="service_desc" class="form-control" style="resize: none;"><?php echo $service_desc; ?></textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_button" class="col-md-2 col-form-label">Service Button</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="service_button" value="<?php echo $service_button; ?>" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="service_url" class="col-md-2 col-form-label">Service URL</label>
					    <div class="col-md-6">
					      <input type="url" class="form-control" name="service_url" value="<?php echo $service_url; ?>" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="" class="col-md-2 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="submit" value="Submit" name="update" class="btn btn-light form-control">
					    </div>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	if (isset($_POST['update'])) {
		$service_title=$_POST['service_title'];
		$service_desc=$_POST['service_desc'];
		$service_button=$_POST['service_button'];
		$service_url=$_POST['service_url'];
		$service_image=$_FILES['service_image']['name'];
		$tmp_image=$_FILES['service_image']['tmp_name'];

		if (empty($service_image)) {
			$service_image=$icon_img;
		}
		
		move_uploaded_file($tmp_image, "services_images/$service_image");

		$update_service="update services set service_title='$service_title', service_desc='$service_desc', service_button='$service_button', service_url='$service_url', service_image='$service_image' where service_id='$service_id'";
		$run_update=mysqli_query($con, $update_service);

		if ($run_update) {
			echo "<script>alert('Service has been edited')</script>";
 			echo "<script>window.open('index.php?view_services','_self')</script>";
		}
		else{
			echo "<script>alert('ERROR')</script>";
		}
 	}
 ?>