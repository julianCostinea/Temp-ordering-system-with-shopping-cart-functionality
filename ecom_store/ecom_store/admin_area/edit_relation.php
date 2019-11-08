<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <?php
 	if (isset($_GET['edit_relation'])) {
 		$edit_id=$_GET['edit_relation'];
 		$edit_rel="select * from bundle_product_relation where rel_id='$edit_id'";
 		$run_edit=mysqli_query($con,$edit_rel);
 		$row_edit=mysqli_fetch_array($run_edit);
 		$rel_id=$edit_id;
 		$relation_title=$row_edit['rel_title'];
 		$relation_product_id=$row_edit['product_id'];
 		$relation_bundle_id=$row_edit['bundle_id'];

 		$get_prod="select * from products where product_id='$relation_product_id'";
 		$run_prod=mysqli_query($con,$get_prod);
 		$row_prod=mysqli_fetch_array($run_prod);
 		$prod_title=$row_prod['product_title'];

 		$get_bundles="select * from products where product_id='$relation_bundle_id'";
 		$run_bundles=mysqli_query($con,$get_bundles);
 		$row_bundles=mysqli_fetch_array($run_bundles);
 		$bundle_title=$row_bundles['product_title'];
 	}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-info text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Relation</h1>
			</div>
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="rel_title" class="col-md-2 col-form-label">Relation Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="rel_title" value="<?php echo $relation_title; ?>" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="product_id" class="col-md-2 col-form-label">Select Product</label>
					    <div class="col-md-6">
					      <select class="form-control" name="product_id" required>
					      	<option value="<?php echo $relation_product_id; ?>"><?php echo $prod_title; ?></option>
					      	<?php
					      		$get_products="select * from products where status ='product'";
							  	$run_products=mysqli_query($con,$get_products);
							  	while ($row_products=mysqli_fetch_array($run_products)) {
							  		$product_id=$row_products['product_id'];
							  		$product_title=$row_products['product_title'];

							  		echo "<option value='$product_id'> $product_title </option>";
							  	}
					      	?>
					      </select>
					    </div>
		    		</div>

		    		<div class="form-group row">
					    <label for="bundle_id" class="col-md-2 col-form-label">Select Bundle</label>
					    <div class="col-md-6">
					      <select class="form-control" name="bundle_id" required>
					      	<option value="<?php echo $relation_bundle_id; ?>"> <?php echo $bundle_title; ?> </option>
					      	<?php
					      		$get_products="select * from products where status ='bundle'";
							  	$run_products=mysqli_query($con,$get_products);
							  	while ($row_products=mysqli_fetch_array($run_products)) {
							  		$product_id=$row_products['product_id'];
							  		$product_title=$row_products['product_title'];

							  		echo "<option value='$product_id'> $product_title </option>";
							  	}
					      	?>
					      </select>
					    </div>
		    		</div>

				    <div class="form-group row">
					    <label for="submit" class="col-md-2 col-form-label"></label>
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
		$rel_title=$_POST['rel_title'];
		$product_id=$_POST['product_id'];
		$bundle_id=$_POST['bundle_id'];

		$update_relation="update bundle_product_relation set rel_title='$rel_title', product_id='$product_id', bundle_id='$bundle_id' where rel_id='$rel_id'";
		$run_relation=mysqli_query($con,$update_relation);

	if ($run_relation) {
 		echo "<script>alert('Relation has been updated')</script>";
 		echo "<script>window.open('index.php?view_relations','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>