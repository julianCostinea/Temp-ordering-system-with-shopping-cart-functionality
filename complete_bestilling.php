
<?php 
			  foreach($_POST['selected_orders'] as $order_id){
		          $statement = $con->prepare('SELECT * FROM orders WHERE order_id = :order_id');
		          $statement->bindParam(':order_id', $order_id);
		          $statement->execute();

	        	  $row = $statement->fetch(PDO::FETCH_ASSOC);

				 $order_date = $row['order_date'];

				  $order_uge_nummer = $row['order_uge_nummer'];
				  $order_send_date = $row['order_send_date'];
			      $order_address = htmlspecialchars($row['order_address']);
				  $order_meeting = htmlspecialchars($row['order_meeting']);
			      $order_lokale = htmlspecialchars($row['order_lokale']);
				  $order_start_time = $row['order_start_time'];
				  $order_stop_time = $row['order_stop_time'];
				  $order_shifts = $row['order_shifts'];
				  $order_fag = htmlspecialchars($row['order_fag']);
				  $order_fakultet = htmlspecialchars($row['order_fakultet']);
				  $order_kontakt = htmlspecialchars($row['order_kontakt']);
			      $order_form = $row['order_form'];
				  $order_school = $row['order_school'];
				  $school_code = $row['school_code'];

				  $statement=$con->prepare('INSERT INTO completed_orders (order_id, order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_school, school_code) VALUES (:order_id, :order_date, :order_uge_nummer, :order_send_date,  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_school, :school_code)');
				  $statement->execute([
				  	'order_id'=>$order_id,
					'order_date'=>$order_date,
					'order_uge_nummer'=>$order_uge_nummer,
					'order_address'=>$order_address,
					'order_meeting'=>$order_meeting,
					'order_lokale'=>$order_lokale,
					'order_send_date'=>$order_send_date,
					'order_start_time'=>$order_start_time,
					'order_stop_time'=>$order_stop_time,
					'order_shifts'=>$order_shifts,
					'order_fag'=>$order_fag,
					'order_fakultet'=>$order_fakultet,
					'order_kontakt'=>$order_kontakt,
					'order_form'=>$order_form,
					'order_school'=>$order_school,
					'school_code'=>$school_code
				]);
			}
			$count=$statement->rowCount();	

			if ($count>0) {
				foreach($_POST['selected_orders'] as $order_id){
				$statement = $con->prepare('DELETE FROM orders WHERE order_id = :order_id');
		      	$statement->bindParam(':order_id', $order_id);
				$statement->execute();
			}

				$countDelete=$statement->rowCount();
				if($countDelete>0){
		 		echo "<script>alert('Bestilling(er) markeret som fuldført')</script>";
		 		echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
		 	}
		 	else{
		 		echo "<script>alert('Could not delete order from active table!')</script>";
		 	}
		}
 ?>
