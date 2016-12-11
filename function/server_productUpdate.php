<?php

require_once('connectSQL.php');
error_reporting(E_ALL || ~E_NOTICE);

$url = $_SERVER['HTTP_REFERER'];


if(isset($_POST['deleteProId']) && ($_POST['deleteProId']) != ''){
	if(isset($_POST['delete']) && ($_POST['delete']) == 'true'){

		$deleteProId = $_POST['deleteProId'];

		$deleteQuery = "DELETE FROM products WHERE proId = '$deleteProId'";

		$deleteRec = $pdo->query($deleteQuery);

		header("location: $url");
	}
}


if(isset($_POST["proId"]) && ($_POST["proId"]) != ''){ 
	$proId = $_POST["proId"];
}


// 修改商品名
if(isset($_POST["proName"]) && ($_POST["proName"]) != ''){
	$proName = $_POST["proName"];

	$proNameUpdateQuery = "UPDATE products SET proName = :proName WHERE proId = '$proId'";
	$proNameUpdateRec = $pdo->prepare($proNameUpdateQuery);
	$proNameUpdateRec->bindValue(":proName",$proName);
	$proNameUpdateRec->execute();

}

// 修改商品說明
if(isset($_POST["proInfo"]) && ($_POST["proInfo"]) != ''){
	$proInfo = nl2br($_POST["proInfo"]);

	$proInfoUpdateQuery = "UPDATE products SET proInfo = :proInfo WHERE proId = '$proId'";
	$proInfoUpdateRec = $pdo->prepare($proInfoUpdateQuery);
	$proInfoUpdateRec->bindValue(":proInfo",$proInfo);
	$proInfoUpdateRec->execute();

}

if(isset($_POST["proSeries"]) && ($_POST["proSeries"]) != ''){
	$proSeries = nl2br($_POST["proSeries"]);

	$proSeriesUpdateQuery = "UPDATE products SET proSeries = :proSeries WHERE proId = '$proId'";
	$proSeriesUpdateRec = $pdo->prepare($proSeriesUpdateQuery);
	$proSeriesUpdateRec->bindValue(":proSeries",$proSeries);
	$proSeriesUpdateRec->execute();

}

if(isset($_POST["proClass"]) && ($_POST["proClass"]) != ''){
	$proClass = nl2br($_POST["proClass"]);

	$proClassUpdateQuery = "UPDATE products SET proClass = :proClass WHERE proId = '$proId'";
	$proClassUpdateRec = $pdo->prepare($proClassUpdateQuery);
	$proClassUpdateRec->bindValue(":proClass",$proClass);
	$proClassUpdateRec->execute();

}

// 修改上下架狀態
if(isset($_POST["display"]) && ($_POST["display"]) != "" && ($_POST["display"]) != 'none'){
	$display = $_POST["display"];

	$displayUpdateQuery = "UPDATE products SET display = :display WHERE proId = '$proId'";
	$displayUpdateRec = $pdo->prepare($displayUpdateQuery);
	$displayUpdateRec->bindValue(":display",$display);
	$displayUpdateRec->execute();

}

if(isset($_POST["proPrice"]) && ($_POST["proPrice"]) != "" && ($_POST["proPrice"]) != 'none'){
	$proPrice = $_POST["proPrice"];

	$proPriceUpdateQuery = "UPDATE products SET proPrice = :proPrice WHERE proId = '$proId'";
	$proPriceUpdateRec = $pdo->prepare($proPriceUpdateQuery);
	$proPriceUpdateRec->bindValue(":proPrice",$proPrice);
	$proPriceUpdateRec->execute();

}

//主圖修改
if(isset($_FILES['proImg']['name']) && ($_FILES['proImg']['name']) != ''){
	$proImg_error = $_FILES["proImg"]["error"];
	$proImg_type = $_FILES["proImg"]["type"];
	$proImg_size = $_FILES["proImg"]["size"];
	$proImg_name = $_FILES["proImg"]["name"];
	$proImg_tmp = $_FILES["proImg"]["tmp_name"];

	move_uploaded_file($proImg_tmp, '../images/productPictures/'.$proImg_name);
	$proImg = "images/productPictures/$proImg_name";

	$proImgUpdateQuery = "UPDATE products SET proImg = '$proImg' WHERE proId = '$proId'";
	$proImgUpdateRec = $pdo->query($proImgUpdateQuery);

}

//副圖修改
if(isset($_FILES["proPic01"]["name"]) && ($_FILES["proPic01"]["name"]) != ""){

	$proPic01_error = $_FILES["proPic01"]["error"];
	$proPic01_type = $_FILES["proPic01"]["type"];
	$proPic01_size = $_FILES["proPic01"]["size"];
	$proPic01_name = $_FILES["proPic01"]["name"];
	$proPic01_tmp = $_FILES["proPic01"]["tmp_name"];

	move_uploaded_file($proPic01_tmp, '../images/productPictures/'.$proPic01_name);
	$proPic01 = "images/productPictures/$proPic01_name";

	$proPic01UpdateQuery = "UPDATE products SET proPic01 = '$proPic01' WHERE proId = '$proId'";
	$proPic01UpdateRec = $pdo->query($proPic01UpdateQuery);

}
if(isset($_FILES["proPic02"]["name"]) && ($_FILES["proPic02"]["name"]) != ""){

	$proPic02_error = $_FILES["proPic02"]["error"];
	$proPic02_type = $_FILES["proPic02"]["type"];
	$proPic02_size = $_FILES["proPic02"]["size"];
	$proPic02_name = $_FILES["proPic02"]["name"];
	$proPic02_tmp = $_FILES["proPic02"]["tmp_name"];

	move_uploaded_file($proPic02_tmp, '../images/productPictures/'.$proPic02_name);
	$proPic02 = "images/productPictures/$proPic02_name";

	$proPic02UpdateQuery = "UPDATE products SET proPic02 = '$proPic02' WHERE proId = '$proId'";
	$proPic02UpdateRec = $pdo->query($proPic02UpdateQuery);
	
}
if(isset($_FILES["proPic03"]["name"]) && ($_FILES["proPic03"]["name"]) != ""){

	$proPic03_error = $_FILES["proPic03"]["error"];
	$proPic03_type = $_FILES["proPic03"]["type"];
	$proPic03_size = $_FILES["proPic03"]["size"];
	$proPic03_name = $_FILES["proPic03"]["name"];
	$proPic03_tmp = $_FILES["proPic03"]["tmp_name"];

	move_uploaded_file($proPic03_tmp, '../images/productPictures/'.$proPic03_name);
	$proPic03 = "images/productPictures/$proPic03_name";

	$proPic03UpdateQuery = "UPDATE products SET proPic03 = '$proPic03' WHERE proId = '$proId'";
	$proPic03UpdateRec = $pdo->query($proPic03UpdateQuery);
	
}

header("location: $url");
?>