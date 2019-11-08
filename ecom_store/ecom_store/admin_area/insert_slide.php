<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Slide</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="slide_name" class="col-md-2 col-form-label">Slide Name</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="slide_name" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="slide_image" class="col-md-2 col-form-label">Slide Image</label>
					    <div class="col-md-6">
					     <input type="file" class="form-control-file" name="slide_image" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="slide_url" class="col-md-2 col-form-label">Slide Link</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="slide_url" required>
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
		$slide_name=$_POST['slide_name'];
		$slide_image=$_FILES['slide_image']['name'];
		$temp_name=$_FILES['slide_image']['tmp_name'];
		$slide_url=$_POST['slide_url'];

		$view_slides="select * from slider";
		$run_view_slides=mysqli_query($con,$view_slides);
		$count=mysqli_num_rows($run_view_slides);

		if ($count<3) {
			move_uploaded_file($temp_name, "slides_images/$slide_image");
			$insert_slide="insert into slider (slide_name,slide_image, slide_url) values ('$slide_name','$slide_image', '$slide_url')";
			$run_slide=mysqli_query($con,$insert_slide);
			echo "<script>alert('Slide has been inserted')</script>";
 			echo "<script>window.open('index.php?view_slides','_self')</script>";
		}
		else{
			echo "<script>alert('Four slides are already inserted')</script>";
 			echo "<script>window.open('index.php?view_slides','_self')</script>";
		}
 	}
 ?>