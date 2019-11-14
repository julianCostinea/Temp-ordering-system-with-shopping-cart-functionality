<?php 
	include("db.php");
	$sql="DELETE FROM completed_orders WHERE order_date < CURDATE()";
	$statement = $con->prepare($sql);
	$statement->execute();

	$count=$statement->rowCount();

	if ($count) {
		echo "succ";
	}else{
		echo "bad";
	}

 ?>