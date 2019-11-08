<?php
$servername = "localhost";
$username = "root";
$password = "gowork66106500";
$db="test";

try {
	//On update, rowCount confirms when old value equals to new vale
    $con = new PDO("mysql:host=$servername;dbname=$db;charset=utf8", $username, $password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); 
    }
catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage();
    }

    $conn = mysqli_connect($servername, $username, $password, $db);
?>
