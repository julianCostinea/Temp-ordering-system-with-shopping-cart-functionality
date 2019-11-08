<?php
	session_start();
	include 'db.php';
 			if (isset($_POST['amount'])) {
					$amount=$_POST['amount'];
					if ($amount=='Alle') {
						$amount=2000;
					}
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
	    $start_from=($page-1) * $per_page;
$account_email=$_SESSION['client_email'];
$stmt = $con->prepare('SELECT account_code FROM accounts WHERE account_email = :account_email');
$stmt->bindParam(':account_email', $account_email);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$account_code = $row['account_code'];


		if (!empty($_POST['search_field'])) {
				$search_field=$_POST['search_field'];
				$stmt=$con->prepare('SELECT * FROM orders WHERE school_code = :school_code AND (order_address LIKE :order_address OR order_school LIKE :order_school OR order_meeting LIKE :order_meeting OR order_uge_nummer LIKE :order_uge_nummer OR order_fag LIKE :order_fag OR order_fakultet LIKE :order_fakultet OR order_kontakt LIKE :order_kontakt OR order_form LIKE :order_form OR order_lokale LIKE :order_lokale) LIMIT :start_from, :amount' );
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
				$stmt->bindParam(':start_from',$start_from, PDO::PARAM_INT);
				$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
			}
			else{			
		
		$stmt = $con->prepare('SELECT * FROM orders WHERE school_code = ? ORDER BY order_date LIMIT ?, ?');
	  	$stmt->bindParam(1, $account_code);
	  	$stmt->bindParam(2, $start_from, PDO::PARAM_INT);
		$stmt->bindParam(3, $per_page, PDO::PARAM_INT);

	  		}
		$stmt->execute();
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$order_id = $row['order_id'];

		$sql_date = $row['order_date'];
		$created_date=date_create($sql_date);
			$order_date=date_format($created_date, 'd-m-Y');
			
		$order_uge_nummer = $row['order_uge_nummer'];
		$order_address = htmlspecialchars($row['order_address']);
		$order_meeting = htmlspecialchars($row['order_meeting']);
		$order_lokale = htmlspecialchars($row['order_lokale']);
		$order_start_time = $row['order_start_time'];
		$order_stop_time = $row['order_stop_time'];
		$order_shifts = $row['order_shifts'];
		$order_fag = htmlspecialchars($row['order_fag']);
		$order_fakultet = htmlspecialchars($row['order_fakultet']);
		$order_kontakt = htmlspecialchars($row['order_kontakt']);
		$short_kontakt=substr($order_kontakt, 0,20);
		$long_kontakt=substr($order_kontakt, 20);
		$order_form = $row['order_form'];

		$output="
		<tr>
			<td>$order_id</td>
			<td> $order_uge_nummer </td>
			<td> $order_date </td>
			<td>$order_address </td>
			<td> $order_meeting $order_lokale  </td>
			<td> $order_start_time </td>
			<td> $order_stop_time  </td>
			<td> $order_shifts </td>
			<td> $order_fag </td>
			<td> $order_fakultet </td>
			<td> <span class='kontakt'><span class='short_text'> $short_kontakt</span><span class='hidden'> $long_kontakt</span></span></td>
			<td>$order_form</td>
		</tr>
		";
		echo $output;
}
?>