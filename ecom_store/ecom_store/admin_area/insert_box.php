<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-info text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Box</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="box_title" class="col-md-2 col-form-label">Box Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="box_title" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="box_desc" class="col-md-2 col-form-label">Box Description</label>
					    <div class="col-md-6">
					      <textarea name="box_desc" class="form-control" style="resize: none;"></textarea>
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
		$box_title=$_POST['box_title'];
		$box_desc=$_POST['box_desc'];

		$insert_box="insert into boxes_section (box_title, box_desc) values ('$box_title', '$box_desc') ";
		$run_box=mysqli_query($con,$insert_box);

	if ($run_box) {
 		echo "<script>alert('Box has been inserted')</script>";
 		echo "<script>window.open('index.php?view_boxes','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>