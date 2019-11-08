<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['edit_product'])) {
   		$edit_id=$_GET['edit_product'];
   		$get_p="select * from products where product_id='$edit_id'";
   		$run_p=mysqli_query($con,$get_p);
   		$row_edit=mysqli_fetch_array($run_p);
   		$p_id=$edit_id;
   		$p_title=$row_edit['product_title'];
   		$p_cat=$row_edit['p_cat_id'];
   		$cat=$row_edit['cat_id'];
   		$m_id=$row_edit['manufacturer_id'];
   		$p_image1=$row_edit['product_img1'];
   		$p_image2=$row_edit['product_img2'];
   		$p_image3=$row_edit['product_img3'];
   		$product_url=$row_edit['product_url'];
   		$p_price=$row_edit['product_price'];
   		$psp_price=$row_edit['product_psp_price'];
   		$p_desc=$row_edit['product_desc'];
   		$pro_features=$row_edit['product_features'];
   		$pro_video=$row_edit['product_video'];
   		$p_keywords=$row_edit['product_keywords'];
   		$p_label=$row_edit['product_label'];
   	}
   		$get_p_cat="select * from product_categories where p_cat_id='$p_cat'";
   		$run_p_cat=mysqli_query($con, $get_p_cat);
   		$row_p_cat=mysqli_fetch_array($run_p_cat);
   		$p_cat_title=$row_p_cat['p_cat_title'];

   		$get_cat="select * from categories where cat_id='$cat'";
   		$run_cat=mysqli_query($con, $get_cat);
   		$row_cat=mysqli_fetch_array($run_cat);
   		$cat_title=$row_cat['cat_title'];

   		$get_manufacturer="select * from manufacturers where manufacturer_id='$m_id'";
		$run_manufacturer=mysqli_query($con,$get_manufacturer);
		$row_manufacturer=mysqli_fetch_array($run_manufacturer);
		$manufacturer_title=$row_manufacturer['manufacturer_title'];
 ?>
 <div class="row">
 	<div class="col-lg-11">
	<div class="card bg-light">
		<div class="card-header">
			<h1>Edit Product</h1>
		</div>
		<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group row">
			    <label for="product_title" class="col-md-2 col-form-label" >Product Title</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_title" required value="<?php echo $p_title;?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_url" class="col-md-2 col-form-label">Product URL</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_url" required value="<?php echo $product_url;?>">
			      <br>
			      <p style="font-size:1rem; font-weight: bold; color: black;">
			      	Product URL Example: navy-blue-tshirt
			      </p>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="manufacturer" class="col-md-2 col-form-label">Product Manufacturer</label>
			    <div class="col-md-6">
			      <select name="manufacturer" class="form-control">
			      	<option value="<?php echo $m_id; ?>"><?php echo $manufacturer_title; ?></option>
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
			      	<option value="<?php echo $p_cat; ?>"><?php echo $p_cat_title; ?></option>
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
			      	<option value="<?php echo $cat; ?>"><?php echo $cat_title ?></option>
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
			      <input type="file" class="form-control-file" name="product_img1">
			      <br>
			      <img src="product_images/<?php echo $p_image1; ?>" width="60" height="60">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_img2" class="col-md-2 col-form-label">Product Image 2</label>
			    <div class="col-md-6">
			      <input type="file" class="form-control-file" name="product_img2">
			      <br>
			      <img src="product_images/<?php echo $p_image2; ?>" width="60" height="60">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_img3" class="col-md-2 col-form-label">Product Image 3</label>
			    <div class="col-md-6">
			      <input type="file" class="form-control-file" name="product_img3">
			      <br>
			      <img src="product_images/<?php echo $p_image3; ?>" width="60" height="60">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_price" class="col-md-2 col-form-label">Product Price</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_price" required value="<?php echo $p_price;?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="psp_price" class="col-md-2 col-form-label">Product Sale Price</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="psp_price" required value="<?php echo $psp_price;?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_keywords" class="col-md-2 col-form-label">Product Keywords</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_keywords" required value="<?php echo $p_keywords;?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_desc" class="col-md-2 col-form-label">Product Description</label>
			    <div class="col-md-6">
			      <textarea style="resize: none;" name="product_desc" class="form-control" rows="6" cols="50" ><?php echo $p_desc;?>
			      </textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_features" class="col-md-2 col-form-label">Product Features</label>
			    <div class="col-md-6">
			      <textarea style="resize: none;" name="product_features" class="form-control" rows="6" cols="50"><?php echo $pro_features;?></textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_video" class="col-md-2 col-form-label">Product Video</label>
			    <div class="col-md-6">
			      <textarea style="resize: none;" name="product_video" class="form-control" rows="6" cols="50"><?php echo $pro_video;?></textarea>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_label" class="col-md-2 col-form-label">Product Label</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="product_label" required value="<?php echo $p_label;?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="submit" class="col-md-2 col-form-label"></label>
			    <div class="col-md-4">
			      <input type="submit" value="Update Product" name="update" 
			      class="btn btn-secondary form-control">
			    </div>
		    </div>
		</form>
		</div>
	</div>
	</div>
</div>

<?php
 if (isset($_POST['update'])) {
 	$product_title=$_POST['product_title'];
 	$product_cat=$_POST['product_cat'];
 	$cat=$_POST['cat'];
 	$manufacturer_id=$_POST['manufacturer'];
 	$product_price=$_POST['product_price'];
 	$product_desc=$_POST['product_desc'];
 	$product_features=$_POST['product_features'];
 	$product_video=$_POST['product_video'];
 	$product_keywords=$_POST['product_keywords'];
 	$psp_price=$_POST['psp_price'];
 	$product_url=$_POST['product_url'];
 	$product_label=$_POST['product_label'];
 	$status="product";

 	$product_img1=$_FILES['product_img1']['name'];
 	$product_img2=$_FILES['product_img2']['name'];
 	$product_img3=$_FILES['product_img3']['name'];

 	$temp_name1=$_FILES['product_img1']['tmp_name'];
 	$temp_name2=$_FILES['product_img2']['tmp_name'];
 	$temp_name3=$_FILES['product_img3']['tmp_name'];

 	if (empty($product_img1)) {
 		$product_img1=$p_image1;
 	}
 	if (empty($product_img2)) {
 		$product_img2=$p_image2;
 	}
 	if (empty($product_img3)) {
 		$product_img3=$p_image3;
 	}

 	move_uploaded_file($temp_name1, "product_images/$product_img1");
 	move_uploaded_file($temp_name2, "product_images/$product_img2");
 	move_uploaded_file($temp_name3, "product_images/$product_img3");
 	

	 $update_product="update products set p_cat_id='$product_cat', cat_id='$cat', manufacturer_id='$manufacturer_id', date=NOW(), product_title='$product_title', product_url='$product_url', product_img1='$product_img1', product_img2='$product_img2', product_img3='$product_img3', product_price='$product_price', product_psp_price='$psp_price', product_desc='$product_desc', product_features='$product_features', product_video='$product_video', product_keywords='$product_keywords' , product_label='$product_label', status='$status' where product_id='$p_id'";

	 $run_product=mysqli_query($con, $update_product);


 	if ($run_product) {
 		echo "<script>alert('Product has been updated')</script>";
 		echo "<script>window.open('index.php?view_products','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 }
?>