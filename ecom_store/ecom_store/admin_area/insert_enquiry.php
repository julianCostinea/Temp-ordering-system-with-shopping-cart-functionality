<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Enquiry</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="enquiry_title" class="col-md-2 col-form-label">Enquiry Type</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="enquiry_title" required>
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
		$enquiry_title=$_POST['enquiry_title'];

		$insert_enquiry="insert into enquiry_types (enquiry_title) values ('$enquiry_title') ";
		$run_enquiry=mysqli_query($con,$insert_enquiry);

	if ($run_enquiry) {
 		echo "<script>alert('Enquiry has been inserted')</script>";
 		echo "<script>window.open('index.php?view_enquiries','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>