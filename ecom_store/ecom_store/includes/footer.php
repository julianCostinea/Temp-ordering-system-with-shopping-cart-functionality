<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<h4>Pages</h4>
				<ul>
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="contact.php">Contact Us</a></li>
					<li><a href="shop.php">Shop</a></li>

					<li><a href="customer/my_account.php">My Account</a></li>
				</ul>
				<hr>
				<h4>User Section</h4>
				<ul>
					<li><a href="customer/my_account.php">Login</a></li>
					<li><a href="customer_register.php">Register</a></li>
					<li><a href="terms.php">Terms and Conditions</a></li>
				</ul>
				<hr class="d-sm-none">
			</div>
			<div class="col-md-3 col-sm-6">
				<h4>Top Product Categories</h4>
				<ul>
					<?php 
						$get_p_cats="select * from product_categories";
						$run_p_cats=mysqli_query($con,$get_p_cats);
						while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
							$p_cat_id=$row_p_cats['p_cat_id'];
							$p_cat_title=$row_p_cats['p_cat_title'];
							echo "<li><a href='shop.php?p_cat=$p_cat_id'>
									$p_cat_title
							</a></li>";
						}
					 ?>
				</ul>
				<hr class="d-sm-none">
			</div>
			<div class="col-md-3 col-sm-6">
				<h4>Where to find us</h4>
				<p>
					<strong>JCO Development</strong>
					<br>Odense
					<br>Danmark
					<br>julian.costinea@gmail.com
					<br>
					<strong>Julian Costinea</strong>
				</p>
				<a href="contact.php">Go to Contact page</a>
				<hr class="d-sm-none">
			</div>
			<div class="col-md-3 col-sm-6">
				<h4>Get the news</h4>
				<p class="text-muted">
					Just my luck, no ice. Must go faster. You really think you can fly that thing? I was part of something special.
				</p>
				<form action="" method="post">
					<div class="input-group">
						<input type="text" class="form-control" name="email">
						<span class="input-group-btn">
							<input type="submit" value="subscribe" class="btn btn-danger">
						</span>
					</div>
				</form>
				<hr>
				<h4>Stay in touch</h4>
				<p class="social">
					<a href="#" class="fab fa-facebook"></a>
					<a href="#" class="fab fa-twitter"></a>
					<a href="#" class="fab fa-instagram"></a>
					<a href="#" class="fa fa-envelope"></a>
				</p>
			</div>
		</div>
	</div>
</div>

<div id="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<p class="float-md-left">&copy 2017 Julian Costinea</p>
			</div>
			<div class="col-md-6">
				<p class="float-md-right">Template by 
					<a href="https://www.facebook.com/julian.costinea">JCO Development</a></p>
			</div>
		</div>
	</div>
</div>