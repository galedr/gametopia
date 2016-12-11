<?php
ob_start();
session_start();
require_once('connectSQL.php');

if(!isset($_SESSION["GTopiaAdmin"])){
	if(isset($_POST["adminAccount"]) && isset($_POST["adminPassword"])){

		$adminAccount = $_POST["adminAccount"];
		$adminPassword = $_POST["adminPassword"];

		

		$adminQuery = "SELECT * FROM admin WHERE adminAccount = '$adminAccount'";
		
		$adminRec = $pdo->query($adminQuery);
		$adminRow = $adminRec->fetch(PDO::FETCH_ASSOC);

		

		if($adminAccount == $adminRow["adminAccount"] && $adminPassword == $adminRow["adminPassword"]){

			$_SESSION["GTopiaAdmin"] = $_SESSION["adminAccount"];

			echo "
					<script>
						location.href='../server_index.php';
					</script>
				 ";

		}else{

			echo "	
					<script>
						alert('您的帳號密碼有誤');
						history.go(-1);
					</script>
				 ";

		}

	}
}



?>