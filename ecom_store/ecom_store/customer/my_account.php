<?php
session_start();
 include 'includes/db.php';
 include 'functions/functions.php';
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
        <?php
          if (!isset($_SESSION['customer_email'])) {
            echo " <a class='nav-link' href='../checkout.php'>My Account</a>";
           } 
           else {
            echo "<a class='nav-link' href='my_account.php?my_orders'>My Account</a>";
           }
         ?>
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

<div class="col-md-12">
  <?php 
    $c_email=$_SESSION['customer_email'];
    $get_customer="select * from customers where customer_email='$c_email'";
    $run_customer=mysqli_query($con,$get_customer);
    $row_customer=mysqli_fetch_array($run_customer);
    $customer_confirm_code=$row_customer['customer_confirm_code'];

    if (!empty($customer_confirm_code)) {
      ?>
      <div class="alert alert-danger text-center">
        <strong>Email not confirmed!  <a href="my_account.php?send_email" class="alert-link"> Resend mail</a></strong>
      </div>
    <?php } ?>
</div>


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
          <?php
            if (isset($_GET[$customer_confirm_code])) {
              $update_customer="update customers set customer_confirm_code='' where customer_confirm_code='$customer_confirm_code'";
              $run_confirm=mysqli_query($con, $update_customer);
              echo "<script>alert('Email has been confirmed.')</script>";
              echo "<script>window.open('my_account.php?my_orders','_self')</script>";
            }
            if (isset($_GET['send_email'])) {
                include("send_email.php");
            }
          ?>
          <?php
          if (isset($_GET['my_orders'])) {
            include("my_orders.php");
          }
          if (isset($_GET['pay_offline'])){
            include("pay_offline.php");
          }
          if (isset($_GET['edit_account'])) {
            include("edit_account.php");
          }
          if (isset($_GET['change_pass'])) {
            include("change_pass.php");
          }
          if (isset($_GET['delete_account'])) {
            include("delete_account.php");
          }
          if (isset($_GET['wishlist'])) {
            include("wishlist.php");
          }
          if (isset($_GET['delete_wishlist'])) {
            include("delete_wishlist.php");
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