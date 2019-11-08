<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php 
	$get_contact_us="select * from contact_us";
    $run_contact=mysqli_query($con,$get_contact_us);
    $row_contact=mysqli_fetch_array($run_contact);
    $contact_header=$row_contact['contact_header'];
    $contact_desc=$row_contact['contact_desc'];
    $contact_email=$row_contact['contact_email'];
?>
 <div class="row">
 	<div class="col-lg-11">
	<div class="card bg-success text-white">
		<div class="card-header">
			<h1 class="card-title">Edit Contact Us</h1>
		</div>
		<div class="card-body">
		<form method="post">
			<div class="form-group row">
			    <label for="contact_email" class="col-md-2 col-form-label">Contact Email</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="contact_email" value="<?php echo $contact_email; ?>" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="contact_header" class="col-md-2 col-form-label">Contact header</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="contact_header" value="<?php echo $contact_header; ?>" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="contact_desc" class="col-md-2 col-form-label">Contact Description</label>
			    <div class="col-md-6">
		       		<textarea style="resize: none;" name="contact_desc" class="form-control" rows="6" cols="50"><?php echo $contact_desc; ?>
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
 	$contact_header=$_POST['contact_header'];
    $contact_desc=$_POST['contact_desc'];
    $contact_email=$_POST['contact_email'];

 	$update_contact_us="update contact_us set contact_email='$contact_email', contact_header='$contact_header', contact_desc='$contact_desc'";
 	$run_update=mysqli_query($con, $update_contact_us);
	
 	if ($run_update) {
 		echo "<script>alert('Contact Us has been edited')</script>";
 		echo "<script>window.open('index.php?edit_contact_us','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
?>