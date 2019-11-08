<div class="text-center">
	<h1>Wishlist</h1>
	<p class="text-muted">All your wishes in one place</p>
</div>

<hr>

<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>Wishlist No:</th>
				<th>Product</th>
				<th>Delete Product</th>
			</tr>
		</thead>
		<tbody class="text-center">
			<?php
				$customer_session=$_SESSION['customer_email'];
				$get_customer="select * from customers where customer_email='$customer_session'";
				$run_customer=mysqli_query($con,$get_customer);
				$row_customer=mysqli_fetch_array($run_customer);
				$customer_id=$row_customer['customer_id'];

				$get_wishlist="select * from wishlist where customer_id='$customer_id'";
				$run_wishlist=mysqli_query($con,$get_wishlist);
				while ($row_wishlist=mysqli_fetch_array($run_wishlist)) {
					$wishlist_id=$row_wishlist['wishlist_id'];
					$product_id=$row_wishlist['product_id'];
					
					$get_products="select * from products where product_id='$product_id'";
					$run_product=mysqli_query($con,$get_products);
					$row_product=mysqli_fetch_array($run_product);

					$product_title=$row_product['product_title'];
					$product_url=$row_product['product_url'];
					$product_img1=$row_product['product_img1'];
			
			?>
			<tr>
				<td style="vertical-align: middle;"><?php echo $wishlist_id; ?></td>
				<td><img width="60" height="60" src="../admin_area/product_images/<?php echo $product_img1; ?>">
					&nbsp;&nbsp;&nbsp;
					<a href="../<?php echo $product_url; ?>"><?php echo $product_title; ?></a>
				</td>
				<td style="vertical-align: middle;"><a class="btn btn-danger" href="my_account.php?delete_wishlist=<?php echo $wishlist_id; ?>"><i class="fa fa-trash"></i> Delete </a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>