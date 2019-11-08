<?php
  session_start(); 
  include("includes/db.php");
  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
  }
 ?>

 <?php
  $admin_session=$_SESSION['admin_email'];
  $get_admin="select * from admins where admin_email='$admin_session'";
  $run_admin=mysqli_query($con, $get_admin);
  $row_admin=mysqli_fetch_array($run_admin);
  $admin_id=$row_admin['admin_id']; 
  $admin_name=$row_admin['admin_name']; 
  $admin_email=$row_admin['admin_email']; 
  $admin_image=$row_admin['admin_image']; 
  $admin_country=$row_admin['admin_country']; 
  $admin_job=$row_admin['admin_job']; 
  $admin_contact=$row_admin['admin_contact']; 
  $admin_about=$row_admin['admin_about']; 

  $get_products="select * from products";
  $run_products=mysqli_query($con,$get_products);
  $count_products=mysqli_num_rows($run_products);

  $get_customers="select * from customers";
  $run_customers=mysqli_query($con,$get_customers);
  $count_customers=mysqli_num_rows($run_customers);

  $get_p_categories="select * from product_categories";
  $run_p_categories=mysqli_query($con,$get_p_categories);
  $count_p_categories=mysqli_num_rows($run_p_categories);

  $get_pending_orders="select * from pending_orders";
  $run_pending_orders=mysqli_query($con,$get_pending_orders);
  $count_pending_orders=mysqli_num_rows($run_pending_orders);
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ecommerce Store</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<!--font awesome fonts !-->
	<link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">
  <link href="js/jquery-ui.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  

</head>

