<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php
	if (isset($_GET['edit_enquiry'])) {
		$edit_id=$_GET['edit_enquiry'];
		$get_enquiry="select * from enquiry_types where enquiry_id='$edit_id'";
		$run_enquiry=mysqli_query($con,$get_enquiry);
		$row_enquiry=mysqli_fetch_array($run_enquiry);
		$enquiry_title=$row_enquiry['enquiry_title'];
	}
?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Enquiry</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="enquiry_title" class="col-md-2 col-form-label">Enquiry Type</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="enquiry_title" value="<?php echo $enquiry_title; ?>" required>
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
		$enquiry_title=$_POST['enquiry_title'];

		$update_enquiry="update enquiry_types set enquiry_title='$enquiry_title' where enquiry_id='$edit_id' ";
		$run_enquiry=mysqli_query($con,$update_enquiry);

	if ($run_enquiry) {
 		echo "<script>alert('Enquiry has been updated')</script>";
 		echo "<script>window.open('index.php?view_enquiries','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>