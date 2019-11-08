<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Product Category</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="p_cat_title" class="col-md-2 col-form-label">Product Category Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="p_cat_title" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="p_cat_top" class="col-md-2 col-form-label">Show as Top Category </label>
					    <div class="col-md-6 mt-2">
					    	<div class="form-check form-check-inline manufacturer_choice">
							  <input class="form-check-input" type="radio" name="p_cat_top" id="inlineRadio1" value="yes">
							  <label class="form-check-label" for="inlineRadio1">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="p_cat_top" id="inlineRadio2" value="no">
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
		$p_cat_title=$_POST['p_cat_title'];
		$p_cat_top=$_POST['p_cat_top'];

		$insert_p_cat="insert into product_categories (p_cat_title, p_cat_top) values ('$p_cat_title', '$p_cat_top') ";
		$run_p_cat=mysqli_query($con,$insert_p_cat);

	if ($run_p_cat) {
 		echo "<script>alert('Product Category has been inserted')</script>";
 		echo "<script>window.open('index.php?view_p_cats','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>