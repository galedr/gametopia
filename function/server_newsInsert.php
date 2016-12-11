<?php

require_once('connectSQL.php');
error_reporting(E_ALL || ~E_NOTICE);

if(isset($_POST["newsTitle"]) && ($_POST["newsTitle"]) != ''){
	$newsTitle = $_POST["newsTitle"];
}

if(isset($_POST["newsauthor"]) && ($_POST["newsauthor"]) != ''){
	$newsauthor = $_POST["newsauthor"];
}

if(isset($_FILES['newsImg']['name']) && ($_FILES['newsImg']['name']) != ''){
	$newsImg_error = $_FILES["newsImg"]["error"];
	$newsImg_type = $_FILES["newsImg"]["type"];
	$newsImg_size = $_FILES["newsImg"]["size"];
	$newsImg_name = $_FILES["newsImg"]["name"];
	$newsImg_tmp = $_FILES["newsImg"]["tmp_name"];

	move_uploaded_file($newsImg_tmp, '../images/NEWS_img/'.$newsImg_name);
	$newsImg = "images/NEWS_img/$newsImg_name";

}

if(isset($_FILES['newsPic01']['name']) && ($_FILES['newsPic01']['name']) != ''){
	$newsPic01_error = $_FILES["newsPic01"]["error"];
	$newsPic01_type = $_FILES["newsPic01"]["type"];
	$newsPic01_size = $_FILES["newsPic01"]["size"];
	$newsPic01_name = $_FILES["newsPic01"]["name"];
	$newsPic01_tmp = $_FILES["newsPic01"]["tmp_name"];

	move_uploaded_file($newsPic01_tmp, '../images/NEWS_img/'.$newsPic01_name);
	$newsPic01 = "images/NEWS_img/$newsImg_name";

}

if(isset($_FILES['newsPic02']['name']) && ($_FILES['newsPic02']['name']) != ''){
	$newsPic02_error = $_FILES["newsPic02"]["error"];
	$newsPic02_type = $_FILES["newsPic02"]["type"];
	$newsPic02_size = $_FILES["newsPic02"]["size"];
	$newsPic02_name = $_FILES["newsPic02"]["name"];
	$newsPic02_tmp = $_FILES["newsPic02"]["tmp_name"];

	move_uploaded_file($newsPic02_tmp, '../images/NEWS_img/'.$newsPic02_name);
	$newsPic02 = "images/NEWS_img/$newsPic02_name";

}

if(isset($_POST["newsInfo_1"]) && ($_POST["newsInfo_1"]) != ''){
	$newsInfo_1 = nl2br($_POST["newsInfo_1"]);
}

if(isset($_POST["newsInfo_2"]) && ($_POST["newsInfo_2"]) != ''){
	$newsInfo_2 = nl2br($_POST["newsInfo_2"]);
}

if(isset($_POST["newsInfo_3"]) && ($_POST["newsInfo_3"]) != ''){
	$newsInfo_3 = nl2br($_POST["newsInfo_3"]);
}

$newsDate = date('y-m-d');


$insertQuery = "INSERT INTO news (newsauthor,newsTitle,newsDate,newsImg,newsPic01,newsPic02,newsInfo_1,newsInfo_2,newsInfo_3) VALUES ('".$newsauthor."','".$newsTitle."','".$newsDate."','".$newsImg."','".$newsPic01."','".$newsPic02."','".$newsInfo_1."','".$newsInfo_2."','".$newsInfo_3."')";

$insertRec = $pdo->query($insertQuery);

echo "
		<script>
			history.go(-1);
		</script>
	 ";



?>