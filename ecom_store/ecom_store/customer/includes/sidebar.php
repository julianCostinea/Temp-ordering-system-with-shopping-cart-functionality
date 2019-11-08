<div class="card sidebar-menu mb-4">
	<div class="card-header ">
		<?php 
			$customer_session=$_SESSION['customer_email'];
			$get_customer="select * from customers where customer_email='$customer_session'";
			$run_customer=mysqli_query($con,$get_customer);
			$row_customer=mysqli_fetch_array($run_customer);
			$customer_image=$row_customer['customer_image'];
			$customer_name=$row_customer['customer_name'];
			if (!isset($_SESSION['customer_email'])) {
				
			}
			else{
				echo "<img src='customer_images/$customer_image' class='img-fluid mb-2' style='margin: 0 auto'>
		<br>
		<h5 class='card-title mb-0 text-center'>Name: $customer_name</h5>";
			}
		 ?>
		
	</div>
	<div class="card-body">
		<ul class="nav nav-pills flex-column">
		  <li class="nav-item">
		    <a class="nav-link <?php if(isset($_GET['my_orders'])){echo "active";} ?>" href="my_account.php?my_orders">
		    	<i class="fa fa-list"> </i> My Orders</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link <?php if(isset($_GET['pay_offline'])){echo "active";} ?>" href="my_account.php?pay_offline">Pay Offline</a>
		  </li>
		  <li class="nav-item"> 
		    <a class="nav-link <?php if(isset($_GET['edit_account'])){echo "active";} ?>" href="my_account.php?edit_account">Edit Account</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link <?php if(isset($_GET['change_pass'])){echo "active";} ?>" href="my_account.php?change_pass">Change Password</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link <?php if(isset($_GET['wishlist'])){echo "active";} ?>" href="my_account.php?wishlist">Wishlist</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link <?php if(isset($_GET['delete_account'])){echo "active";} ?>" href="my_account.php?delete_account">Delete Account</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="logout.php">Log out</a>
		  </li>
		</ul>
	</div>
</div>

