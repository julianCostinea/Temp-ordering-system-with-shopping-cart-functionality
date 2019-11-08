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
	<link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">

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
					      }
					      else {
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
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="services.php">Services</a>
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

<!--Carousel !-->
<div class="container ">
<div class="col-md-12 d-none d-md-block ">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	  	<?php
			$get_slides = "select * from slider LIMIT 0,1";
			$run_slides = mysqli_query($con,$get_slides);

			while($row_slides=mysqli_fetch_array($run_slides)){
				$slide_name = $row_slides['slide_name'];
				$slide_image = $row_slides['slide_image'];
				$slide_url=$row_slides['slide_url'];

				echo "
					<div class='carousel-item active'>
						<a href='$slide_url'><img class='d-block w-100' src='admin_area/slides_images/$slide_image' alt='First slide'> </a>
					</div>";
			}
		?>

		<?php

			$get_slides = "select * from slider LIMIT 1,2 ";
			$run_slides = mysqli_query($con,$get_slides);

			while($row_slides = mysqli_fetch_array($run_slides)) {
			$slide_name = $row_slides['slide_name'];
			$slide_image = $row_slides['slide_image'];
			$slide_url=$row_slides['slide_url'];

			echo "
			<div class='carousel-item'>
			<a href='$slide_url'><img src='admin_area/slides_images/$slide_image' class='d-block w-100'></a>
			</div>";
			}
		?>

	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</div>
</div>

<!--Jumbotron for small device !-->
<div class="container">
<div class="jumbotron d-md-none">
	<h2> Latest male fashion</h2>
</div>
</div>

<div id="advantages">
	<div class="container">
		<div class="row equal">
			<?php
				$get_boxes="select * from boxes_section";
				$run_boxes=mysqli_query($con,$get_boxes);
				while ($row_boxes=mysqli_fetch_array($run_boxes)) {
				$box_id=$row_boxes['box_id'];
				$box_title=$row_boxes['box_title'];
				$box_desc=$row_boxes['box_desc'];

			?>
			<div class="col-sm-4 ">
				<div class="advantage">
					<div class="icon">
						<i class="fa fa-heart"></i>
					</div>
					<h3><?php echo $box_title; ?></h3>
					<p><?php echo $box_desc; ?></p>
				</div>
			</div>
			<?php
				} 
			 ?>
		</div>
	</div>
	</div>

<div id="hot">
	<div class="box">
	<div class="container">
		<div class="col-md-12">
			<h1>Latest releases</h1>
		</div>
	</div>
	</div>
</div>

<div id="content" class="container mb-2">
	<div class="row">
		<?php 
			getPro();
		 ?>
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