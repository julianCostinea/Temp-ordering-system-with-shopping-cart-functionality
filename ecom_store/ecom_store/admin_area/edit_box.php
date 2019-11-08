<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <?php
 	if (isset($_GET['edit_box'])) {
 	 	$box_id=$_GET['edit_box'];
 	 	$get_boxes="select * from boxes_section where box_id='$box_id'";
 	 	$run_boxes=mysqli_query($con,$get_boxes);
 	 	$row_boxes=mysqli_fetch_array($run_boxes);
 	 	$box_title=$row_boxes['box_title'];
 	 	$box_desc=$row_boxes['box_desc'];
 	 } 
  ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-info text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Box</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="box_title" class="col-md-2 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="box_title" required value="<?php echo $box_title; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="box_desc" class="col-md-2 col-form-label">Box Description</label>
					    <div class="col-md-6">
					      <textarea name="box_desc" class="form-control" style="resize: none;"><?php echo $box_desc; ?>
					      </textarea>
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
		$box_title=$_POST['box_title'];
		$box_desc=$_POST['box_desc'];

		$update_box="update boxes_section set box_title='$box_title', 
			box_desc='$box_desc' where box_id='$box_id'";
		$run_update=mysqli_query($con,$update_box);

	if ($run_update) {
 		echo "<script>alert('Box has been updated')</script>";
 		echo "<script>window.open('index.php?view_boxes','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>