
<?php 
		//get headers
		$header_sql = "SHOW COLUMNS FROM orders";
		$header_result = $con->query($header_sql);
		$column_names=array();
		while($header_row = $header_result->fetch()){
			array_push($column_names, $header_row['Field']);
		}
		$delimiter=',';

		header("Content-Type: text/csv");
		header("Content-disposition: attachment; filename=export.csv");
		$output = fopen("php://output", 'w');
		fputcsv($output,$column_names,$delimiter);
		  foreach($_POST['selected_orders'] as $order_id){
			$stmt = $con->prepare("SELECT * FROM orders WHERE order_id = ?");
			$stmt->bindParam(1, $order_id);
			$stmt->execute();
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				fputcsv($output, $row, $delimiter);
			}
		}
		fclose($output);
	

	
 ?>
