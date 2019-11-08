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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>


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
        <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shop.php">Shop</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="customer/my_account.php">My account</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="cart.php">Shopping Cart <i class="fa fa-shopping-cart"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="services.php">Services</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
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
          <div class="box-header">
            <div class="text-center">
            <h2>Register a new account</h2>
          </div>
        </div>
        <form action="customer_register.php" method="post" class="text-left ml-2" enctype="multipart/form-data" name="registration_form" id="registration_form">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="c_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="Email" name="c_email" class="form-control required email" title="y so sad">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="c_pass" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Country</label>
            <input type="text" name="c_country" class="form-control" required>
          </div>
          <div class="form-group">
            <label>City</label>
            <input type="text" name="c_city" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Contact</label>
            <input type="text" name="c_contact" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="c_address" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Image:</label>
            <input type="file" name="c_image">
          </div>
          <div class="my-2" style="width: 20rem; margin: 0 auto;">
            <div class="g-recaptcha" data-sitekey="6LchY7gUAAAAAJeH1_s0bbLs1gaVHfQmRJgWFbWa"></div>
          </div>
          <div class="text-center">
            <button type="submit" name="register" id="register" class="btn btn-danger">
              <i class="fa fa-user-md"></i> Register
            </button>
          </div>
        </form>
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
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>

<?php
  if (isset($_POST['register'])) {
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];
    $c_ip=getRealUserIp();

    move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

    $get_email="select * from customers where customer_email='$c_email'";
    $run_email=mysqli_query($con, $get_email);
    $check_email=mysqli_num_rows($run_email);

    if ($check_email>=1) {
      echo "<script>alert('Email address already in use.')</script>";
      exit();
    }

    $customer_confirm_code=mt_rand();
    $subject="Email Confirmation message";
    $from="Julian Costinea";
    $message="
      <h2>Email code:</h2>
      <a href='localhost/ecom_store/customer/my_account.php?$customer_confirm_code'> Click here to confirm </a>
    ";
    $headers="From:$from\r\n";
    $headers.="Content-type:text/html\r\n";
    mail($c_email, $subject, $message, $headers);

    $insert_customer="insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip, customer_confirm_code) values ('$c_name','$c_email','$c_pass','$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$c_ip', '$customer_confirm_code')";
    $run_customer=mysqli_query($con,$insert_customer);

    $sel_cart="select * from cart where ip_add='$c_id";
    $run_cart=mysqli_query($con,$sel_cart);
    $check_cart=mysqli_num_rows($run_cart);
    if($check_cart>0){
      $_SESSION['customer_email']=$c_email;
      echo "<script>alert('You are registered')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";
      }
      else{
      $_SESSION['customer_email']=$c_email;
      echo "<script>alert('You are registered')</script>";
      echo "<script>window.open('index.php','_self')</script>";
      }

  }
?>