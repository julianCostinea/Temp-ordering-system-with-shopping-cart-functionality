<?php
	include("db.php");
	$test_title="title_1";
	$stmt = $con->prepare('SELECT test_title FROM test_table WHERE test_title = :test_title');
	$stmt->bindParam(':test_title', $test_title);
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	    echo $row['test_title'] . "<br>";
	}
	$stmt=null;
?>