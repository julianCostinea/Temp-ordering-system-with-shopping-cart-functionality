<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
 <div class="row">
 	<div class="col-lg-11">
	<div class="card bg-success text-white">
		<div class="card-header">
			<h1 class="card-title">Insert Coupon</h1>
		</div>
		<div class="card-body">
		<form method="post">
			<div class="form-group row">
			    <label for="coupon_title" class="col-md-2 col-form-label">Coupon Title</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="coupon_title" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="coupon_price" class="col-md-2 col-form-label">Coupon Price</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="coupon_price" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="coupon_code" class="col-md-2 col-form-label">Coupon Code</label>
			    <div class="col-md-6">
			      <input type="text" class="form-control" name="coupon_code" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="coupon_limit" class="col-md-2 col-form-label">Coupon Limit</label>
			    <div class="col-md-6">
			      <input type="number" class="form-control" name="coupon_limit" value="1" required>
			    </div>
		    </div>
		    <div class="form-group row">
			    <label for="product_id" class="col-md-2 col-form-label">Coupon Product</label>
			    <div class="col-md-6">
			      <select name="product_id" class="form-control">
			      	<option value="">Select Coupon Product</option>
			      	<?php
			      		$get_products="select * from products";
			      		$run_products=mysqli_query($con,$get_products);
			      		while ($row_products=mysqli_fetch_array($run_products)) {
			      			$product_id=$row_products['product_id'];
			      			$product_title=$row_products['product_title'];
			      			echo "<option value='$product_id'>$product_title</option>";
			      		}
			      	?>
			      </select>
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
 	$coupon_title=$_POST['coupon_title'];
 	$coupon_price=$_POST['coupon_price'];
 	$coupon_code=$_POST['coupon_code'];
 	$coupon_limit=$_POST['coupon_limit'];
 	$product_id=$_POST['product_id'];
 	$coupon_used=0;


	$get_coupons="select * from coupons where product_id='$product_id' OR coupon_code='$coupon_code'";
	$run_coupons=mysqli_query($con,$run_coupons);
	$check_coupons=mysqli_num_rows($run_coupons);

	if($check_coupons==1){
		echo "<script>alert('Coupon or Product already exists.')</script>";
	}
	else{
		$insert_coupon="insert into coupons (product_id,coupon_title, coupon_price, coupon_code, coupon_limit, coupon_used) values('$product_id', '$coupon_title', '$coupon_price', '$coupon_code', '$coupon_limit', '$coupon_used')";
		$run_insert=mysqli_query($con,$insert_coupon);

 	if ($run_insert) {
 		echo "<script>alert('Coupon has been inserted')</script>";
 		echo "<script>window.open('index.php?view_coupons','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 }
?>