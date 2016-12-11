<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<script src="../js/tagName.js"></script>
</head>
</html>

<?php

	// echo "<div class='singlePro'>
 //              <div class='singleProBox'>
 //                <img src='images/witcher3.jpg'>                
 //                <h5>巫師3:狂獵</h5>
 //                <div class='tag'>PS4</div>
 //                <div class='tag'>動作</div>
 //                <p class='price'>NT$878</p>
 //              </div>
 //            </div>";

// "findSuggestProd.php?gender="+ aaa[0]+ "&personality="+ aaa[1]+ "&category="+ aaa[2];
		$gender= $_GET["gender"];
		$personality= $_GET["personality"];
		$category= $_GET["category"];
// target == "冒險犯難" || target == "動作驚險" || target == "多人合作" || target == "競速刺激" || target == "策略多謀" || target == "運動休閒" || target == "即時射擊" || target == "角色扮演"
		//prodSeries prodClass
		switch ($category) {
			case '冒險犯難':
				$category= "冒險";
				break;
			case '動作驚險':
				$category= "動作";
				break;
			case '多人合作':
				$category= "多人";
				break;
			case '競速刺激':
				$category= "競速";
				break;
			case '策略多謀':
				$category= "策略";
				break;
			case '運動休閒':
				$category= "運動";
				break;
			case '即時射擊':
				$category= "射擊";
				break;
			case '角色扮演':
				$category= "角色扮演";
				break;
			
			default:
				# code...
				break;
		}

		try {
			require_once("connectSQL.php");
			$sql_1= "SELECT * FROM products WHERE proClass='". $category. "'";
			$sql_2= "";
			$str= "";
			
			$result= $pdo->query($sql_1);
	
			$num= $result->rowCount();
			if ($num>=4) {
				$num= 4;
			}else{
				$sql_2= "SELECT * FROM products WHERE proClass!='". $category. "' limit 0,". ( 4- $num );
			}
			while ($resultRow= $result->fetch(PDO::FETCH_ASSOC) && $num>0){
				$proId = $resultRow['proId'];
				
				$str.= "<div class='singlePro' onclick='location.href=`productIntro.php?proId=$proId`;'>
			              <div class='singleProBox'>
			                <img src='".$resultRow["proImg"]."'>                
			                <h5>".$resultRow["proName"]."</h5>
			                <div class='tagName'>".$resultRow["proSeries"]."</div>
			                <div class='catName'><i class='catTarget'></i>".$resultRow["proClass"]."</div>
			                <p class='price'>NT$".$resultRow["proPrice"]."</p>
			              </div>
			            </div>";

				$num--;
				//LOAD出一筆，num-1
			}
			if( $sql_2!= "" ){
				// 未滿八筆
				$result= $pdo->query($sql_2);
				while ( $resultRow= $result->fetch(PDO::FETCH_ASSOC) ) {
					$proId = $resultRow['proId'];

					$str.= "<div class='singlePro' onclick='location.href=`productIntro.php?proId=$proId`;'>
				              <div class='singleProBox'>
				                <img src='".$resultRow["proImg"]."'>                
				                <h5>".$resultRow["proName"]."</h5>
				                <div class='tagName'>".$resultRow["proSeries"]."</div>
				                <div class='catName'><i class='catTarget'></i>".$resultRow["proClass"]."</div>
				                <p class='price'>NT$".$resultRow["proPrice"]."</p>
				              </div>
				            </div>";
				}
			}

			echo $str;

		} catch (PDOException $e) {
			echo $e->getMessage();
		}


?>