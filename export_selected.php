<?php 
		//get headers
		$new_column_names=array('order_id', 'order_school', 'order_date', 'order_uge_nummer', 'order_address', 'order_meeting', 'order_lokale', 'order_start_time', 'order_stop_time', 'order_shifts', 'order_fag', 'order_fakultet', 'order_kontakt', 'order_form', 'order_dokument' );
		$delimiter=';';

		$column_names=implode(', ', $new_column_names);

		header("Content-Type: text/csv");
		header("Content-disposition: attachment; filename=export.csv");
		$output = fopen("php://output", 'w');
		fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
		fputcsv($output,$new_column_names,$delimiter);
		  foreach($_POST['selected_orders'] as $order_id){
			$stmt = $con->prepare("SELECT {$column_names} FROM orders WHERE order_id = ?");
			$stmt->bindParam(1, $order_id);
			$stmt->execute();
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				fputcsv($output, $row, $delimiter);
			}
		}
		fclose($output);
 ?>