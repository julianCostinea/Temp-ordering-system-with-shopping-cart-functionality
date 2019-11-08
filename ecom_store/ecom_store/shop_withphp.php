<?php
 include 'includes/db.php';
 include 'functions/functions.php';
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce Store</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="js/jquery-ui.min.css">
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
        <?php 
            if(!isset($_GET['p_cat'])){
            echo "<div class='boxes mb-4'>
          <h1>Shop</h1>
          <hr>
          <p>
            Is this my espresso machine? Wh-what is-h-how did you get my espresso machine? We gotta burn the rain forest, dump toxic waste, pollute the air, and rip up the OZONE! 'Cause maybe if we screw up this planet enough, they won't want it anymore! Life finds a way.
          </p>
        </div>";
          }
         ?>
        
        <div class="row">
          <?php
            if(!isset($_GET['p_cat'])){
              if(!isset($_GET['cat'])){
                $per_page=6;
                if (isset($_GET['page'])) {
                  $page=$_GET['page'];
                }
                else {
                  $page=1;
                }
                $start_from=($page-1) * $per_page;
                $get_products="select * from products order by 1 DESC 
                LIMIT $start_from, $per_page";
                $run_products=mysqli_query($con,$get_products);
                while ($row_products=mysqli_fetch_array($run_products)) {
                  $pro_id=$row_products['product_id'];
                  $pro_title=$row_products['product_title'];
                  $pro_price=$row_products['product_price'];
                  $pro_img1=$row_products['product_img1'];
                  echo "
                  <div class='col-md-4 col-sm-6'>
                    <div class='product'>
                      <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_img1' class='img-fluid'>
                      </a>
                      <div class='text'>
                        <h4><a href='details.php?pro_id=$pro_id'> $pro_title</a></h4>
                        <p class='price'>$$pro_price </p>
                        <p class='buttons'>
                          <a href='details.php?pro_id=$pro_id' class='btn btn-light'> View Details</a>
                          <a href='details.php?pro_id=$pro_id' class='btn btn-danger'>
                            <i class='fa fa-shopping-cart'></i> Add to Cart
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                  ";
                }

          ?>
          
           
        </div>
        <div class="d-flex justify-content-center mb-3">
        <ul class="pagination mt-4">
          <?php 
            $query="select * from products";
            $result=mysqli_query($con,$query);
            $total_records=mysqli_num_rows($result);
            $total_pages=ceil($total_records/$per_page);
              echo "<li class='page-item'><a class='page-link' href='shop_withphp.php?page=1'>". 'First Page'. "</a></li>
              ";
              for($i=1;$i<=$total_pages;$i++){
                echo "
                <li class='page-item'><a class='page-link' href='shop_withphp.php?page=".$i."'>". $i . "</a></li>
                ";
              };
              echo "
                <li class='page-item'><a class='page-link' href='shop_withphp.php?page=".$total_pages."'>". 'Last Page' . "</a></li>
              ";
                                  }
                                  }
           ?>
        </ul>
        </div>
          <div class="row">
                  <?php 
          getPCatPro();
          getCatPro()
           ?>
          </div>
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
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>