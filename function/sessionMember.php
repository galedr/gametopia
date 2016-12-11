<?php
ob_start();
session_start();
require_once("connectSQL.php");

$preUrl = $_SERVER["HTTP_REFERER"];


if(!isset($_SESSION["GTopiaAccount"]) || !isset($_SESSION["GTopiaMemLevel"])){
	if(isset($_POST["memAccount"]) && isset($_POST["memPassword"])){

		$memAccount = $_POST["memAccount"];
		$memPassword = $_POST["memPassword"];

		$memQuery = "SELECT * FROM memberdata WHERE memAccount = :memAccount";
		$memRec = $pdo->prepare($memQuery);
		$memRec->bindValue(":memAccount",$memAccount);
		$memRec->execute();

		$memRow = $memRec->fetch(PDO::FETCH_ASSOC);

		if($memAccount == $memRow["memAccount"] && $memPassword == $memRow["memPassword"]){

			$_SESSION["GTopiaAccount"] = $memAccount;
			$_SESSION["GTopiaMemLevel"] = $memRow["memLevel"];

			header("location: $preUrl");

			// echo "
			// 	<script>
			// 		history.go(-1);
			// 	</script>
			// ";

		}else{

			
			echo "
				<script>
					alert('您輸入的帳號密碼不對喔');
					history.go(-1);
					location.reload();
				</script>				
			";

		}

	}
}
?>