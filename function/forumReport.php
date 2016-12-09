<?php

require_once('connectSQL.php');

if(isset($_POST['reportFrom']) && ($_POST['reportFrom']) != ''){
	$reportFrom = $_POST['reportFrom'];
}


switch ($reportFrom) {
	case 'comments':
		
		if(isset($_POST['comId']) && ($_POST['comId']) != ''){
			$comId = $_POST['comId'];
		}

		$reportQuery = "UPDATE comments SET status = '檢舉' WHERE comId = '$comId'";
		$reportRec = $pdo->query($reportQuery);

		break;
	
	case 'reply':
		
		if(isset($_POST['replyId']) && ($_POST['replyId']) != ''){
			$replyId = $_POST['replyId'];
		}

		$reportQuery = "UPDATE com_reply SET status = '檢舉' WHERE replyId = '$replyId'";
		$reportRec = $pdo->query($reportQuery);

		break;

}

echo json_encode(array('status'=>'success'));

?>