<?php

require_once('connectSQL.php');

if(isset($_POST["reportType"]) && ($_POST["reportType"]) != ''){
	$reportType = $_POST["reportType"];
}


$returnHTML = array();

switch ($reportType) {
	case 'comments':
		
		if(isset($_POST["comId"]) && ($_POST["comId"]) != ""){
			$comId = $_POST["comId"];
		}

		$comQuery = "SELECT * FROM comments WHERE comId = '$comId'";
		$comRec = $pdo->query($comQuery);
		$comRow = $comRec->fetch(PDO::FETCH_ASSOC);

		$returnHTML[] = '
							'.$comRow["comContent"].'
						';

		$data = implode($returnHTML);

		break;
	
	case 'reply':
		
		if(isset($_POST["replyId"]) && ($_POST["replyId"]) != ""){
			$replyId = $_POST["replyId"];
		}

		$replyQuery = "SELECT * FROM com_reply WHERE replyId = '$replyId'";
		$replyRec = $pdo->query($replyQuery);
		$replyRow = $replyRec->fetch(PDO::FETCH_ASSOC);

		$returnHTML[] = '
							'.$replyRow["replyContent"].'
						';

		$data = implode($returnHTML);

		break;
}



echo json_encode(array("status"=>"success","data"=>$data));






?>