<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-info text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Manufacturer</h1>
			</div>		
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="manufacturer_name" class="col-md-2 col-form-label">Manufacturer Name</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="manufacturer_name" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="manufacturer_choice" class="col-md-2 col-form-label">Show as top Manufacturer</label>
					    <div class="col-md-6">
							<div class="form-check form-check-inline manufacturer_choice">
							  <input class="form-check-input" type="radio" name="manufacturer_top" id="inlineRadio1" value="yes">
							  <label class="form-check-label" for="inlineRadio1">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="manufacturer_top" id="inlineRadio2" value="no">
							  <label class="form-check-label" for="inlineRadio2">No</label>
							</div>
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
		$manufacturer_name=$_POST['manufacturer_name'];
		$manufacturer_top=$_POST['manufacturer_top'];

		$insert_manufacturer="insert into manufacturers (manufacturer_title, manufacturer_top) values ('$manufacturer_name', '$manufacturer_top') ";
		$run_manufacturer=mysqli_query($con,$insert_manufacturer);

	if ($run_manufacturer) {
 		echo "<script>alert('Manufacturer has been inserted')</script>";
 		echo "<script>window.open('index.php?view_manufacturers','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>