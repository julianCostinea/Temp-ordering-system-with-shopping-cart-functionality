<?php
	session_start(); 
	include("db.php");
	if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
?>
<?php 
	//get headers
	$header_sql = "SHOW COLUMNS FROM orders";
	$header_result = $con->query($header_sql);
	$column_names=array();
	while($header_row = $header_result->fetch()){
		array_push($column_names, $header_row['Field']);
	}
	$delimiter=';';

	header("Content-Type: text/csv");
	header("Content-disposition: attachment; filename=export.csv");
	$output = fopen("php://output", 'w');
	fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
	fputcsv($output,$column_names,$delimiter);
	$sql='SELECT * FROM orders';
	$result=$con->query($sql);
	while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
		fputcsv($output, $row, $delimiter);
	}
	fclose($output);

	
 ?>
