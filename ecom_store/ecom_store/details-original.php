<?php
session_start();
 include 'includes/db.php';
 include 'functions/functions.php';
 ?>

 <?php 
  if (isset($_GET['pro_id'])) {
    $product_id=$_GET['pro_id'];
    $get_product="select * from products where product_id='$product_id'";
    $run_product=mysqli_query($con, $get_product);
    $row_product=mysqli_fetch_array($run_product);
    $p_cat_id=$row_product['p_cat_id'];
    $pro_title=$row_product['product_title'];
    $pro_price=$row_product['product_price'];
    $pro_desc=$row_product['product_desc'];
    $pro_img1=$row_product['product_img1'];
    $pro_img2=$row_product['product_img2'];
    $pro_img3=$row_product['product_img3'];
    $pro_label=$row_product['product_label'];
    $pro_psp_price=$row_product['product_psp_price'];
    $manufacturer_id=$row_product['manufacturer_id'];

    if (!empty($pro_label)) {
          $product_label= "<a class='label sale' href='#'> 
            <div class='thelabel'> $pro_label </div>
            <div class='label-background'> </div>
          </a>
          ";
        }
    if ($pro_label=="Sale") {
          $product_price="<del> $$pro_price </del>";
          $product_psp_price="$$pro_psp_price";
        }
        else{
          $product_psp_price="";
          $product_price="$$pro_price";
        }

        if (!empty($pro_label)) {
          $product_label= "<a class='label sale' href='#'> 
            <div class='thelabel'> $pro_label </div>
            <div class='label-background'> </div>
          </a>
          ";
        }

    $get_p_cat="select * from product_categories where p_cat_id='$p_cat_id'";
    $run_p_cat=mysqli_query($db,$get_p_cat);
    $row_p_cat=mysqli_fetch_array($run_p_cat);
    $p_cat_title=$row_p_cat['p_cat_title'];
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
        <a class="nav-link active" href="shop.php">Shop</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="customer/my_account.php">My account</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="cart.php">Shopping Cart <i class="fa fa-shopping-cart"></i></a>

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

    <a class="btn btn-secondary navbar-btn mr-2" href="cart.php"><!-- btn btn-primary navbar-btn right Starts -->

      <i class="fa fa-shopping-cart"></i>

      <span> <?php items() ?> items in cart </span>

    </a>
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
        <div class="row" id="productionMain">
          <div class="col-sm-6 mb-3">
           <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="img-fluid" src="admin_area/product_images/<?php echo $pro_img1; ?>" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="img-fluid" src="admin_area/product_images/<?php echo $pro_img2; ?>" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="img-fluid" src="admin_area/product_images/<?php echo $pro_img3; ?>" alt="Third slide">
              </div>
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
          <?php echo $product_label; ?>
          </div>
          <div class="col-sm-6">
            <div class="box">
              <h1 class="text-center"><?php echo $pro_title; ?></h1>
              <h3 class="text-center mb-3"><a href="shop.php?p_cat= <?php echo $p_cat_id; ?>"> ><?php echo $p_cat_title; ?></a></h3>
              <?php 
              add_cart();
              ?>
              <form action="details.php?add_cart=<?php echo $product_id; ?>" method="post">
                <div class="form-group row">
                  <label class="col-md-5 col-form-label">Product Quantity</label>
                  <div class="col-md-7">
                    <select name="product_qty" class="form-control" required>
                      <option value="">Select quantity</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-5 col-form-label">Product Size</label>
                  <div class="col-md-7">
                    <select name="product_size" class="form-control" required>
                      <option value="">Select a size</option>
                      <option>S</option>
                      <option>M</option>
                      <option>L</option>
                    </select>
                  </div>
                </div>
                <p class="price"><?php echo $product_price, $product_psp_price; ?></p>
                <p class="text-center buttons">
                  <button class="btn btn-danger" type="submit">
                    <i class="fa fa-shopping-cart"></i> Add to cart
                  </button>
                </p>
              </form>
            </div>
            <div class="row d-flex justify-content-center mb-3" id="thumbs">
              <div class="col-xs-4 img-thumbnail thumb">
                <a href="#" class="">
                  <img data-target="#carouselExampleIndicators" data-slide-to="0" src="admin_area/product_images/<?php echo $pro_img1; ?>" class="img-fluid" style="max-width: 7rem">
                </a>
              </div>
              <div class="col-xs-4 img-thumbnail thumb">
                <a href="#" class="">
                  <img data-target="#carouselExampleIndicators" data-slide-to="1" src="admin_area/product_images/<?php echo $pro_img2; ?>" class="img-fluid" style="max-width: 7rem">
                </a>
              </div>
              <div class="col-xs-4 img-thumbnail">
                <a href="#" >
                  <img data-target="#carouselExampleIndicators" data-slide-to="2" src="admin_area/product_images/<?php echo $pro_img3; ?>" class="img-fluid" style="max-width: 7rem">
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="box text-left pl-3" id="details">
          <p>
            <h4>Product Details</h4>
            <p>
              <?php echo $pro_desc; ?>
            </p>
            <h4>Size:</h4>
            <ul>
              <li>Small</li>
              <li>Medium</li>
              <li>Large</li>
            </ul>
          </p>
          <hr>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="box headline">
              <h3 class="">You might also like these products</h3>
            </div>
          </div>

          <?php 
            $get_products="select * from products order by RAND() LIMIT 0, 3";
            $run_products=mysqli_query($con, $get_products);
            while ($row_products=mysqli_fetch_array($run_products)) {
              $pro_id=$row_products['product_id'];
              $pro_title=$row_products['product_title'];
              $pro_price=$row_products['product_price'];
              $pro_img1=$row_products['product_img1'];
              $pro_label=$row_products['product_label'];
              $pro_psp_price=$row_products['product_psp_price'];
              $manufacturer_id=$row_products['manufacturer_id'];

              $get_manufacturer="select * from manufacturers where manufacturer_id='$manufacturer_id'";
              $run_manufacturer=mysqli_query($db,$get_manufacturer);
              $row_manufacturer=mysqli_fetch_array($run_manufacturer);
              $manufacturer_name=$row_manufacturer['manufacturer_title'];

              if ($pro_label=="Sale") {
                $product_price="<del> $$pro_price </del>";
                $product_psp_price="$$pro_psp_price";
              }
              else{
                $product_psp_price="";
                $product_price="$$pro_price";
              }

              if (!empty($pro_label)) {
                $product_label= "<a class='label sale' href='#'> 
                  <div class='thelabel'> $pro_label </div>
                  <div class='label-background'> </div>
                </a>
                ";
              }

              echo "
               <div class='col-sm-6 col-md-3 single'>
                <div class='product'>
                  <a href= 'details.php?pro_id=$pro_id'>
                  <img src='admin_area/product_images/$pro_img1' class='img-fluid'>
                  </a>
                  <div class='text'>
                    <div class='text-center mt-3'>
                    <p class='btn btn-primary'>$manufacturer_name</p> <hr>
                    </div>
                    <h4 class='mt-0'><a href='details.php?pro_id=$pro_id'> $pro_title </a></h4>
                    <p class='price'>$product_price $product_psp_price</p>
                    <p class='buttons'>
                      <a href='details.php?pro_id=$pro_id' class='btn btn-light'> 
                      View Details</a>
                      <a href='details.php?pro_id=$pro_id' class='btn btn-danger'>
                        <i class='fa fa-shopping-cart'></i> Add to Cart
                      </a>
                    </p>
                    </div>
                    $product_label
                </div>
               </div>
              ";
            }
          ?>
        </div>
      </div> <!-- col-md-9!-->
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