<?php 
	session_start();
	include 'db.php';
	$account_email=$_SESSION['client_email'];
	$stmt = $con->prepare('SELECT account_code FROM accounts WHERE account_email = :account_email');
	$stmt->bindParam(':account_email', $account_email);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$account_code = $row['account_code'];

	if (isset($_POST['amount'])) {
		$amount=$_POST['amount'];
	}
	else{
		$amount=2;
	}
	$per_page=$amount;
	    if (isset($_POST['page'])) {
	    	$page=$_POST['page'];
	    }					
	    else{
	    	$page=1;
	    }
	    $per_page=$amount;
	    $start_from=($page-1) * $per_page;
	if (!empty($_POST['search_field'])) {
				$search_field=$_POST['search_field'];
				$stmt=$con->prepare('SELECT * FROM orders WHERE school_code = :school_code AND (order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale)' );
				$stmt->bindValue(':order_address', '%'.$search_field.'%');
				$stmt->bindValue(':order_school', '%'.$search_field.'%');	
				$stmt->bindValue(':order_uge_nummer', '%'.$search_field.'%');
				$stmt->bindValue(':order_meeting', '%'.$search_field.'%');
				$stmt->bindValue(':order_fag', '%'.$search_field.'%');
				$stmt->bindValue(':order_fakultet', '%'.$search_field.'%');
				$stmt->bindValue(':order_kontakt', '%'.$search_field.'%');
				$stmt->bindValue(':order_form', '%'.$search_field.'%');
				$stmt->bindValue(':order_lokale', '%'.$search_field.'%');
				$stmt->bindParam(':school_code', $account_code);
			}
	else{
	    $stmt = $con->prepare('SELECT * FROM orders WHERE school_code = ? ORDER BY order_date');
	    $stmt->bindParam(1, $account_code);
	}
	    $stmt->execute();
	    $total_records=$stmt->rowCount();
	    $total_pages=ceil($total_records/$amount);

    
      $output= "<li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='1'>". 'First Page'. "</a></li>
      ";
      for($i=max(1, $page-2);$i<=min($page+2,$total_pages);$i++){
      	if ($i==$page) {
      		$output.= "
        <li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link active' href='$i'>". $i . "</a></li>
        ";
      	} else{
        $output.= "
        <li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='$i'>". $i . "</a></li>
        ";
    	}
      };
      $output.= "
        <li class='page-item'><a style='color:black; background-color:#f7f7f7;' class='page-link' href='$total_pages'>". 'Last Page' . "</a></li>
      ";
      echo $output;
      echo $total_records;
?>