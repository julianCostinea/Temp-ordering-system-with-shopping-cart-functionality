<?php
session_start();
 include 'includes/db.php';
 include 'functions/functions.php';
 ?>

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
      Shopping Cart Total Price: <?php total_price() ?> Total Items: <?php items() ?>
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
        <a class="nav-link" href="customer/my_account.php">My account</a>
      </li>
       <li class="nav-item">
        <a class="nav-link active" href="cart.php">Shopping Cart <i class="fa fa-shopping-cart"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="services.php">Services</a>
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
    <div class="text-center">
     <a class="btn btn-secondary navbar-btn mr-2" href="cart.php"><!-- btn btn-primary navbar-btn right Starts -->

      <i class="fa fa-shopping-cart"></i>

      <span> <?php items() ?> items in cart </span>

    </a>
  </div>
    <form class="form-inline my-2 my-lg-0" method="get" action="results.php">
      <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-outline-light my-2 my-sm-0" 
      type="submit" value="search" name="search">
      <i class="fa fa-search"> </i></button>
    </form>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-md-9" id="cart">
      <div class="box text-left pl-3">
        <form action="cart.php" method="post" enctype="multipart/form-data">
          <h1>Shopping Cart</h1>
          <p class="text-muted">You currently have <?php items(); ?> item(s) in your cart.</p>
          <div class="table-responsive">
            <table class="table">
              <thead class="">
                <tr>
                  <th colspan="2">Product</th>
                  <th>Quantity</th>
                  <th>Unit price</th>
                  <th>Size</th>
                  <th colspan="1">Delete</th>
                  <th colspan="2">Sub Total</th>
                </tr>
              </thead>
              <tbody class="">
                <?php 
                  $total=0;
                  $ip_add=getRealUserIp();
                  $select_cart="select * from cart where ip_add='$ip_add'";
                  $run_cart=mysqli_query($con,$select_cart);
                  while ($row_cart=mysqli_fetch_array($run_cart)) {
                    $pro_id=$row_cart['p_id'];
                    $pro_size=$row_cart['size'];
                    $pro_qty=$row_cart['qty'];
                    $only_price=$row_cart['p_price'];
                    $get_products="select * from products where product_id='$pro_id'";
                    $run_producs=mysqli_query($con, $get_products);
                    while ($row_products=mysqli_fetch_array($run_producs)) {
                      $product_title=$row_products['product_title'];
                      $product_img1=$row_products['product_img1'];
                      $sub_total=$only_price*$pro_qty;
                      $_SESSION['pro_qty']=$pro_qty;
                      $total+=$sub_total;
                    
                ?>
                <tr>
                  <td>
                    <img src="admin_area/product_images/<?php echo $product_img1; ?>" class="img-fluid" style="max-width: 3rem">
                  </td>
                  <td>
                    <a href="#" style="text-decoration: none;color: #993F6C;font-weight: bold"> <?php echo $product_title; ?></a>
                  </td>
                  <td>
                    <input type="number"  name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-product-id="<?php echo $pro_id; ?>" class="quantity form-control">
                  </td>
                  <td>$<?php echo $only_price; ?></td>
                  <td><?php echo $pro_size; ?></td>
                  <td><input type="checkbox" name="remove[]"
                    value="<?php echo $pro_id; ?>"></td>
                  <td><?php echo $sub_total; ?>.00</td>
                </tr>
              <?php }} ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="6">Total</th>
                  <th colspan="1">$<?php echo $total; ?>.00</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="box-footer">
            <div class="float-left">
              <a href="index.php" class="btn btn-secondary">
                <i class="fa fa-chevron-left"></i> Continue shopping
              </a>
            </div>
            <div class="float-right">
              <button class="btn btn-secondary" type="submit" name="update" value="Update Cart">
              <i class="fas fa-sync-alt" aria-hidden="true"></i> Update Cart</button>
              <a href="checkout.php" class="btn btn-danger">
                Checkout <i class="fa fa-chevron-right"></i>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- col-md-9 -->


    <?php
      function update_cart(){
        global $con;
        if (isset($_POST['update'])) {
          foreach ($_POST['remove'] as $remove_id) {
            $delete_product="delete from cart where p_id='$remove_id'";
            $run_delete=mysqli_query($con,$delete_product);
            if ($run_delete) {
              echo "<script>window.open('cart.php','_self')</script>";
            }
          }
        }
      }
      echo @$up_cart=update_cart();
    ?>
    <div class="col-md-3">
      <div class="box" id="order-summary">
        <div class="box-header">
          <h3>Order Summary</h3>
        </div>
        <p class="text-muted"> Shipping and border taxes apply.</p>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td>Order Subtotal</td>
                <th>$<?php echo $total;?>.00</th>
              </tr>
              <tr>
                <td>Shipping and handling</td>
                <td>$0.00</td>
              </tr>
              <tr>
                <td>Tax</td>
                <th>$0.00</th>
              </tr>
              <tr class="Total">
                <td>Total</td>
                <th>$<?php echo $total; ?>.00</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> <!-- row -->

  <div class="row mt-4">
    <div class="col-md-11">
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
                    <p class='buttons text-center'>
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
    </div>
  </div>
</div> <!-- container ends -->

<?php

  include("includes/footer.php");

?>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript">
  $(document).ready(function(data){
    $(document).on('keyup', '.quantity', function(){
      var id=$(this).data("product-id");
      var quantity=$(this).val();
        if(quantity!=''){
          $.ajax({
            url:"change.php",
            method:"POST",
            data:{id:id, quantity:quantity},
            success:function(data){
              $("body").load('cart_body.php');
            }
          });
        }
    });
  });
</script>
</body>