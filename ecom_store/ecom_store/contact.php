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
          <div class="box-header">
            <div class="text-center">
              <?php 
                $get_contact_us="select * from contact_us";
                $run_contact=mysqli_query($con,$get_contact_us);
                $row_contact=mysqli_fetch_array($run_contact);
                $contact_header=$row_contact['contact_header'];
                $contact_desc=$row_contact['contact_desc'];
                $contact_email=$row_contact['contact_email'];
              ?>
            <h2><?php echo $contact_header; ?></h2>
            <p class="text-muted"> <?php echo $contact_desc; ?></p>
          </div>
        </div>
        <form action="contact.php" method="post" class="text-left ml-2">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="Email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="form-control"> </textarea>
          </div>
          <div class="form-group">
            <label for="enquiry_type">Select Enquiry Type</label>
            <select name="enquiry_type" class="form-control">
              <option value="">Select Enquiry Type</option>
              <?php 
                $get_enquiry="select * from enquiry_types";
                $run_enquiry=mysqli_query($con,$get_enquiry);
                while ($row_enquiry=mysqli_fetch_array($run_enquiry)) {
                  $enquiry_title=$row_enquiry['enquiry_title'];
                  echo "<option>$enquiry_title</option>";
                }
              ?>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" name="submit" class="btn btn-danger">
              <i class="fa fa-user-md"></i> Send Message
            </button>
          </div>
        </form>

        <?php
          if (isset($_POST['submit'])) {
            $sender_name=$_POST['name'];
            $sender_email=$_POST['email'];
            $sender_subject=$_POST['subject'];
            $sender_message=$_POST['message'];
            $enquiry_type=$_POST['enquiry_type'];
            $new_message=" <h1> This message has been sent by $sender_name</h1>
            <p>Sender: $sender_email</p>
            <p>Subject:$sender_subject</p>
            <p>Enquiry:$enquiry_type</p>
            <p>Message:$sender_message</p>
            ";

            $headers="From $sender_email\r\n";
            $headers.="Content-type: text/html\r\n";

            mail($contact_email,$sender_subject,$new_message, $headers);
            $email=$_POST['email'];
            $subject="Welcome to my website";
            $msg="We get back to you";
            $from="julian.costinea@gmail.com";
            mail($email,$subject,$msg,$from);
            echo "<h2 class=text-center>Email has been sent</h2>"; 
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