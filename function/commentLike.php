<?php
require_once("connectSQL.php");
error_reporting(E_ALL || ~E_NOTICE);

if(isset($_POST["likeType"]) && ($_POST["likeType"]) != ""){
	$likeType = $_POST["likeType"];
}

switch ($likeType) {
	case 'reply':

		if(isset($_POST["replyId"]) && ($_POST["replyId"]) != ""){
			$replyId = $_POST["replyId"];
		}
		if(isset($_POST["memAccount"]) && ($_POST["memAccount"]) != ""){
			$memAccount = $_POST["memAccount"];
		}
		

		$addLikeQuery = "INSERT INTO reply_like (replyId,memAccount) VALUES ('".$replyId."','".$memAccount."')";
		$addLikeRec = $pdo->query($addLikeQuery);

		echo json_encode(array('status'=>'success'));

		break;
	
	case 'replyDislike':

		if(isset($_POST["replyId"]) && ($_POST["replyId"]) != ""){
			$replyId = $_POST["replyId"];
		}
		if(isset($_POST["memAccount"]) && ($_POST["memAccount"]) != ""){
			$memAccount = $_POST["memAccount"];
		}

		$minerLikeQuery = "DELETE FROM reply_like WHERE replyId = '$replyId' AND memAccount = '$memAccount'";		
		$minerLikeRec = $pdo->query($minerLikeQuery);		

		echo json_encode(array('status'=>'success'));

		break;

	case 'comments':
		
		if(isset($_POST["comId"]) && ($_POST["comId"]) != ""){
			$comId = $_POST["comId"];
		}
		if(isset($_POST["memAccount"]) && ($_POST["memAccount"]) != ""){
			$memAccount = $_POST["memAccount"];
		}

		$addLikeQuery = "INSERT INTO com_like (comId,memAccount) VALUES ('".$comId."','".$memAccount."')";
		$addLikeRec = $pdo->query($addLikeQuery);

		echo json_encode(array('status'=>'success'));

		break;

	case 'dislikeComments':
			
		if(isset($_POST["comId"]) && ($_POST["comId"]) != ""){
			$comId = $_POST["comId"];
		}
		if(isset($_POST["memAccount"]) && ($_POST["memAccount"]) != ""){
			$memAccount = $_POST["memAccount"];
		}

		$minerLikeQuery = "DELETE FROM com_like WHERE comId = '$comId' AND memAccount = '$memAccount'";
		$minerLikeRec = $pdo->query($minerLikeQuery);

		echo json_encode(array('status'=>'success'));


		break;	



}


?>