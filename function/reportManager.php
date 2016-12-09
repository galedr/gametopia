<?php

require_once('connectSQL.php');


$url = $_SERVER["HTTP_REFERER"];

if(isset($_GET["dealType"]) && ($_GET["dealType"]) != ""){
	$dealType = $_GET["dealType"];
}

switch ($dealType) {
	case 'comRecover':
		
		if(isset($_GET["comId"]) && ($_GET["comId"]) != ""){
			$comId = $_GET["comId"];
		}

		$recoverQuery = "UPDATE comments SET status = '正常' WHERE comId = '$comId'";
		$recoverRec = $pdo->query($recoverQuery);

		break;
	
	case 'comDelete':
		
		if(isset($_GET["comId"]) && ($_GET["comId"]) != ""){
			$comId = $_GET["comId"];
		}

		$comDeleteQuery = "DELETE FROM comments WHERE comId = '$comId'";
		$comDeleteRec = $pdo->query($comDeleteQuery);

		break;

	case 'replyRecover':
		
		if(isset($_GET["replyId"]) && ($_GET["replyId"]) != ""){
			$replyId = $_GET["replyId"];
		}

		$replyRecoverQuery = "UPDATE com_reply SET status = '正常' WHERE replyId = '$replyId'";
		$replyRecoverRec = $pdo->query($replyRecoverQuery);

		break;

	case 'replyDelete':
		
		if(isset($_GET["replyId"]) && ($_GET["replyId"]) != ""){
			$replyId = $_GET["replyId"];
		}

		$replyDeleteQuery = "DELETE FROM com_reply WHERE replyId = '$replyId'";
		$replyDeleteRec = $pdo->query($replyDeleteQuery);

		break;

}


header("location: $url");

?>