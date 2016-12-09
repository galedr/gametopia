<?php

require_once('connectSQL.php');
error_reporting(E_ALL || ~E_NOTICE);

$url = $_SERVER["HTTP_REFERER"];

if(isset($_POST["bannerFrom"]) && ($_POST["bannerFrom"]) != ""){
	$bannerFrom = $_POST["bannerFrom"];
}

switch ($bannerFrom) {
	case 'news':
		if(isset($_FILES["news_banner_1"]["name"]) && ($_FILES["news_banner_1"]["name"]) != ""){
			if(isset($_POST["news_banner_1_href"]) && ($_POST["news_banner_1_href"]) != ""){
				$bannerHref = $_POST["news_banner_1_href"];
			}

			$bannerType = '新聞banner-1';

			$news_banner_1_error = $_FILES["news_banner_1"]["error"];
			$news_banner_1_type = $_FILES["news_banner_1"]["type"];
			$news_banner_1_size = $_FILES["news_banner_1"]["size"];
			$news_banner_1_name = $_FILES["news_banner_1"]["name"];
			$news_banner_1_tmp = $_FILES["news_banner_1"]["tmp_name"];

			move_uploaded_file($news_banner_1_tmp, '../images/NEWS_Img/'.$news_banner_1_name);
			$news_banner_1 = "images/NEWS_Img/$news_banner_1_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$news_banner_1',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		if(isset($_FILES["news_banner_2"]["name"]) && ($_FILES["news_banner_2"]["name"]) != ""){
			if(isset($_POST["news_banner_2_href"]) && ($_POST["news_banner_2_href"]) != ""){
				$bannerHref = $_POST["news_banner_2_href"];
			}

			$bannerType = '新聞banner-2';

			$news_banner_2_error = $_FILES["news_banner_2"]["error"];
			$news_banner_2_type = $_FILES["news_banner_2"]["type"];
			$news_banner_2_size = $_FILES["news_banner_2"]["size"];
			$news_banner_2_name = $_FILES["news_banner_2"]["name"];
			$news_banner_2_tmp = $_FILES["news_banner_2"]["tmp_name"];

			move_uploaded_file($news_banner_2_tmp, '../images/NEWS_Img/'.$news_banner_2_name);
			$news_banner_2 = "images/NEWS_Img/$news_banner_2_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$news_banner_2',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		if(isset($_FILES["news_banner_3"]["name"]) && ($_FILES["news_banner_3"]["name"]) != ""){
			if(isset($_POST["news_banner_3_href"]) && ($_POST["news_banner_3_href"]) != ""){
				$bannerHref = $_POST["news_banner_3_href"];
			}

			$bannerType = '新聞banner-3';

			$news_banner_3_error = $_FILES["news_banner_3"]["error"];
			$news_banner_3_type = $_FILES["news_banner_3"]["type"];
			$news_banner_3_size = $_FILES["news_banner_3"]["size"];
			$news_banner_3_name = $_FILES["news_banner_3"]["name"];
			$news_banner_3_tmp = $_FILES["news_banner_3"]["tmp_name"];

			move_uploaded_file($news_banner_3_tmp, '../images/NEWS_Img/'.$news_banner_3_name);
			$news_banner_3 = "images/NEWS_Img/$news_banner_3_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$news_banner_3',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		if(isset($_FILES["news_banner_4"]["name"]) && ($_FILES["news_banner_4"]["name"]) != ""){
			if(isset($_POST["news_banner_4_href"]) && ($_POST["news_banner_4_href"]) != ""){
				$bannerHref = $_POST["news_banner_4_href"];
			}

			$bannerType = '新聞banner-4';

			$news_banner_4_error = $_FILES["news_banner_4"]["error"];
			$news_banner_4_type = $_FILES["news_banner_4"]["type"];
			$news_banner_4_size = $_FILES["news_banner_4"]["size"];
			$news_banner_4_name = $_FILES["news_banner_4"]["name"];
			$news_banner_4_tmp = $_FILES["news_banner_4"]["tmp_name"];

			move_uploaded_file($news_banner_4_tmp, '../images/NEWS_Img/'.$news_banner_4_name);
			$news_banner_4 = "images/NEWS_Img/$news_banner_4_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$news_banner_4',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}
		break;
	
	case 'product_slider':
		
		if(isset($_FILES["product_slider_1"]["name"]) && ($_FILES["product_slider_1"]["name"]) != ""){
			if(isset($_POST["product_slider_1_href"]) && ($_POST["product_slider_1_href"]) != ""){
				$bannerHref = $_POST["product_slider_1_href"];
			}

			$bannerType = '商品頁slider-1';

			$product_slider_1_error = $_FILES["product_slider_1"]["error"];
			$product_slider_1_type = $_FILES["product_slider_1"]["type"];
			$product_slider_1_size = $_FILES["product_slider_1"]["size"];
			$product_slider_1_name = $_FILES["product_slider_1"]["name"];
			$product_slider_1_tmp = $_FILES["product_slider_1"]["tmp_name"];

			move_uploaded_file($product_slider_1_tmp, '../images/banner/'.$product_slider_1_name);
			$product_slider_1 = "images/banner/$product_slider_1_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$product_slider_1',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		if(isset($_FILES["product_slider_2"]["name"]) && ($_FILES["product_slider_2"]["name"]) != ""){
			if(isset($_POST["product_slider_2_href"]) && ($_POST["product_slider_2_href"]) != ""){
				$bannerHref = $_POST["product_slider_2_href"];
			}

			$bannerType = '商品頁slider-2';

			$product_slider_2_error = $_FILES["product_slider_2"]["error"];
			$product_slider_2_type = $_FILES["product_slider_2"]["type"];
			$product_slider_2_size = $_FILES["product_slider_2"]["size"];
			$product_slider_2_name = $_FILES["product_slider_2"]["name"];
			$product_slider_2_tmp = $_FILES["product_slider_2"]["tmp_name"];

			move_uploaded_file($product_slider_2_tmp, '../images/banner/'.$product_slider_2_name);
			$product_slider_2 = "images/banner/$product_slider_2_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$product_slider_2',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		if(isset($_FILES["product_slider_3"]["name"]) && ($_FILES["product_slider_3"]["name"]) != ""){
			if(isset($_POST["product_slider_3_href"]) && ($_POST["product_slider_3_href"]) != ""){
				$bannerHref = $_POST["product_slider_3_href"];
			}

			$bannerType = '商品頁slider-3';

			$product_slider_3_error = $_FILES["product_slider_3"]["error"];
			$product_slider_3_type = $_FILES["product_slider_3"]["type"];
			$product_slider_3_size = $_FILES["product_slider_3"]["size"];
			$product_slider_3_name = $_FILES["product_slider_3"]["name"];
			$product_slider_3_tmp = $_FILES["product_slider_3"]["tmp_name"];

			move_uploaded_file($product_slider_3_tmp, '../images/banner/'.$product_slider_3_name);
			$product_slider_3 = "images/banner/$product_slider_3_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$product_slider_3',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		break;

	case 'productBanner':
		
		if(isset($_FILES["product_banner_1"]["name"]) && ($_FILES["product_banner_1"]["name"]) != ""){
			if(isset($_POST["product_banner_1_href"]) && ($_POST["product_banner_1_href"]) != ""){
				$bannerHref = $_POST["product_banner_1_href"];
			}

			$bannerType = '商品頁banner-1';

			$product_banner_1_error = $_FILES["product_banner_1"]["error"];
			$product_banner_1_type = $_FILES["product_banner_1"]["type"];
			$product_banner_1_size = $_FILES["product_banner_1"]["size"];
			$product_banner_1_name = $_FILES["product_banner_1"]["name"];
			$product_banner_1_tmp = $_FILES["product_banner_1"]["tmp_name"];

			move_uploaded_file($product_banner_1_tmp, '../images/banner/'.$product_banner_1_name);
			$product_banner_1 = "images/banner/$product_banner_1_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$product_banner_1',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		if(isset($_FILES["product_banner_2"]["name"]) && ($_FILES["product_banner_2"]["name"]) != ""){
			if(isset($_POST["product_banner_2_href"]) && ($_POST["product_banner_2_href"]) != ""){
				$bannerHref = $_POST["product_banner_2_href"];
			}

			$bannerType = '商品頁banner-2';

			$product_banner_2_error = $_FILES["product_banner_2"]["error"];
			$product_banner_2_type = $_FILES["product_banner_2"]["type"];
			$product_banner_2_size = $_FILES["product_banner_2"]["size"];
			$product_banner_2_name = $_FILES["product_banner_2"]["name"];
			$product_banner_2_tmp = $_FILES["product_banner_2"]["tmp_name"];

			move_uploaded_file($product_banner_2_tmp, '../images/banner/'.$product_banner_2_name);
			$product_banner_2 = "images/banner/$product_banner_2_name";

			$updateQuery = "UPDATE banner SET bannerImg = '$product_banner_2',bannerHref = '$bannerHref' WHERE bannerType = '$bannerType'";
			$updateRec = $pdo->query($updateQuery);
		}

		break;
}


header("location: $url");

?>