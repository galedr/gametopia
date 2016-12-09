<?php
	//for localhost
	$dsn = "mysql:host=localhost;port=3306;dbname=gametopia;charset=utf8";
	$user = "root";
	$password = "0916177495";

	$pdo = new PDO($dsn,$user,$password);

	// $sql = "SELECT * FROM memberdata";
	// $memRec = $pdo->query($sql);
	// $memRow = $memRec->fetch(PDO::FETCH_ASSOC);

	// echo $memRow["memAccount"];

	//for 1&1 server
	// $dsn = "mysql:host=db658192905.db.1and1.com;port=3306;dbname=db658192905;charset=utf8";
	// $user = "dbo658192905";
	// $password = "0916177495";

	// $pdo = new PDO($dsn,$user,$password);
?>