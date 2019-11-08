<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
<?php
	$edit_id=$_GET['edit_icon'];
	$get_icons="select * from icons where icon_id='$edit_id'";
	$run_icons=mysqli_query($con,$get_icons);
	$row_icons=mysqli_fetch_array($run_icons);

	$icon_id=$edit_id;
	$icon_product=$row_icons['icon_product'];
	$icon_title=$row_icons['icon_title'];
	$icon_img=$row_icons['icon_image'];

	$get_products="select * from products where product_id='$icon_product'";
 	$run_products=mysqli_query($con,$get_products);
 	$row_products=mysqli_fetch_array($run_products);
 	$product_id=$row_products['product_id'];
	$product_title=$row_products['product_title'];	


?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Icon</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label for="icon_title" class="col-md-2 col-form-label">Icon Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="icon_title" required value="<?php echo $icon_title;?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="p_cat_top" class="col-md-2 col-form-label">Select Icon Products </label>
					    <div class="col-md-6">
						    <select name="product_id" class="form-control">
						    	<option value="<?php echo $product_id;?>"><?php echo $product_title;?></option>
						    	<?php 
						    	  $get_products="select * from products";
								  $run_products=mysqli_query($con,$get_products);
								  while ($row_products=mysqli_fetch_array($run_products)) {
								  	$product_id=$row_products['product_id'];
								  	$product_title=$row_products['product_title'];	
								  	echo "<option value='$product_id'>$product_title </option>";
								  }
						    	?>
						    </select>
						</div>
				    </div>
				    <div class="form-group row">
					    <label for="icon_image" class="col-md-2 col-form-label">Select Icon Image</label>
					    <div class="col-md-6">
					      <input type="file" class="mt-1" name="icon_image">
					      <img src="icon_images/<?php echo $icon_img;?>" width='50' height='50'>
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
		$icon_title=$_POST['icon_title'];
		$icon_image=$_FILES['icon_image']['name'];
		$temp_name=$_FILES['icon_image']['tmp_name'];
		$product_id=$_POST['product_id'];

		if (empty($icon_image)) {
			$icon_image=$icon_img;
		}

		move_uploaded_file($temp_name, "icon_images/$icon_image");

		$update_icon="update icons set icon_product='$product_id', icon_title='$icon_title', icon_image='$icon_image' where icon_id='$icon_id'";
		$run_update=mysqli_query($con, $update_icon);

	if ($run_update) {
 		echo "<script>alert('Icon has been edited')</script>";
 		echo "<script>window.open('index.php?view_icons','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>