<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
	<?php 
		if (isset($_GET['edit_manufacturer'])) {
	   		$edit_manufacturer=$_GET['edit_manufacturer'];
	   		$edit_query="select * from manufacturers where manufacturer_id='$edit_manufacturer'";
	   		$run_edit=mysqli_query($con,$edit_query);
	   		$row_edit=mysqli_fetch_array($run_edit);
	   		$manufacturer_id=$edit_manufacturer;
	   		$manufacturer_top=$row_edit['manufacturer_top'];
	   		$manufacturer_title=$row_edit['manufacturer_title'];

   	}
	 ?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-info text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Manufacturer</h1>
			</div>		
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="manufacturer_title" class="col-md-2 col-form-label">Manufacturer Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="manufacturer_title" required value="<?php echo $manufacturer_title; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="manufacturer_choice" class="col-md-2 col-form-label">Show as top Manufacturer</label>
					    <div class="col-md-6">
							<div class="form-check form-check-inline manufacturer_choice">
							  <input class="form-check-input" type="radio" name="manufacturer_top" id="inlineRadio1" value="yes" <?php if ($manufacturer_top=='no') {} else { echo "checked='checked'"; }; ?> >
							  <label class="form-check-label" for="inlineRadio1">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="manufacturer_top" id="inlineRadio2" value="no" <?php if ($manufacturer_top=='yes') {} else { echo "checked='checked'"; }; ?>>
							  <label class="form-check-label" for="inlineRadio2">No</label>
							</div>
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
		$manufacturer_title=$_POST['manufacturer_title'];
		$manufacturer_top=$_POST['manufacturer_top'];

		$update_manufacturer="update manufacturers set manufacturer_title='$manufacturer_title', manufacturer_top='$manufacturer_top' where manufacturer_id='$manufacturer_id'";
		$run_manufacturer=mysqli_query($con,$update_manufacturer);

	if ($run_manufacturer) {
 		echo "<script>alert('Manufacturer has been updated')</script>";
 		echo "<script>window.open('index.php?view_manufacturers','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>