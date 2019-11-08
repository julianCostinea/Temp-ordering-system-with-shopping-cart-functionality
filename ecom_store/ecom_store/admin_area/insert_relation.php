<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-info text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Relation</h1>
			</div>
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="rel_title" class="col-md-2 col-form-label">Relation Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="rel_title" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="product_id" class="col-md-2 col-form-label">Select Product</label>
					    <div class="col-md-6">
					      <select class="form-control" name="product_id" required>
					      	<option value=""> Select a product</option>
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
					      	<option value=""> Select a bundle</option>
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
		$rel_title=$_POST['rel_title'];
		$product_id=$_POST['product_id'];
		$bundle_id=$_POST['bundle_id'];

		$insert_relation="insert into bundle_product_relation (rel_title, product_id,bundle_id) values ('$rel_title', '$product_id', '$bundle_id') ";
		$run_relation=mysqli_query($con,$insert_relation);

	if ($run_relation) {
 		echo "<script>alert('Relation has been inserted')</script>";
 		echo "<script>window.open('index.php?view_relations','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>