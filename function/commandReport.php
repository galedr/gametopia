<?php
require_once("connectSQL.php");

if(isset($_GET["replyId"]) && ($_GET["replyId"]) != ""){
	$replyId = $_GET["replyId"];

	$reportQuery = "UPDATE com_reply SET status = '檢舉' WHERE replyId = :replyId";
	$reportRec = $pdo->prepare($reportQuery);
	$reportRec->bindValue(":replyId",$replyId);
	$reportRec->execute();	
}

if(isset($_GET["comId"]) && ($_GET["comId"]) != ""){
	$comId = $_GET["comId"];

	$reportQuery = "UPDATE comments SET status = '檢舉' WHERE comId = :comId";
	$reportRec = $pdo->prepare($reportQuery);
	$reportRec->bindValue(":comId",$comId);
	$reportRec->execute();
}

echo "
		<script>
			history.go(-1);
		</script>
	";


?>