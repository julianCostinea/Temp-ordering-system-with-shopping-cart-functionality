<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Icon</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="icon_title" class="col-md-2 col-form-label">Icon Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="icon_title" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="p_cat_top" class="col-md-2 col-form-label">Select Icon Products </label>
					    <div class="col-md-6 mt-2">
					    	<div class="card text-dark">
					    		<div class="card-header">
									<h4 class="card-title">Select product</h4>

								</div>
								<div class="card-body" style="height:10rem; overflow-y: scroll;">
									<ul class="nav nav-pills flex-column category-menu">
										<?php 
										  $get_products="select * from products";
										  $run_products=mysqli_query($con,$get_products);
										  while ($row_products=mysqli_fetch_array($run_products)) {
										  	$product_id=$row_products['product_id'];
										  	$product_title=$row_products['product_title'];
										  	echo "<li><input type='checkbox' value='$product_id' name='product_id[]'> $product_title </li>";
										  }
										?>
									</ul>
								</div>
					    	</div>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="icon_image" class="col-md-2 col-form-label">Select Icon Image</label>
					    <div class="col-md-6">
					      <input type="file" class="mt-1" name="icon_image" required>
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
		$icon_title=$_POST['icon_title'];
		$icon_image=$_FILES['icon_image']['name'];
		$temp_name=$_FILES['icon_image']['tmp_name'];
		move_uploaded_file($temp_name, "icon_images/$icon_image");

		foreach ($_POST['product_id'] as $product_id) {
			$insert_icon="insert into icons (icon_product,icon_title, icon_image) values ('$product_id', '$icon_title', '$icon_image')";
			$run_icon=mysqli_query($con,$insert_icon);
		}


	if ($run_icon) {
 		echo "<script>alert('Icon has been inserted')</script>";
 		echo "<script>window.open('index.php?view_icons','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>