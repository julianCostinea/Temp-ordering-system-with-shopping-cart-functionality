<?php
	session_start(); 
	include("db.php");
	if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
?>
<?php 
if (!empty($_POST['selected_orders'])) {

	if (isset($_POST['submit'])) {
		include_once 'complete_bestilling.php';
	}
	elseif (isset($_POST['export'])) {
		include_once 'export_selected.php';
	}
	elseif (isset($_POST['delete'])) {
		include_once 'delete_aktiv_order.php';
	}
}
else{
		echo "<script>alert('No order selected!')</script>";
		echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
	}

 ?>