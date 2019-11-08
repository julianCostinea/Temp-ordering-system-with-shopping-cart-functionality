<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php 

   	if (isset($_GET['edit_p_cat'])) {
   		$edit_p_cat_id=$_GET['edit_p_cat'];
   		$edit_p_cat_query="select * from product_categories where p_cat_id='$edit_p_cat_id'";
   		$run_edit=mysqli_query($con,$edit_p_cat_query);
   		$row_edit=mysqli_fetch_array($run_edit);
   		$p_cat_id=$edit_p_cat_id;
   		$p_cat_title=$row_edit['p_cat_title'];
   		$p_cat_top=$row_edit['p_cat_top'];

   	}
 ?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Product Category</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="p_cat_title" class="col-md-2 col-form-label">Product Category Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="p_cat_title" required value="<?php echo $p_cat_title; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="p_cat_top" class="col-md-2 col-form-label">Show as top Category</label>
					    <div class="col-md-6 mt-2">
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="p_cat_top" id="inlineRadio1" value="yes" <?php if ($p_cat_top=='no') {} else { echo "checked='checked'"; }; ?> >
							  <label class="form-check-label" for="inlineRadio1">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="p_cat_top" id="inlineRadio2" value="no" <?php if ($p_cat_top=='yes') {} else { echo "checked='checked'"; }; ?>>
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
		$p_cat_title=$_POST['p_cat_title'];
		$p_cat_top=$_POST['p_cat_top'];

		$update_query="update product_categories set p_cat_title='$p_cat_title', 
		p_cat_top='$p_cat_top' where p_cat_id='$p_cat_id'";
		$run_update=mysqli_query($con,$update_query);

	if ($run_update) {
 		echo "<script>alert('Product Category has been updated')</script>";
 		echo "<script>window.open('index.php?view_p_cats','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>