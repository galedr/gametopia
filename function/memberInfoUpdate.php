<?php

require("connectSQL.php");

if(isset($_POST["memInfoCheck"]) && ($_POST["memInfoCheck"]) != ""){
	$memInfoCheck = $_POST["memInfoCheck"];
}
if(isset($_POST["memId"]) && ($_POST["memId"]) != ""){
	$memId = $_POST["memId"];
}



switch ($memInfoCheck) {
	case 'photo':
		
		if(isset($_FILES["memImg"]["name"]) && ($_FILES["memImg"]["name"]) != ""){
			$img_error = $_FILES["memImg"]["error"];
			$img_type = $_FILES["memImg"]["type"];
			$img_size = $_FILES["memImg"]["size"];
			$img_name = $_FILES["memImg"]["name"];
			$img_tmp = $_FILES["memImg"]["tmp_name"];	

			move_uploaded_file($img_tmp, '../memImg/'.$img_name);
			$img_href = "memImg/$img_name";
			$memImg = nl2br($img_href);

			$updateMemImgQuery = "UPDATE memberdata SET memImg = '$memImg' WHERE memId = '$memId'";
			$updateMemImgRec = $pdo->query($updateMemImgQuery);

			header("location: ../member.php");
		}

		break;



	case 'information':
		
		if(isset($_POST["memPassword"]) && ($_POST["memPassword"]) != ""){
			$memPassword = $_POST["memPassword"];
			$updateQuery = "UPDATE memberdata SET memPassword = :memPassword WHERE memId = '$memId'";
			$updateRec = $pdo->prepare($updateQuery);
			$updateRec->bindValue(":memPassword",$memPassword);
			$updateRec->execute();
		}
		if(isset($_POST["mz-name"]) && ($_POST["mz-name"]) != ""){
			$memNickName = $_POST["mz-name"];
			$updateQuery = "UPDATE memberdata SET memNickName = :memNickName WHERE memId = '$memId'";
			$updateRec = $pdo->prepare($updateQuery);
			$updateRec->bindValue(":memNickName",$memNickName);
			$updateRec->execute();
		}
		if(isset($_POST["mz-email"]) && ($_POST["mz-email"]) != ""){
			$memEmail = $_POST["mz-email"];
			$updateQuery = "UPDATE memberdata SET memEmail = :memEmail WHERE memId = '$memId'";
			$updateRec = $pdo->prepare($updateQuery);
			$updateRec->bindValue(":memEmail",$memEmail);
			$updateRec->execute();
		}

		header("location: ../member.php");

		break;

}


?>