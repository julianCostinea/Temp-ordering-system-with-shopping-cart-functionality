<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <?php
 	if (isset($_GET['edit_slide'])) {
 		$edit_id=$_GET['edit_slide'];
 		$edit_slide="select * from slider where slide_id= '$edit_id'";
 		$run_edit=mysqli_query($con,$edit_slide);
 		$row_edit=mysqli_fetch_array($run_edit);

 		$slide_id=$edit_id;
 		$slide_name=$row_edit['slide_name'];
 		$slide_url=$row_edit['slide_url'];
 		$slide_img=$row_edit['slide_image'];

 	}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-warning text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Slide</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="slide_name" class="col-md-2 col-form-label">Slide Name</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="slide_name" required value="<?php echo $slide_name; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="p_cat_desc" class="col-md-2 col-form-label">Slide Image</label>
					    <div class="col-md-6">
					     <input type="file" class="" name="slide_image">
					     <br><br><img width="250" src="slides_images/<?php echo $slide_img; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="slide_url" class="col-md-2 col-form-label">Slide Link</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="slide_url" value="<?php echo $slide_url; ?>" required>
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
		$slide_name=$_POST['slide_name'];
		$slide_image=$_FILES['slide_image']['name'];
		$temp_name=$_FILES['slide_image']['tmp_name'];
		$slide_url=$_POST['slide_url'];

		if (empty($slide_image)) {
			$slide_image=$slide_img;
		}

		move_uploaded_file($temp_name, "slides_images/$slide_image");
		$update_slide="update slider set slide_name='$slide_name', slide_image='$slide_image', slide_url='$slide_url' where slide_id='$slide_id'";
		$run_slide=mysqli_query($con,$update_slide);
		if ($run_slide) {
			echo "<script>alert('Slide has been updated')</script>";
 			echo "<script>window.open('index.php?view_slides','_self')</script>";
		}
		else {
			echo "<script>alert('ERROR')</script>";		}
 	}
 ?>