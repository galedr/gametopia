<?php

require_once('connectSQL.php');

if(isset($_POST["reportType"]) && ($_POST["reportType"]) != ""){
	$reportType = $_POST["reportType"];
}

switch ($reportType) {
	case 'comments':
		
		if(isset($_POST["comId"]) && ($_POST["comId"]) != ""){
			$comId = $_POST["comId"];
		}

		$comQuery = "UPDATE comments SET status = '正常' WHERE comId = '$comId'";
		$comRec = $pdo->query($comQuery);

		break;
	

	case 'reply':
		

		if(isset($_POST["replyId"]) && ($_POST["replyId"]) != ""){
			$replyId = $_POST["replyId"];
		}

		$replyQuery = "UPDATE com_reply SET status = '正常' WHERE replyId = '$replyId'";

		$replyRec = $pdo->query($replyQuery);

		break;

}




echo json_encode(array("status"=>"success"));








?>