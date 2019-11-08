<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
 <div class="row">
 	<div class="col-lg-11">
	<div class="card bg-success text-white">
		<div class="card-header">
			<h1 class="card-title">Insert Products</h1>
		</div>
		<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group row">
			    <label for="product_title" class="col-md-2 col-form-label">Product Title</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_title" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_url" class="col-md-2 col-form-label">Product URL</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_url" required>
			      <br>
			      <p style="font-size:1rem; font-weight: bold; color: black;">
			      	Product URL Example: navy-blue-tshirt
			      </p>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="manufacturer" class="col-md-2 col-form-label">Product Manufacturer</label>
			    <div class="col-md-6">
			      <select class="form-control" name="manufacturer" required>
			      	<option value=""> Select a Manufacturer</option>
			      	<?php
			      		$get_manufacturer="select * from manufacturers";
					  	$run_manufacturer=mysqli_query($con,$get_manufacturer);
					  	while ($row_manufacturer=mysqli_fetch_array($run_manufacturer)) {
					  		$manufacturer_id=$row_manufacturer['manufacturer_id'];
					  		$manufacturer_title=$row_manufacturer['manufacturer_title'];

					  		echo "<option value='$manufacturer_id'> $manufacturer_title </option>";
					  	}
			      	?>
			      </select>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_cat" class="col-md-2 col-form-label">Product Category</label>
			    <div class="col-md-6">
			      <select name="product_cat" class="form-control">
			      	<option>Select a Product Category</option>
			      	<?php 
			      		$get_p_cats="select * from product_categories";
			      		$run_p_cats=mysqli_query($con, $get_p_cats);
			      		while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
			      			$p_cat_id=$row_p_cats['p_cat_id'];
			      			$p_cat_title=$row_p_cats['p_cat_title'];
			 				echo "<option value='$p_cat_id'>$p_cat_title</option>";
			      		}
			      	 ?>
			      </select>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="cat" class="col-md-2 col-form-label">Category</label>
			    <div class="col-md-6">
			      <select name="cat" class="form-control">
			      	<option>Select a Category</option>
			      	<?php 
			      		$get_cat="select * from categories";
			      		$run_cat=mysqli_query($con, $get_cat);
			      		while ($row_cat=mysqli_fetch_array($run_cat)) {
			      			$cat_id=$row_cat['cat_id'];
			      			$cat_title=$row_cat['cat_title'];
			 				echo "<option value='$cat_id'>$cat_title</option>";
			      		}
			      	 ?>
			      </select>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_img1" class="col-md-2 col-form-label">Product Image 1</label>
			    <div class="col-md-6">
			      <input type="file" class="form-control-file" name="product_img1" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_img2" class="col-md-2 col-form-label">Product Image 2</label>
			    <div class="col-md-6">
			      <input type="file" class="form-control-file" name="product_img2" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_img3" class="col-md-2 col-form-label">Product Image 3</label>
			    <div class="col-md-6">
			      <input type="file" class="form-control-file" name="product_img3" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_price" class="col-md-2 col-form-label">Product Price</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_price" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="psp_price" class="col-md-2 col-form-label">Product Sale Price</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="psp_price" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_keywords" class="col-md-2 col-form-label">Product Keywords</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_keywords" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_desc" class="col-md-2 col-form-label">Product Description</label>
			    <div class="col-md-6">
			      <textarea style="resize: none;" name="product_desc" class="form-control" rows="6" cols="50"></textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_features" class="col-md-2 col-form-label">Product Features</label>
			    <div class="col-md-6">
			      <textarea style="resize: none;" name="product_features" class="form-control" rows="6" cols="50"></textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_video" class="col-md-2 col-form-label">Product Video</label>
			    <div class="col-md-6">
			      <textarea style="resize: none;" name="product_video" class="form-control" rows="6" cols="50"></textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_label" class="col-md-2 col-form-label">Product Label</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_label" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="submit" class="col-md-2 col-form-label"></label>
			    <div class="col-md-4">
			      <input type="submit" value="Insert Product" name="submit" 
			      class="btn btn-secondary form-control">
			    </div>
		    </div>
		</form>
		</div>
	</div>
	</div>
</div>

<?php
 if (isset($_POST['submit'])) {
 	$product_title=$_POST['product_title'];
 	$product_cat=$_POST['product_cat'];
 	$cat=$_POST['cat'];
 	$manufacturer_id=$_POST['manufacturer'];
 	$product_price=$_POST['product_price'];
 	$psp_price=$_POST['psp_price'];
 	$product_desc=$_POST['product_desc'];
 	$product_features=$_POST['product_features'];
 	$product_url=$_POST['product_url'];
 	$product_keywords=$_POST['product_keywords'];
 	$product_label=$_POST['product_label'];
 	$product_video=$_POST['product_video'];
 	$status="product";

 	$product_img1=$_FILES['product_img1']['name'];
 	$product_img2=$_FILES['product_img2']['name'];
 	$product_img3=$_FILES['product_img3']['name'];

 	$temp_name1=$_FILES['product_img1']['tmp_name'];
 	$temp_name2=$_FILES['product_img2']['tmp_name'];
 	$temp_name3=$_FILES['product_img3']['tmp_name'];

 	move_uploaded_file($temp_name1, "product_images/$product_img1");
 	move_uploaded_file($temp_name2, "product_images/$product_img2");
 	move_uploaded_file($temp_name3, "product_images/$product_img3");
 	

	 $insert_product="insert into products (p_cat_id,cat_id, manufacturer_id, date,product_title, product_url, product_img1,
	 product_img2,product_img3, product_price, product_psp_price, product_desc, product_features, product_video, product_keywords, product_label, status) values ('$product_cat','$cat',$manufacturer_id ,NOW(),'$product_title', '$product_url', '$product_img1','$product_img2','$product_img3',
	 '$product_price', '$psp_price' ,'$product_desc', '$product_features', '$product_video', '$product_keywords', '$product_label', '$status')";

	 $run_product=mysqli_query($con, $insert_product);


 	if ($run_product) {
 		echo "<script>alert('Product has been inserted')</script>";
 		echo "<script>window.open('index.php?view_products','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 }
?>