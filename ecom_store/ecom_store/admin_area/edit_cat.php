<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php 

   	if (isset($_GET['edit_cat'])) {
   		$edit_cat_id=$_GET['edit_cat'];
   		$edit_cat_query="select * from categories where cat_id='$edit_cat_id'";
   		$run_edit=mysqli_query($con,$edit_cat_query);
   		$row_edit=mysqli_fetch_array($run_edit);
   		$cat_id=$edit_cat_id;
   		$cat_title=$row_edit['cat_title'];
   		$cat_top=$row_edit['cat_top'];

   	}
 ?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Category</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="cat_title" class="col-md-2 col-form-label">Category Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="cat_title" required value="<?php echo $cat_title; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					   <label for="cat_top" class="col-md-2 col-form-label">Show as top Category</label>
					    <div class="col-md-6 mt-2">
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="cat_top" id="inlineRadio1" value="yes" <?php if ($cat_top=='no') {} else { echo "checked='checked'"; }; ?> >
							  <label class="form-check-label" for="inlineRadio1">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="cat_top" id="inlineRadio2" value="no" <?php if ($cat_top=='yes') {} else { echo "checked='checked'"; }; ?>>
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
		$cat_title=$_POST['cat_title'];
		$cat_top=$_POST['cat_top'];

		$update_query="update categories set cat_title='$cat_title', 
		cat_top='$cat_top' where cat_id='$cat_id'";
		$run_update=mysqli_query($con,$update_query);

	if ($run_update) {
 		echo "<script>alert('Category has been updated')</script>";
 		echo "<script>window.open('index.php?view_cats','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>
