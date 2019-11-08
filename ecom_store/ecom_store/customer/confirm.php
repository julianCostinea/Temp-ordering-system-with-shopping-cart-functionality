<?php 
session_start();
 include 'includes/db.php';
 include 'functions/functions.php';
 if (isset($_GET['order_id'])) {
   $order_id=$_GET['order_id'];
 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce Store</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<!--font awesome fonts !-->
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">


</head>

<body>

	<!--Navbar !-->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #993F6C;">
  <a class="navbar-brand" href="index.php"><i class="fas fa-adjust"></i><strong>Store</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbartoggler"><i class="fas fa-bars"></i></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../shop.php">Shop</a>
      </li>
       <li class="nav-item">
        <a class="nav-link active" href="my_account.php">My account</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="../cart.php">Shopping Cart <i class="fa fa-shopping-cart"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../services.php">Services</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="../contact.php">Contact Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="get" action="results.php">
      <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit" value="search" name="search"><i class="fa fa-search"> </i></button>
    </form>
  </div>
</nav>


<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <?php
        include("includes/sidebar.php");
        ?>
      </div>
      <div class="col-md-9">
        <div class="box">
          <h1 align="center">Please Confirm Your Payment</h1>
          <form action="confirm.php?update_id=<?php echo $order_id;?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Invoice No:</label>
              <input type="text" name="invoice_no" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Amount Sent:</label>
              <input type="text" name="amount_sent" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Select Payment Mode:</label>
              <select name="payment_mode" class="form-control">
                <option>Select Payment Mode</option>
                <option>Western Union</option>
                <option>Bank Card</option>
                <option>PayPal</option>
              </select>
            </div>
            <div class="form-group">
              <label>Transaction/Refference ID:</label>
              <input type="text" name="ref_no" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Easy Paisa/Omni Code:</label>
              <input type="text" name="code" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Payment Date:</label>
              <input type="text" name="date" class="form-control" required="">
            </div>
            <div class="text-center mb-2">
              <button class="btn btn-danger" type="submit" name="confirm_payment">
                <i class="fa fa-user-md">Confirm Payment</i>
              </button>
            </div>
          </form>
          <?php
            if (isset($_POST['confirm_payment'])) {
               $update_id=$_GET['update_id'];
               $invoice_no=$_POST['invoice_no'];
               $amount=$_POST['amount_sent'];
               $payment_mode=$_POST['payment_mode'];
               $ref_no=$_POST['ref_no'];
               $code=$_POST['code'];
               $payment_date=$_POST['date'];
               $complete="Complete";
               $insert_payment="insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) values('$invoice_no','$amount','$payment_mode','$ref_no','$code','$payment_date')";
               $run_payment=mysqli_query($con, $insert_payment);
               $update_customer_order="update customer_orders set order_status='$complete' where order_id='$update_id'";
               $run_customer_order=mysqli_query($con,$update_customer_order);
               $update_pending_order="update pending_orders set order_status='$complete' where order_id='$update_id'";
               $run_pending_order=mysqli_query($con,$update_pending_order);
               if($run_pending_order){
                echo "<script>alert('Your Payment has been received')</script>";
                echo "<script>window.open('my_account.php?my_orders', '_self')</script>";
               }
             } 
           ?>
        </div>
      </div>
      </div>
    </div>
 </div>


<?php

  include("includes/footer.php");

?>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>