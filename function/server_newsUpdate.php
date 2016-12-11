<?php

require_once('connectSQL.php');
error_reporting(E_ALL || ~E_NOTICE);

$url = $_SERVER['HTTP_REFERER'];


if(isset($_POST['deleteNewsId']) && ($_POST['deleteNewsId']) != ''){
	if(isset($_POST['delete']) && ($_POST['delete']) == 'true'){

		$deleteNewsId = $_POST["deleteNewsId"];
		
		$deleteQuery = "DELETE FROM news WHERE newsId = '$deleteNewsId'";
		$deleteRec = $pdo->query($deleteQuery);

		header("location: $url");
	}
}


if(isset($_POST["newsId"]) && ($_POST['newsId']) != ""){
	$newsId = $_POST['newsId'];
}

if(isset($_POST['newsTitle']) && ($_POST['newsTitle']) != ''){
	$newsTitle = $_POST['newsTitle'];

	$updateQuery = "UPDATE news SET newsTitle = '$newsTitle' WHERE newsId = '$newsId'";
	$updateRec = $pdo->query($updateQuery);
}

if(isset($_POST['newsImg']) && ($_POST['newsImg']) != ''){
	$newsImg = $_POST['newsImg'];

	$updateQuery = "UPDATE news SET newsImg = '$newsImg' WHERE newsId = '$newsId'";
	$updateRec = $pdo->query($updateQuery);
}

if(isset($_POST['newsInfo_1']) && ($_POST['newsInfo_1']) != ''){
	$newsInfo_1 = nl2br($_POST['newsInfo_1']);

	$updateQuery = "UPDATE news SET newsInfo_1 = '$newsInfo_1' WHERE newsId = '$newsId'";
	$updateRec = $pdo->query($updateQuery);
}

if(isset($_POST['newsInfo_2']) && ($_POST['newsInfo_2']) != ''){
	$newsInfo_2 = nl2br($_POST['newsInfo_2']);

	$updateQuery = "UPDATE news SET newsInfo_2 = '$newsInfo_2' WHERE newsId = '$newsId'";
	$updateRec = $pdo->query($updateQuery);
}

if(isset($_POST['newsInfo_3']) && ($_POST['newsInfo_3']) != ''){
	$newsInfo_3 = nl2br($_POST['newsInfo_3']);

	$updateQuery = "UPDATE news SET newsInfo_3 = '$newsInfo_3' WHERE newsId = '$newsId'";
	$updateRec = $pdo->query($updateQuery);
}


if(isset($_FILES['newsImg']['name']) && ($_FILES['newsImg']['name']) != ''){
	$newsImg_error = $_FILES["newsImg"]["error"];
	$newsImg_type = $_FILES["newsImg"]["type"];
	$newsImg_size = $_FILES["newsImg"]["size"];
	$newsImg_name = $_FILES["newsImg"]["name"];
	$newsImg_tmp = $_FILES["newsImg"]["tmp_name"];

	move_uploaded_file($newsImg_tmp, '../images/NEWS_img/'.$newsImg_name);
	$newsImg = "images/NEWS_img/$newsImg_name";

	$newsImgUpdateQuery = "UPDATE products SET newsImg = '$newsImg' WHERE proId = '$proId'";
	$newsImgUpdateRec = $pdo->query($newsImgUpdateQuery);

}

if(isset($_FILES['newsPic01']['name']) && ($_FILES['newsPic01']['name']) != ''){
	$newsPic01_error = $_FILES["newsPic01"]["error"];
	$newsPic01_type = $_FILES["newsPic01"]["type"];
	$newsPic01_size = $_FILES["newsPic01"]["size"];
	$newsPic01_name = $_FILES["newsPic01"]["name"];
	$newsPic01_tmp = $_FILES["newsPic01"]["tmp_name"];

	move_uploaded_file($newsPic01_tmp, '../images/NEWS_img/'.$newsPic01_name);
	$newsPic01 = "images/NEWS_img/$newsPic01_name";

	$newsPic01UpdateQuery = "UPDATE products SET newsPic01 = '$newsPic01' WHERE proId = '$proId'";
	$newsPic01UpdateRec = $pdo->query($newsImgUpdateQuery);

}

if(isset($_FILES['newsPic02']['name']) && ($_FILES['newsPic02']['name']) != ''){
	$newsPic02_error = $_FILES["newsPic02"]["error"];
	$newsPic02_type = $_FILES["newsPic02"]["type"];
	$newsPic02_size = $_FILES["newsPic02"]["size"];
	$newsPic02_name = $_FILES["newsPic02"]["name"];
	$newsPic02_tmp = $_FILES["newsPic02"]["tmp_name"];

	move_uploaded_file($newsPic02_tmp, '../images/NEWS_img/'.$newsPic02_name);
	$newsPic02 = "images/NEWS_img/$newsPic02_name";

	$newsPic02UpdateQuery = "UPDATE products SET newsPic02 = '$newsPic02' WHERE proId = '$proId'";
	$newsPic02UpdateRec = $pdo->query($newsImgUpdateQuery);

}

header("location: $url");

?>