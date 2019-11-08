<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<?php
	if (isset($_GET['edit_coupon'])) {
		$edit_id=$_GET['edit_coupon'];
		$edit_coupon="select * from coupons where coupon_id='$edit_id'";
		$run_edit=mysqli_query($con,$edit_coupon);
		$row_edit=mysqli_fetch_array($run_edit);

		$coupon_id=$row_edit['coupon_id'];
		$coupon_title=$row_edit['coupon_title'];
		$coupon_price=$row_edit['coupon_price'];
		$coupon_limit=$row_edit['coupon_limit'];
		$coupon_code=$row_edit['coupon_code'];
		$coupon_used=$row_edit['coupon_used'];
		$product_id=$row_edit['product_id'];

		$get_product="select * from products where product_id='$product_id'";
		$run_products=mysqli_query($con,$get_products);
		$row_products=mysqli_fetch_array($run_products);
		$product_title=$row_products['product_title'];
	}
?>

 <div class="row">
 	<div class="col-lg-11">
	<div class="card bg-success text-white">
		<div class="card-header">
			<h1 class="card-title">Edit Coupon</h1>
		</div>
		<div class="card-body">
		<form method="post">
			<div class="form-group row">
			    <label for="coupon_title" class="col-md-2 col-form-label">Coupon Title</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="coupon_title" required value="<?php echo $coupon_title; ?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="coupon_price" class="col-md-2 col-form-label">Coupon Price</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="coupon_price" required value="<?php echo $coupon_price; ?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="coupon_code" class="col-md-2 col-form-label">Coupon Code</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="coupon_code" required value="<?php echo $coupon_code; ?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="coupon_limit" class="col-md-2 col-form-label">Coupon Limit</label>
			    <div class="col-md-6">
			      <input type="number" class="form-control" name="coupon_limit" required value="<?php echo $coupon_limit; ?>">
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_id" class="col-md-2 col-form-label">Coupon Product</label>
			    <div class="col-md-6">
			      <select name="product_id" class="form-control">
			      	<option value="<?php echo $product_id; ?>"><?php echo $product_title; ?></option>
			      	<?php
			      		$get_product="select * from products";
			      		$run_product=mysqli_query($con,$get_product);
			      		while ($row_product=mysqli_fetch_array($run_product)) {
			      			$product_id=$row_product['product_id'];
			      			$product_title=$row_product['product_title'];
			      			echo "<option value='$product_id'>$product_title</option>";
			      		}
			      	?>
			      </select>
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
 	$coupon_title=$_POST['coupon_title'];
 	$coupon_price=$_POST['coupon_price'];
 	$coupon_code=$_POST['coupon_code'];
 	$coupon_limit=$_POST['coupon_limit'];
 	$product_id=$_POST['product_id'];
 	$coupon_used=$_POST['coupon_used'];;

 	$update_coupon="update coupons set product_id='$product_id', coupon_title='$coupon_title', coupon_price='$coupon_price', coupon_code='$coupon_code', coupon_limit='$coupon_limit', coupon_used='$coupon_used' where coupon_id='$coupon_id'";
 	$run_update=mysqli_query($con, $update_coupon);
	
 	if ($run_update) {
 		echo "<script>alert('Coupon has been edited')</script>";
 		echo "<script>window.open('index.php?view_coupons','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
?>