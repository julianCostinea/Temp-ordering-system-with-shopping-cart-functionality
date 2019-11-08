<?php 
   session_start(); 
   include("db.php");
   if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
?>

<?php
      if (isset($_POST['submit'])) {
      if (!empty($_POST['selected_orders'])) {
        foreach($_POST['selected_orders'] as $selected){
          $statement = $con->prepare('DELETE FROM completed_orders WHERE order_id = :order_id');
          $statement->bindParam(':order_id', $selected);
          $statement->execute();
        }
        $count=$statement->rowCount();
        if($count>0){
          echo "<script>alert('Bestilling(er) slettet.')</script>";
          echo "<script>window.open('view_completed_bestillinger_gowork.php','_self')</script>";
        }
         else{
          echo "<script>alert('Could not delete order.')</script>";
          echo "<script>window.open('view_completed_bestillinger_gowork.php','_self')</script>";
        }
   	  }
    else{
      echo "<script>alert('No orders selected.')</script>";
      echo "<script>window.open('view_completed_bestillinger_gowork.php','_self')</script>";
    }
  }
 ?>
