<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php 
	$get_about_us="select * from about_us";
    $run_about=mysqli_query($con,$get_about_us);
    $row_about=mysqli_fetch_array($run_about);
    $about_header=$row_about['about_header'];
    $about_short_desc=$row_about['about_short_desc'];
    $about_desc=$row_about['about_desc'];
?>
 <div class="row">
 	<div class="col-lg-11">
	<div class="card bg-success text-white">
		<div class="card-header">
			<h1 class="card-title">Edit About Us</h1>
		</div>
		<div class="card-body">
		<form method="post">
		    <div class="form-group row">
			    <label for="about_header" class="col-md-2 col-form-label">About header</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="about_header" value="<?php echo $about_header; ?>" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="about_short_desc" class="col-md-2 col-form-label">About Short Description</label>
			    <div class="col-md-6">
		       		<textarea style="resize: none;" name="about_short_desc" class="form-control" rows="6" cols="50"><?php echo $about_short_desc; ?>
		       		</textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="about_desc" class="col-md-2 col-form-label">About Description</label>
			    <div class="col-md-6">
		       		<textarea style="resize: none;" name="about_desc" class="form-control" rows="6" cols="50"><?php echo $about_desc; ?>
		       		</textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="submit" class="col-md-2 col-form-label"></label>
			    <div class="col-md-4">
			      <input type="submit" value="Submit" name="submit"
			      class="btn btn-secondary form-control">
			    </div>
		    </div>
		</form>
		</div>
	</div>
	</div>
</div>

<?php
 if (isset($_POST['submit'])) {
 	$about_header=$_POST['about_header'];
    $about_short_desc=$_POST['about_short_desc'];
    $about_desc=$_POST['about_desc'];

 	$update_about_us="update about_us set about_header='$about_header', about_short_desc='$about_short_desc', about_desc='$about_desc'";
 	$run_update=mysqli_query($con, $update_about_us);
	
 	if ($run_update) {
 		echo "<script>alert('About Us has been edited')</script>";
 		echo "<script>window.open('index.php?edit_about_us','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
?>