<body>
	<!--Navbar !-->
	<nav class="navbar navbar-expand-lg navbar-dark mb-0" style="background-color: black;">
  <a class="navbar-brand mr-4" href="index.php?dashboard"><i class="fas fa-adjust"></i><strong>Admin Panel</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbartoggler"><i class="fas fa-bars"></i></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
      <ul class="navbar-nav ml-auto align-right">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $admin_name;  ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?user_profile=<?php echo $admin_id; ?>">Profile</a>
          <a class="dropdown-item" href="index.php?view_products">Products <span class="badge badge-secondary"><?php echo $count_products; ?></span></a>
          <a class="dropdown-item" href="index.php?view_customers">Customers <span class="badge badge-secondary"><?php echo $count_customers; ?></span></a>
          <a class="dropdown-item" href="index.php?view_p_cats">Product Categories <span class="badge badge-secondary"><?php echo $count_p_categories; ?></span></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
  <div class="row">
    <div class="col-md-3">
         <?php
          include("includes/sidebar.php");
          ?>
        </div>
  <div class="col-md-9">
    <?php
      if (isset($_GET['dashboard'])) {
        include("dashboard.php");
      }
      if (isset($_GET['insert_product'])) {
        include("insert_product.php");
      }
      if (isset($_GET['view_products'])) {
        include("view_products.php");
      }
      if (isset($_GET['delete_product'])) {
        include("delete_product.php");
      }
      if (isset($_GET['edit_product'])) {
        include("edit_product.php");
      }
       if (isset($_GET['insert_p_cat'])) {
        include("insert_p_cat.php");
      }
      if (isset($_GET['view_p_cats'])) {
        include("view_p_cats.php");
      }
      if (isset($_GET['delete_p_cat'])) {
        include("delete_p_cat.php");
      }
      if (isset($_GET['edit_p_cat'])) {
        include("edit_p_cat.php");
      }
       if (isset($_GET['insert_cat'])) {
        include("insert_cat.php");
      }
      if (isset($_GET['view_cats'])) {
        include("view_cats.php");
      }
      if (isset($_GET['delete_cat'])) {
        include("delete_cat.php");
      }
      if (isset($_GET['edit_cat'])) {
        include("edit_cat.php");
      }
      if (isset($_GET['insert_slide'])) {
        include("insert_slide.php");
      }
      if (isset($_GET['view_slides'])) {
        include("view_slides.php");
      }
      if (isset($_GET['delete_slide'])) {
        include("delete_slide.php");
      }
      if (isset($_GET['edit_slide'])) {
        include("edit_slide.php");
      }
      if (isset($_GET['view_customers'])) {
        include("view_customers.php");
      }
      if (isset($_GET['customer_delete'])) {
        include("customer_delete.php");
      }
      if (isset($_GET['view_orders'])) {
        include("view_orders.php");
      }
      if (isset($_GET['order_delete'])) {
        include("order_delete.php");
      }
      if (isset($_GET['view_payments'])) {
        include("view_payments.php");
      }
      if (isset($_GET['payment_delete'])) {
        include("payment_delete.php");
      }
      if (isset($_GET['insert_user'])) {
        include("insert_user.php");
      }
      if (isset($_GET['view_users'])) {
        include("view_users.php");
      }
      if (isset($_GET['user_delete'])) {
        include("user_delete.php");
      }
      if (isset($_GET['user_profile'])) {
        include("user_profile.php");
      }
      if (isset($_GET['insert_box'])) {
        include("insert_box.php");
      }
      if (isset($_GET['view_boxes'])) {
        include("view_boxes.php");
      }
      if (isset($_GET['delete_box'])) {
        include("delete_box.php");
      }
      if (isset($_GET['edit_box'])) {
        include("edit_box.php");
      }
      if (isset($_GET['insert_term'])) {
        include("insert_term.php");
      }
      if (isset($_GET['view_terms'])) {
        include("view_terms.php");
      }
      if (isset($_GET['delete_term'])) {
        include("delete_term.php");
      }
      if (isset($_GET['edit_term'])) {
        include("edit_term.php");
      }
      if (isset($_GET['edit_css'])) {
        include("edit_css.php");
      }
      if (isset($_GET['insert_manufacturer'])) {
        include("insert_manufacturer.php");
      }
      if (isset($_GET['view_manufacturers'])) {
        include("view_manufacturers.php");
      }
      if (isset($_GET['delete_manufacturer'])) {
        include("delete_manufacturer.php");
      }
      if (isset($_GET['edit_manufacturer'])) {
        include("edit_manufacturer.php");
      }
      if (isset($_GET['insert_coupon'])) {
        include("insert_coupon.php");
      }
      if (isset($_GET['view_coupons'])) {
        include("view_coupons.php");
      }
      if (isset($_GET['delete_coupon'])) {
        include("delete_coupon.php");
      }
      if (isset($_GET['edit_coupon'])) {
        include("edit_coupon.php");
      }
      if (isset($_GET['insert_icon'])) {
        include("insert_icon.php");
      }
      if (isset($_GET['view_icons'])) {
        include("view_icons.php");
      }
      if (isset($_GET['delete_icon'])) {
        include("delete_icon.php");
      }
      if (isset($_GET['edit_icon'])) {
        include("edit_icon.php");
      }
      if (isset($_GET['insert_bundle'])) {
        include("insert_bundle.php");
      }
      if (isset($_GET['view_bundles'])) {
        include("view_bundles.php");
      }
      if (isset($_GET['delete_bundle'])) {
        include("delete_bundle.php");
      }
      if (isset($_GET['edit_bundle'])) {
        include("edit_bundle.php");
      }
      if (isset($_GET['insert_relation'])) {
        include("insert_relation.php");
      }
      if (isset($_GET['view_relations'])) {
        include("view_relations.php");
      }
      if (isset($_GET['delete_relation'])) {
        include("delete_relation.php");
      }
      if (isset($_GET['edit_relation'])) {
        include("edit_relation.php");
      }
      if (isset($_GET['send_bestilling'])) {
        include("send_bestilling.php");
      }
      if (isset($_GET['alle_bestillinger'])) {
        include("alle_bestillinger.php");
      }
      if (isset($_GET['delete_bestilling'])) {
        include("delete_bestilling.php");
      }
      if (isset($_GET['edit_contact_us'])) {
        include("edit_contact_us.php");
      }
      if (isset($_GET['insert_enquiry'])) {
        include("insert_enquiry.php");
      }
      if (isset($_GET['view_enquiries'])) {
        include("view_enquiries.php");
      }
      if (isset($_GET['delete_enquiry'])) {
        include("delete_enquiry.php");
      }
      if (isset($_GET['edit_enquiry'])) {
        include("edit_enquiry.php");
      }
      if (isset($_GET['edit_about_us'])) {
        include("edit_about_us.php");
      }
      if (isset($_GET['insert_service'])) {
        include("insert_service.php");
      }
      if (isset($_GET['view_services'])) {
        include("view_services.php");
      }
      if (isset($_GET['delete_service'])) {
        include("delete_service.php");
      }
      if (isset($_GET['edit_service'])) {
        include("edit_service.php");
      }
     ?>

  </div>
   </div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>
