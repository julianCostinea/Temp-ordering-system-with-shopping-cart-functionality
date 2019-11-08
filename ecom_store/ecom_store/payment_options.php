<?php 
	$session_email=$_SESSION['customer_email'];
	$select_customer="select * from customers where customer_email='$session_email'";
	$run_customer=mysqli_query($con, $select_customer);
	$row_customer=mysqli_fetch_array($run_customer);
	$customer_id=$row_customer['customer_id'];
 ?>
	<div class="text-center">
		<h1>Payment options</h1>
		<p class="lead">
			<a href="order.php?c_id=<?php echo $customer_id;?>">Pay Offline</a>
		</p>
		<form action="" method="post">
			
		</form>
	</div>