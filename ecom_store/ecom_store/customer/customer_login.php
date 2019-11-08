<div class="box-header">
	<div class="text-center">
		<h1>Login</h1>
		<p class="lead">Already a customer?</p>
	</div>
</div>
<form action="checkout.php" method="post" class="text-left ml-1">
	<div class="form-group">
       <label for="c_email">Email</label>
        <input type="Email" name="c_email" class="form-control" required>
     </div>
     <div class="form-group">
     	<label for="c_pass">Password</label>
        <input type="Password" name="c_pass" class="form-control" required>
        <h5 class="text-center mt-2">
        	<a href="forgot_pass.php">Forgot Password?</a>
        </h5>
    </div>
    <div class="text-center mb-3">
         <button type="submit" name="login" class="btn btn-danger">
          <i class="fa fa-user-md"></i> Login
         </button>
    </div>
</form>
<div class="text-center">
	<a href="customer_register.php">
		<h3>Not a customer? Register here </h3>
	</a>
</div>

<?php
	if (isset($_POST['login'])) {
	 	$customer_email=$_POST['c_email'];
	 	$customer_pass=$_POST['c_pass'];
	 	$select_customer="select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";
	 	$run_customer=mysqli_query($con,$select_customer);
	 	$get_ip=getRealUserIp();
	 	$check_customer=mysqli_num_rows($run_customer);
	 	$select_cart="select * from cart where ip_add='$get_ip'";
	 	$run_cart=mysqli_query($con,$select_cart);
	 	$check_cart=mysqli_num_rows($run_cart);
	 	if ($check_customer==0) {
	 		echo "<script>alert('Email or password is wrong')</script>";
	 		exit();
	 	}

	 	if ($check_customer==1 AND $check_cart==0) {
	 		$_SESSION['customer_email']=$customer_email;
	 		echo "<script>alert('You are logged in')</script>";
	 		echo "<script>window.open('customer/my_account.php?my_orders', '_self')</script>";
	 	}
	 	else {
	 		$_SESSION['customer_email']=$customer_email;
	 		echo "<script>alert('You are logged in')</script>";
	 		echo "<script>window.open('checkout.php', '_self')</script>";
	 	}
	 } 
 ?>