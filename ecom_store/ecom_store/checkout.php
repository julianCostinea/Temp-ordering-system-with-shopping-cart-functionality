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
<div id="top"><!-- top Starts -->

    <div class="container"><!-- container Starts -->
      <div class="row">

      <div class="col-md-6 offer"><!-- col-md-6 offer Starts -->

      <a href="#" class="btn btn-success btn-sm" >
      <?php

      if(!isset($_SESSION['customer_email'])){

      echo "Welcome: Guest";


      }else{

      echo "Welcome: " . $_SESSION['customer_email'] . "";

      }


      ?>
      </a>

      <a href="#">
      Shopping Cart Total Price: <?php total_price() ?> Total Items <?php items() ?>
      </a>

      </div><!-- col-md-6 offer Ends -->

      <div class="col-md-6 "><!-- col-md-6 Starts -->
      <ul class="menu"><!-- menu Starts -->

      <li>
      <a href="customer_register.php">
      Register
      </a>
      </li>

      <li>
      <?php

      if(!isset($_SESSION['customer_email'])){

      echo "<a href='checkout.php' >My Account</a>";

      }
      else{

      echo "<a href='customer/my_account.php?my_orders'>My Account</a>";

      }


      ?>
      </li>

      <li>
      <a href="cart.php">
      Go to Cart
      </a>
      </li>

      <li>
      <?php

      if(!isset($_SESSION['customer_email'])){

      echo "<a href='checkout.php'> Login </a>";

      }else {

      echo "<a href='logout.php'> Logout </a>";

      }

      ?>
      </li>

      </ul><!-- menu Ends -->

      </div><!-- col-md-6 Ends -->
    </div>

    </div><!-- container Ends -->
</div><!-- top Ends -->

	<!--Navbar !-->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #993F6C;">
  <a class="navbar-brand" href="index.php"><i class="fas fa-adjust"></i><strong>Store</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbartoggler"><i class="fas fa-bars"></i></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shop.php">Shop</a>
      </li>
       <li class="nav-item">
        <?php
          if (!isset($_SESSION['customer_email'])) {
            echo " <a class='nav-link' href='checkout.php'>My Account</a>";
           } 
           else {
            echo "<a class='nav-link' href='customer/my_account.php?my_orders'>My Account</a>";
           }
         ?>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="cart.php">Shopping Cart <i class="fa fa-shopping-cart"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="services.php">Services</a>
      </li>
       <li class="nav-item">
        <a class="nav-link active" href="contact.php">Contact Us</a>
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
      <div class="col-md-11">
        <div class="box">
              <?php 
                if(!isset($_SESSION['customer_email'])){
                  include("customer/customer_login.php");
                }
                else{
                  include("payment_options.php");
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