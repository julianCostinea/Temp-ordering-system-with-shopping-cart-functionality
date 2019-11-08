
<?php

        foreach($_POST['selected_orders'] as $selected){
          $statement = $con->prepare('DELETE FROM orders WHERE order_id = :order_id');
          $statement->bindParam(':order_id', $selected);
          $statement->execute();
        }
        $count=$statement->rowCount();
        if($count>0){
          echo "<script>alert('Bestilling(er) slettet.')</script>";
          echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
        }
         else{
          echo "<script>alert('Could not delete order.')</script>";
          echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
        }

 ?>
