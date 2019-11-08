                  <?php
                  $subject="Email Confirmation message";
                  $from="Julian Costinea";
                  $message="
                    <h2>Email code:</h2>
                    <a href='localhost/ecom_store/customer/my_account.php?$customer_confirm_code'> Click here to confirm </a>
                  ";
                  $headers="From:$from\r\n";
                  $headers.="Content-type:text/html\r\n";
                  mail($c_email, $subject, $message, $headers);
                  echo "<script>alert('Email has been resent.')</script>";
                  echo "<script>window.open('my_account.php?my_orders','_self')</script>";
                  ?>