<?php 
	ob_start();
	session_start();
	try{
		if( isset($_SESSION["GTopiaAccount"])){
			$memName = $_SESSION["GTopiaAccount"];
		}else{
			$memName = "Guest";
		}
		require_once("connectSQL.php");
		$sql_addReply = 'INSERT INTO com_reply (comId, memAcc, replyContent, replyDate) VALUES (:comId, :memAcc, :replyContent, :replyDate)';

		$replyDate = date("y-m-d");

		$stmt = $pdo->prepare( $sql_addReply );
		$stmt->bindValue(":memAcc", $memName);
		$stmt->bindValue(":comId", $_REQUEST['comId']);
		$stmt->bindValue(":replyContent", $_REQUEST['replyContent']);
		$stmt->bindValue(":replyDate", $replyDate);

		$stmt->execute();
		echo "<script>alert('回覆成功');</script>";
		header("Refresh:0;url=../forum-article.php?comId={$_REQUEST["comId"]}");
	}catch(PDOException $e){
		echo "資料庫操作錯誤: ", $e.getMessage(), "<br>";
		echo "行號: ", $e.getLine(), "<br>";
	}
?>