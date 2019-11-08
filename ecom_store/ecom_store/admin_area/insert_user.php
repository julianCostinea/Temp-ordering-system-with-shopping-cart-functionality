<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-danger text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Administrator</h1>
			</div>		
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="admin_name" class="col-md-2 col-form-label">Admin Username</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="admin_name" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_email" class="col-md-2 col-form-label">Admin Email</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="admin_email" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_pass" class="col-md-2 col-form-label">Password</label>
					    <div class="col-md-6">
					      <input type="Password" class="form-control" name="admin_pass" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_country" class="col-md-2 col-form-label">Admin Country</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="admin_country" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_job" class="col-md-2 col-form-label">Admin Job</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="admin_job" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_contact" class="col-md-2 col-form-label">Admin Phone number</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="admin_contact" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_about" class="col-md-2 col-form-label">Admin about field</label>
					    <div class="col-md-6">
					      <textarea name="admin_about" class="form-control" style="resize: none;">
					      </textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="admin_image" class="col-md-2 col-form-label">Admin image</label>
					    <div class="col-md-6">
					      <input type="file" class="" name="admin_image" required>
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
		$admin_name=$_POST['admin_name'];
		$admin_email=$_POST['admin_email'];
		$admin_pass=$_POST['admin_pass'];
		$admin_country=$_POST['admin_country'];
		$admin_job=$_POST['admin_job'];
		$admin_contact=$_POST['admin_contact'];
		$admin_about=$_POST['admin_about'];

		$admin_image=$_FILES['admin_image']['name'];
		$temp_adimn_image=$_FILES['admin_image']['tmp_name'];
		move_uploaded_file($temp_adimn_image, "admin_images/$admin_image");

		$insert_admin="insert into admins (admin_name, admin_email, admin_pass, admin_image, admin_contact, admin_country, admin_job, admin_about) values ('$admin_name', '$admin_email', '$admin_pass', '$admin_image', '$admin_contact', '$admin_country', '$admin_job', '$admin_about') ";
		$run_admin=mysqli_query($con,$insert_admin);

	if ($run_admin) {
 		echo "<script>alert('Administrator has been inserted')</script>";
 		echo "<script>window.open('index.php?view_users','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>